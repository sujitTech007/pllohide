

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlloHide</title>
<link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">


</head>

<body>

    <div class="signup_page">
        <div class="bg_inner"><img src="{{ asset('assets/images/bg.png') }}" alt="" class="media_img">
            <div class="card_success">
                <div class="bg_inner bg_Create">
                    <form method="POST" action="{{ route('verify.otp') }}" id="otp-form">
                        @csrf
                    <h5 class="text-left mb-3">Verification</h5>
                    <div class="form">
                        <div class="frm_grp"><label for="phone">Mobile Number</label>
                            <input type="text" name="phone"
                                id="phone" class="form-control" placeholder="+1 665 183 4627" value="{{ $masked ?? '' }}" readonly>
                            </div>
                        <div class="frm_frog">
                            <div class="otp_grp">
                                <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" class="form-control otp-digit" name="otp[]" autocomplete="one-time-code" aria-label="OTP digit 1">
                                <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" class="form-control otp-digit" name="otp[]" aria-label="OTP digit 2">
                                <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" class="form-control otp-digit" name="otp[]" aria-label="OTP digit 3">
                                <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" class="form-control otp-digit" name="otp[]" aria-label="OTP digit 4">
                                <input type="hidden" name="otp" id="otp-hidden" value="">
                            </div>
                            @if($errors->has('otp'))
                                <div class="invalid-feedback" style="display:block;">{{ $errors->first('otp') }}</div>
                            @endif
                            <div class="pass_rest">Enter 1234 • 00:14 <a href="{{ route('login') }}"> Resend OTP</a></div>
                        </div>
                        <div class="btn_grp text-center"><button class="btn">Verify</button></div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        (function(){
            var inputs = document.querySelectorAll('.otp-digit');
            var hidden = document.getElementById('otp-hidden');
            var form = document.getElementById('otp-form');

            function updateHidden(){
                var code = '';
                inputs.forEach(function(el){ code += (el.value || '').trim(); });
                hidden.value = code;
            }

            inputs.forEach(function(input, index){
                input.addEventListener('input', function(e){
                    var v = e.target.value.replace(/\D/g,'');
                    e.target.value = v.slice(0,1);
                    if (e.target.value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    updateHidden();
                });
                input.addEventListener('keydown', function(e){
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
                input.addEventListener('paste', function(e){
                    var text = (e.clipboardData || window.clipboardData).getData('text');
                    if (!text) return;
                    e.preventDefault();
                    var digits = text.replace(/\D/g,'').slice(0, inputs.length).split('');
                    inputs.forEach(function(inp, i){ inp.value = digits[i] || ''; });
                    updateHidden();
                    var next = digits.length >= inputs.length ? inputs[inputs.length-1] : inputs[digits.length];
                    if (next) next.focus();
                });
            });

            form.addEventListener('submit', function(){
                updateHidden();
            });

            if (inputs[0]) inputs[0].focus();
        })();
    </script>
</body>

</html>