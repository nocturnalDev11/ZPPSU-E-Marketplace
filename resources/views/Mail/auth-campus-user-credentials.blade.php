<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account Credentials</title>
</head>

<body style="background-color: #f7fafc; padding: 1.5rem; font-family: Arial, sans-serif;">
    <table align="center" width="600" cellpadding="0" cellspacing="0"
        style="background-color: #ffffff; padding: 2rem; margin: auto; border-radius: 8px;">
        <tr>
            <td>
                <h1 style="color: #4a5568; font-size: 1.2rem; text-align: center; margin: 0;">
                    <a href="#" style="color: #4a5568; text-decoration: none;">ZPPSU E-Marketplace</a>
                </h1>

                <div style="margin-top: 2rem;">
                    <h3 style="color: #4a5568; font-size: 1.5rem; margin-bottom: 1rem;">
                        Hi {{ $user->name }},
                    </h3>

                    <p style="line-height: 1.6; color: #718096; margin-bottom: 1rem;">
                        Here are your account credentials. Use this as you log in:
                    </p>

                    <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 1rem;">
                        <tr>
                            <td style="color: #718096; padding: 0.5rem 0;">
                                <strong>Login ID:</strong> {{ $user->login_id }}
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #718096; padding: 0.5rem 0;">
                                <strong>Password:</strong> password
                            </td>
                        </tr>
                    </table>

                    <p style="line-height: 1.6; color: #718096; margin-bottom: 1.5rem;">
                        For your security, please safeguard this information. You can update your password after logging
                        in.
                    </p>

                    <div style="text-align: center;">
                        <a href="{{ route('campus.login') }}"
                            style="display: inline-block; padding: 0.75rem 1.5rem; font-size: 0.875rem; font-weight: 500; color: #ffffff; background-color: #3182ce; border-radius: 0.375rem; text-decoration: none; margin-top: 1rem;">
                            Proceed to login
                        </a>
                    </div>

                    <p style="margin-top: 2rem; color: #718096;">
                        Thanks,<br>
                        ZPPSU E-Marketplace team
                    </p>
                </div>

                <div style="margin-top: 2rem; border-top: 1px solid #e2e8f0; padding-top: 1rem;">
                    <p style="color: #a0aec0; font-size: 0.875rem;">
                        This email was sent to <a href="mailto:zppsu.emarketplace@gmail.com"
                            style="color: #3182ce; text-decoration: underline;">zppsu.emarketplace@gmail.com</a>.
                        If you'd rather not receive this kind of email, you can <a href="#"
                            style="color: #3182ce; text-decoration: underline;">unsubscribe</a> or <a href="#"
                            style="color: #3182ce; text-decoration: underline;">manage your email preferences</a>.
                    </p>

                    <p style="margin-top: 0.75rem; color: #a0aec0; font-size: 0.875rem;">© 2024 ZPPSU E-Marketplace. All
                        Rights Reserved.</p>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
