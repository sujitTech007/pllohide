<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>

<body style="margin:0; padding:0; background:#f5f7fb; font-family:Arial, sans-serif;">

    <div style="max-width:600px; margin:40px auto; background:#ffffff; padding:35px; border-radius:12px;">

        <h2 style="margin-top:0; color:#222;">
            OTP Verification
        </h2>

        <p style="font-size:16px; color:#555;">
            Hello,
        </p>

        <p style="font-size:16px; color:#555;">
            Your One-Time Password (OTP) for verification is:
        </p>

        <div style="text-align:center; margin:30px 0;">
            <span style="
                display:inline-block;
                padding:15px 30px;
                background:#f1f5f9;
                border-radius:8px;
                font-size:32px;
                font-weight:bold;
                letter-spacing:8px;
                color:#111827;
            ">
                {{ $otp }}
            </span>
        </div>

        <p style="font-size:14px; color:#777;">
            This OTP is valid for a limited time. Please do not share this OTP with anyone.
        </p>

        <p style="font-size:14px; color:#777;">
            If you did not request this OTP, you can safely ignore this email.
        </p>

        <hr style="border:0; border-top:1px solid #eee; margin:30px 0;">

        <p style="font-size:13px; color:#999;">
            This is an automated email. Please do not reply to this email.
        </p>

    </div>

</body>
</html>