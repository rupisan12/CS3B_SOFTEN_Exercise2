<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$email = trim($_POST['email']);
$otp = rand(100000, 999999);
$otp_expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));
}

$clear_sql = "DELETE FROM users WHERE email = ?";
$clear_stmt = $conn->prepare($clear_sql);
$clear_stmt->bind_param("s", $email);
$clear_stmt-> execute();

$sql = 'INSERT INTO users (email, otp_code, otp_expiry) VALUES(?, ?, ?)';
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("sss", $email, $otp, $otp_expiry);

if ($stmt -> execute()) {
    echo "OTP stored in database: $otp (expires: $otp_expiry)<br>";

    sendOtpEmail($email, $otp);

    header("Location: verify.php?email=".urlencode($email));
    exit();
} else {
    echo "Error: " . $stmt->error;

}
function sendOtpEmail($email, $otp){
$mail = new PHPMailer(true);

try {
    $mail -> isSMTP();
    $mail -> Host       =   'smtp.gmail.com';
    $mail -> SMTPAuth   =   true;
    $mail -> Username   =   'nasipurcharlote2722@gmail.com';
    $mail -> Password   =   'sled yzef fbzj cpmu';
    $mail -> SMTPSecure =   PHPMailer::ENCRYPTION_STARTTLS;
    $mail -> Port       =   587;

    $mail -> setFrom('nasipurcharlote2722@gmail.com', "OTP Verification");
    $mail -> addAddress($email);

    $mail -> isHTML(true);
    $mail -> Subject    =   "Your OTP Code";
    $mail -> Body       =   "Your OTP Code is: <b>$otp</b><br><br>
                            The code will expire in 5 minutes.<br>
                            <a href='https://localhost/email/verify.php?email=".urlencode($email)."'>Click here to verify</a>";

    $mail -> send();
} catch(Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail -> ErrorInfo}";
}
}
?>