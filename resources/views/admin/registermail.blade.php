
<div class="container">
    <h1>Registered successfully</h1>
    
<a href="{{ route('verify.token', ['remember_token' => $token])}}">Click here to verify</a>
    <p>Thank you.</p>
    <div class="footer">
        <p>Best regards,</p>
    </div>
</div>

