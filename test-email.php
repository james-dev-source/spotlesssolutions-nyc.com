<?php
$to = "jamesc2128@gmail.com";
$subject = "TEST EMAIL FROM GODADDY";
$message = "This is a test email to verify PHP mail() works";
$headers = "From: test@spotlesssolutionsnyc.com\r\n";

$result = mail($to, $subject, $message, $headers);

if ($result) {
    echo "SUCCESS: Email sent!!!!";
} else {
    echo "FAILED: Email did not send!!!";
}