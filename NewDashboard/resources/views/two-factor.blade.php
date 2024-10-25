<form action="{{ route('2fa.verify') }}" method="POST">
    @csrf
    <label for="otp">Enter OTP:</label>
    <input type="text" name="otp" id="otp" required>
    <button type="submit">Verify</button>
</form>
