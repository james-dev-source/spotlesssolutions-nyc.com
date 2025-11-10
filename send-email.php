<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    http_response_code(200);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // DEBUG: Write received data to file
    //file_put_contents('/tmp/form-data.txt', 'Data received at: ' . date('Y-m-d H:i:s') . "\n" . file_get_contents('php://input'));
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $name = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $phone = $data['phone'] ?? '';
    $service = $data['service'] ?? '';
    
    $to = "jamesc2128@gmail.com";
    $subject = "New Quote Request from $name";
    $headers = "From: info@spotlesssolutionsnyc.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    $message = "Name: $name\nEmail: $email\nPhone: $phone\nService: $service\n";
    
    $success = mail($to, $subject, $message, $headers);
    
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>