<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Password Verfication</title>
</head>
<body>
    <h1>Email OTP Verification</h1>
    <form action="send_otp.php" method="POST">
        <input type="email" name="email" placeholder="Enter a valid email" required>
        <button type="submit">Send OTP Request</button>
    </form>
</body>
</html>