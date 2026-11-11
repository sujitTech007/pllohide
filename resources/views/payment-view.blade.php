@include('include.header')

<style>
    
    /* Stripe Card Element Design */
#card-element {
    width: 100%;
    min-height: 52px;
    padding: 16px 15px;
    background: #fff;
    border: 1px solid #dce1e7;
    border-radius: 10px;
    box-sizing: border-box;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
}

#card-element:hover {
    border-color: #2DAC92;
}

#card-element.StripeElement--focus {
    border-color: #2DAC92;
    box-shadow: 0 0 0 3px rgba(45, 172, 146, 0.12);
}

#card-element.StripeElement--invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.08);
}

/* Card Details Section */
.credit_card_bx {
    background: #fff;
    padding: 30px;
    border: 1px solid #e9edf2;
    border-radius: 14px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
}

.credit_card_bx h3 {
    font-size: 20px;
    font-weight: 600;
    color: #252b33;
    margin-bottom: 22px;
}

/* Payment Button */
#pay-button {
    min-width: 190px;
    padding: 13px 28px;
    border: none;
    border-radius: 8px;
    background: #2DAC92;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
}

#pay-button:hover {
    background: #238e79;
    box-shadow: 0 5px 15px rgba(45, 172, 146, 0.25);
    transform: translateY(-2px);
}

/* Payment Summary */
.payment-summary {
    background: #f8fbfa !important;
    border: 1px solid #e3eee9 !important;
    border-radius: 12px !important;
    padding: 22px !important;
}

.payment-summary h4 {
    font-size: 19px;
    font-weight: 600;
    color: #252b33;
}

.payment-summary p {
    font-size: 14px;
    color: #555f6d;
    margin-bottom: 10px;
}

.payment-summary p strong {
    color: #252b33;
}

/* Card Preview */
.paym_card {
    background: linear-gradient(135deg, #183f3a 0%, #2DAC92 100%);
    padding: 28px;
    border-radius: 16px;
    color: #fff;
    box-shadow: 0 10px 30px rgba(45, 172, 146, 0.20);
    min-height: 250px;
    position: relative;
    overflow: hidden;
}

.paym_card h3,
.paym_card p {
    color: #fff;
}

.paym_card .crd_details h3 {
    font-size: 17px;
    font-weight: 600;
    margin-top: 25px;
}

.paym_card .crd_details p {
    font-size: 14px;
    opacity: 0.85;
}

.paym_card .crd_det {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 25px;
}

.paym_card .crd_det h3 {
    font-size: 14px;
    margin: 0;
}

.paym_card .crd_name {
    display: flex;
    align-items: center;
    gap: 8px;
}

.paym_card .crd_name img {
    max-width: 40px;
}

.paym_card .crd_name p {
    margin: 0;
    font-size: 12px;
}

.paym_card > .text {
    margin-top: 25px;
    font-size: 13px;
    opacity: 0.85;
}

.paym_card .pay__bx p {
    font-size: 28px;
    font-weight: 700;
    margin: 5px 0 0;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .credit_card_bx {
        padding: 20px;
    }

    .paym_card {
        margin-top: 25px;
        padding: 22px;
    }

    #pay-button {
        width: 100%;
    }
}

</style>
        <div class="Subscrip_sect invdi_sect mb-0 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box_plan">
                            <h3>Payment Method</h3>
                            <p class="brd_underline">Select your payment method and enter your payment information.
                            </p>
                            <div class="payment-summary mb-4 p-3 border rounded bg-light">
                                <h4 class="mb-3">Payment Summary</h4>
                                @if($purchase)
                                    <p><strong>Payment Type:</strong> Subscription</p>
                                    <p><strong>Amount:</strong> ${{ $amount }}</p>
                                    <p><strong>Plan:</strong> Monthly Designer Subscription</p>
                                @elseif($orderPayment)
                                    <p><strong>Payment Type:</strong> Order Payment</p>
                                    <p><strong>Order ID:</strong> #{{ $orderPayment->order?->order_id ?? $orderPayment->order_id }}</p>
                                    <p><strong>Vendor:</strong> {{ $orderPayment->order?->vendor?->name ?? 'N/A' }}</p>
                                    <p><strong>Amount:</strong> ${{ $amount }}</p>
                                @else
                                    <p>No payment context available.</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-md-12 col-sm-12">
                                    <div class="credit_card_bx mt-3">
                                        <!--<ul>-->
                                        <!--    <li><span class="fa fa-credit-card"></span> net banking </li>-->
                                        <!--    <li><span class="fa fa-credit-card"></span> credit/debit card</li>-->
                                        <!--    <li><span class="fa fa-credit-card"></span> Add New Card </li>-->
                                        <!--</ul>-->
                                        <h3>Card Details</h3>
                                        <div class="frm_grp" id="card-element"></div>
                                        <!--<h3>Card Holder Name</h3>-->
                                        <!--<div class="frm_grp"><label class="label_nrm" for="card-holder-name">Enter Card holder name-->
                                        <!--    </label><input id="card-holder-name" type="text" placeholder="Maria Barrymore"-->
                                        <!--        class="form-control" required=""><span class="icon_bx"><img-->
                                        <!--            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAHpSURBVHgBvVQ7SMNQFD1Jo4guBT+bUAdHoTroalEHBzVOOgY/ODhYB0EHXVzFD65+Oupk1EHwQ50cbQcRxMGCmzjUwSLS5nlvmrRJm7RUxANJ7n3JOzn3nfse8MeQqn2gXaghpR4LhoEPI4tYbFhP/ZpQu1TDgQBOKAxZQ6ncNyKVSMsIp+PqAgRUCoP0DPvMurWe+n5E3/ElnLpRozSwhRoggMWDAX3bzmUXu4Qx1AhJuOfIqBGTnVPm5UDQk5DdJP39lchGOyYx2D5iXo1KkyUR4Vkyz0XIZIF6xCuRtTS0EeGEGZ+9HCGT/Sy8M6gTTEE2oaxAQ7E1CgQ2WM1Sz7oZP6UfiPC49H8hqQ5RDhS+CQlBp93drb2Y71rB+9cbNu5XMULKmukHnB8+7sILZE66SBjAtjAwJlkqM9mMWRKrXOvdLKzXOSlj0lJQ66QMBTGT2B7khaW1SDhL5jKbrdKvX89x9HzgqS4noyMWye8eV2NPX6sJds3OWRkbEW7tw/LdnCcZybvdH9Qjdqq4Xsq0DqKYctmsysMEX7gaWwicen3kbJEygZJ7TtnhMHOlRsmk/Hbya3SBJFcj5XC6N1Tcx56ETmhxNSQbiNvum27KGCcDkn5zqh+wTJqFRgdHMEftZbv5b/gBay+hxqYW/GsAAAAASUVORK5CYII="-->
                                        <!--            alt=""></span></div>-->
                                        <!--<div class="grp_sect mb-3">-->
                                        <!--    <div class="lft_bx">-->
                                        <!--        <h3>CVV Number</h3><label class="label_nrm" for="">Enter the 3 digit-->
                                        <!--            number</label>-->
                                        <!--    </div>-->
                                        <!--    <div class="lft_bx"><input type="text" class="form-control" maxlength="3"-->
                                        <!--            required=""></div>-->
                                        <!--</div>-->
                                        <!--<div class="grp_sect">-->
                                        <!--    <div class="lft_bx">-->
                                        <!--        <h3>Expiry Date</h3><label class="label_nrm" for="">Enter the-->
                                        <!--            Expiration date of the card</label>-->
                                        <!--    </div>-->
                                        <!--    <div class="rgt_bx"><input type="text" class="form-control" placeholder="MM"-->
                                        <!--            maxlength="2" required=""><span>/</span><input type="text"-->
                                        <!--            class="form-control" placeholder="YY" maxlength="2" required="">-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <div class="btn_grp_com d-flex align-items-center justify-content-center mt-5">
                                            <button id="pay-button" type="button" class="btn bg_btn">Confirm and Pay</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <div class="paym_card">
                                        <div class="crd_details">
                                            <div class="crd_img_wif"><img
                                                    src="data:image/png;base64,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"
                                                    alt=""></div>
                                            <h3>Card Holder name</h3>
                                            <p></p>
                                            <div class="crd_det">
                                                <h3>MM/YY</h3>
                                                <div class="crd_name "><img
                                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAaCAYAAADFTB7LAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAOlSURBVHgB7ZdZSFRRGMf/o3fGGZ1SSzOdbNNsocgWy7BFkkJIo30j6qXorUUQog3bKIksq6eIfKhoz5aHsqQMTFMjc4HMCsYlt0ZHvDPOHWe5nXNGr5OoI9nDDfrB5X7n4yzf+X/nnHuuYsXRh+KyWeMgR96U1wlc/MxxOLRxAeSIw+EERw1Llx3bM15ALmhUHG6mJDKbBdhpteNRwTfIhUCtWrK9IHP+Bzhc2Br09eGwb/UcyAW6SXrgehwXdy3D38Jqd6C2hYcoAhGh/vD2UvRbj7fY4KP0gorzHrAvDoPQ3N6JqzkVuPTsEyu/S9+EKF0gs3dcyMGr0ho8ObIaq048Yb6Cc5vxtqIeqVn5aDcLzOenVpJzNkY6a/dfe4tbeVWYGxGMtG2LoPT2wvzIkD8LMCTAF6lr5+HYrUJWpscRJfv9d9x48xnHtixEmd4AQ4cFkWEBsHY5sPtKLkID/XD/4DpoNUo8/6DHxrgo1q66oR2ZT0uZXVVvROTYAFZnMAYNkKIm6efILO3kVBdsdpI2ESlEhYljRuLwpgVITMtm9RLnTMC9/GpmCzYHoicFI2ikBrFRoVJfG848Q3jQCNQZeLTyAoL9NZ6GH9ou1qhca8RMFMwk6da3dODynni08VbkkZRStiydiuWzw5ltNAmISbmNoi9NUh90qVTUtCJr30pXX4INfGeXx7GHFKCP0iU0TcvZByXYuXwGkmIm41VZLdsI4UFaxE0PA/2uZx9KZurSScSm3sHr8jqm2Kl7xazd0pk6KBSuTWPgLR7HHlKA6u4Az9wvZilO2xbLyg+6U5owe7xUd01sBErOb0XYKD9WziWTOHW3GHU/eVTWGJB04rFU19AheBzb4xqkqJSuefxoNSFzdzxTyCzYkVNay/ybl0zFyTtFmED8i6aFotFolo4OrVpFJkZUT5iOpPmTma9C38rq0KBjpoQMP8AeBaN0AdibHM3sl6V6WMmmGaX1wYro8Ugnqc+rrJfa0MM/fediXM+thG60Fqe3x7E3JePxRxZgm8mzgjh9t0j0BOlIbDKaRZOlS/JRm/qaydMDUVgsqm4UvzYYRYfTyXy0Du/Wzr2tqY+/L8dvF1pc0ljbgUdxA04isB+fX/fjTlj3407IENv+hsofWF/AzN4UO22QDW6x/Bu3GVmhDiKy9X7+5KegjtyqfMdIRZeCHPkHSMiCbPDu/Sfh6DexhXcSaeVzYWWQq56Z3BcVSM44ANmisP8C5wvC31hke8cAAAAASUVORK5CYII="
                                                        alt="">
                                                    <p>Visa card</p>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text">Amount to Pay</p>
                                        <div class="pay__bx">
                                            <p><span>${{ $amount }}</span></p>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ $publishableKey }}");
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const clientSecret = "{{ $clientSecret }}";
    const purchaseId = "{{ optional($purchase)->id }}";
    const orderPaymentId = "{{ optional($orderPayment)->id }}";

    document.getElementById('pay-button').addEventListener('click', async (e) => {
        e.preventDefault();

        if (!clientSecret) {
            alert('Payment cannot be initialized. Please contact support.');
            return;
        }

        const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
            payment_method: { card: card }
        });

        if (error) {
            alert(error.message || 'Payment failed');
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

            const text = await response.text();
            alert('Payment succeeded but server processing failed. Please contact support.');
        }
    });
</script>


        <!--<script src="https://js.stripe.com/v3/"></script>-->
        <!--<script>-->
        <!--    const stripe = Stripe("{{ $publishableKey }}");-->
        <!--    const elements = stripe.elements();-->
        <!--    const card = elements.create('card');-->
        <!--    card.mount('#card-element');-->

        <!--    const clientSecret = "{{ $clientSecret }}";-->
        <!--    const purchaseId = "{{ optional($purchase)->id }}";-->

        <!--    document.getElementById('pay-button').addEventListener('click', async (e) => {-->
        <!--        e.preventDefault();-->
        <!--        const {error, paymentIntent} = await stripe.confirmCardPayment(clientSecret, {-->
        <!--            payment_method: {-->
        <!--                card: card-->
        <!--            }-->
        <!--        });-->

        <!--        if (error) {-->
        <!--            alert(error.message || 'Payment failed');-->
        <!--            return;-->
        <!--        }-->

        <!--        if (paymentIntent && paymentIntent.status === 'succeeded') {-->
                     <!--Notify server to mark as paid-->
        <!--            const formData = new FormData();-->
        <!--            if (purchaseId) {-->
        <!--                formData.append('purchase_id', purchaseId);-->
        <!--            }-->
        <!--            formData.append('payment_intent', paymentIntent.id);-->
        <!--            formData.append('_token', '{{ csrf_token() }}');-->
        <!--            fetch("{{ route('subscribe.markPaid') }}", {-->
        <!--                method: 'POST',-->
        <!--                body: formData-->
        <!--            }).then((res) => {-->
        <!--                window.location.href = "{{ route('payment.successfull') }}";-->
        <!--            }).catch(() => {-->
        <!--                window.location.href = "{{ route('payment.successfull') }}";-->
        <!--            });-->
        <!--        }-->
        <!--    });-->
        <!--</script>-->
@include('include.footer')