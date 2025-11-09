<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle CORS preflight
if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    http_response_code(200);
    exit();
}

// Accept both GET and POST
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    
    // Get data from POST or GET
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_GET;
    }
    
    $name = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $service = $data['service'] ?? '';
    $bedrooms = $data['bedrooms'] ?? '';
    $bathrooms = $data['bathrooms'] ?? '';
    $frequency = $data['frequency'] ?? '';
    $phone = $data['phone'] ?? '';
    $preferred_date = $data['preferred_date'] ?? '';
    
    $message = "New Quote Request\n\n";
    $message .= "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Phone: $phone\n";
    $message .= "Service: $service\n";
    $message .= "Bedrooms: $bedrooms\n";
    $message .= "Bathrooms: $bathrooms\n";
    $message .= "Frequency: $frequency\n";
    $message .= "Preferred Date: $preferred_date\n";
    
    $to = "Sjamesc2128@gmail.com";
    $subject = "New Quote Request from $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    $success = mail($to, $subject, $message, $headers);
    
    if ($success) {
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Quote request sent!']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error sending email']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>