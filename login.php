<?php
require "config.php";

if (isset($_GET['email'])) {
    $email = trim($_GET['email']);
    $check_sql = "SELECT is_verified FROM users WHERE email = ?";
    $check_stmt = $conn -> prepare($check_sql);
    $check_stmt -> bind_param("s", $email);
    $check_stmt -> execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0 && $result->fetch_assoc()['is_verified'] == 1){
        ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Info</title>
    </head>
    <body>
        <h2>Christian Rupisan</h2>
        <h3>NLP-22-02113</h3>
        <p>Your email <?php echo htmlspecialchars($email);?> has been succesfully verified</p>
    </body>
    </html>
        <?php

    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

