<?php 
require 'config.php';
$email = isset($_GET['email']) ? trim($_GET['email']): '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <h1>Verify Your OTP</h1>
    <form action = "verify_otp.php" method="POST">
        <input type="email" name="email" value="<?php echo htmlspecialchars($email)?>">
        <input type="text" name="otp" placeholder="Enter 6-digit OTP" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>