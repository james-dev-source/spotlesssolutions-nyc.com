<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON data from JavaScript fetch
    $data = json_decode(file_get_contents('php://input'), true);
    
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
    
    $to = "Spotless.solutions1105@gmail.com";
    $subject = "New Quote Request from $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    $success = mail($to, $subject, $message, $headers);
    
    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Quote request sent!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error sending email']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>