<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCIT</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #e0e0e0; color: #24292f;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; text-align: center; border: 3px #e0e0e0 solid;">
        <!-- Header -->
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="text-align: center; margin: 0 auto;">
            <tr>
                <td align="center" style="padding: 24px 32px; border-bottom: 1px solid #fff;">
                    <img src="{{ $message->embed(public_path('images/logo/logo1.png')) }}" alt="Logo" style="height: 40px; width: auto; vertical-align: middle;">
                </td>
            </tr>
        </table>
        <!-- Main Content -->
        <div style="padding: 32px;">
            <h2 style="margin: 0 0 16px 0; font-size: 20px; font-weight: 600;">Your OTP for Password Reset</h2>
            
            <p style="margin: 0 0 24px 0; font-size: 16px; line-height: 1.5;">
                Please use the following OTP code to verify and reset your account password.
            </p>
            
            <!-- Code Section -->
            <div style="margin: 32px 0; padding: 24px; background-color: #d0d7de; border-radius: 6px; text-align: center;">
                <div style="font-size: 32px; font-weight: 700; letter-spacing: 8px; color: #349901;">{{ $otp }}</div>
            </div>
            
            <p style="margin: 0 0 24px 0; font-size: 14px; color: #F48423;">
                Please do not share this code or email with anyone.
            </p>
        </div>
        
        <!-- Footer -->
        <div style="padding: 24px 32px; background-color: #f6f8fa; border-top: 1px solid #d0d7de;">
            <p style="margin: 0; font-size: 12px; color: #8c959f;">
                © {{ date('Y') }} GCIT
            </p>
        </div>
    </div>
</body>
</html>
