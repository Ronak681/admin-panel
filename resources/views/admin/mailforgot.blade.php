
<div class="container">
    <h1>Password Reset Request</h1>
    <p>Dear  user,</p>
    <p>We received a request to reset your password for your account. If you did not request this change, please disregard this email.</p>
    <p>To reset your password, please click the link below:</p>
    <a href="{{ route('reset.password.get',$token)}}"> Reset Password</a>

    <p>The link will direct you to a page where you can enter a new password. If the link has expired, you will need to request a new password reset.</p>
    <p>If you need further assistance or did not request a password reset, please contact our support team at <a href="mailto:[Support Email]">info@gmail.com</a>.</p>
    <p>Thank you.</p>
    <div class="footer">
        <p>Best regards,</p>
    </div>
</div>

