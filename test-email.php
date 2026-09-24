<?php
require 'phpmailer/Exception.php';
//require 'phpmailer/DSNConfigurator.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@spotlesssolutionsnyc.com';
    $mail->Password = 'InfoNYC1105!';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Timeout = 15;
    
    // Try to connect
    $mail->smtpConnect();
    
    echo "✅ SMTP Connection Successful!";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
    echo "<br>Error Code: " . $mail->ErrorInfo;
}
?>