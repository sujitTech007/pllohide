@include('include.header')

<div class="payment-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card shadow-sm border-0">
                    <div class="row g-0">
                        <div class="col-lg-7 p-4">
                            <div class="mb-4">
                                <h2 class="mb-2">Secure Checkout</h2>
                                <p class="text-muted">Complete your payment using Stripe. Your card information is processed securely.</p>
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Payment details</h5>

                                <div class="mb-3">
                                    <label for="card-holder-name" class="form-label">Cardholder name</label>
                                    <input id="card-holder-name" type="text" class="form-control" placeholder="Jane Doe" autocomplete="cc-name">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Card information</label>
                                    <div id="card-element" class="form-control p-3 rounded"></div>
                                </div>

                                <div id="card-errors" class="text-danger mb-3" role="alert"></div>

                                <button id="pay-button" type="button" class="btn btn-primary btn-lg w-100 py-3">Pay ${{ $amount }}</button>
                            </div>

                            <div class="mt-4 text-muted small">
                                <p class="mb-1"><strong>Need help?</strong></p>
                                <p class="mb-0">If your payment fails, contact support for assistance.</p>
                            </div>
                        </div>
                        <div class="col-lg-5 bg-light p-4 border-start">
                            <div class="mb-4">
                                <h5 class="mb-3">Payment summary</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Amount</span>
                                    <strong>${{ $amount }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Payment type</span>
                                    <strong>{{ $purchase ? 'Subscription' : ($orderPayment ? 'Order Payment' : 'Checkout') }}</strong>
                                </div>
                                @if($purchase)
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Plan</span>
                                        <strong>Monthly Designer Subscription</strong>
                                    </div>
                                @elseif($orderPayment)
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Order</span>
                                        <strong>#{{ $orderPayment->order?->order_id ?? $orderPayment->order_id }}</strong>
                                    </div>
                                @endif
                            </div>

                            <div class="p-3 rounded border bg-white">
                                <h6>Secure payment</h6>
                                <p class="text-muted mb-2">Stripe secures every transaction with modern encryption.</p>
                                <p class="text-muted mb-0">Your card details are never stored on our servers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.payment-page {
    background: #f4f7fb;
    min-height: calc(100vh - 120px);
}
.payment-page .card {
    border-radius: 18px;
}
#card-element {
    min-height: 56px;
    border: 1px solid #dfe3e8;
    border-radius: 12px;
    background: #fff;
}
.StripeElement--focus {
    border-color: #5664d2;
    box-shadow: 0 0 0 1px rgba(86,100,210,.2);
}
.StripeElement--invalid {
    border-color: #e53e3e;
}
</style>

<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe("{{ $publishableKey }}");
const elements = stripe.elements();
const card = elements.create('card', {
    style: {
        base: {
            color: '#32325d',
            fontFamily: 'Arial, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#a0aec0'
            }
        },
        invalid: {
            color: '#e53e3e',
            iconColor: '#e53e3e'
        }
    }
});
card.mount('#card-element');

const clientSecret = "{{ $clientSecret }}";
const purchaseId = "{{ optional($purchase)->id }}";
const orderPaymentId = "{{ optional($orderPayment)->id }}";
const payButton = document.getElementById('pay-button');
const cardHolderName = document.getElementById('card-holder-name');
const cardErrors = document.getElementById('card-errors');

payButton.addEventListener('click', async (e) => {
    e.preventDefault();
    cardErrors.textContent = '';

    if (!clientSecret) {
        cardErrors.textContent = 'Unable to initialize payment. Please contact support.';
        return;
    }

    const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
        payment_method: {
            card: card,
            billing_details: {
                name: cardHolderName.value || undefined,
            }
        }
    });

    if (error) {
        cardErrors.textContent = error.message || 'Payment failed. Please try again.';
        return;
    }

    if (paymentIntent && paymentIntent.status === 'succeeded') {
        const formData = new FormData();
        if (purchaseId) {
            formData.append('purchase_id', purchaseId);
        }
        if (orderPaymentId) {
            formData.append('order_payment_id', orderPaymentId);
        }
        formData.append('payment_intent', paymentIntent.id);
        formData.append('_token', '{{ csrf_token() }}');

        const response = await fetch("{{ route('subscribe.markPaid') }}", {
            method: 'POST',
            body: formData,
        });

        if (response.redirected) {
            window.location.href = response.url;
            return;
        }

        cardErrors.textContent = 'Payment succeeded but confirmation failed. Please contact support.';
    }
});
</script>

@include('include.footer')
