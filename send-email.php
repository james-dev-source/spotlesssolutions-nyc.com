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
    
    $type = $data['type'] ?? 'Quote';

    if ($type === "Quote") {
        $name = $data['name'] ?? '';
        $email = $data['email'] ?? '';
        $phone = $data['phone'] ?? '';
        $service = $data['service'] ?? '';
        $bedrooms = $data['bedrooms'] ?? '';
        $bathrooms = $data['bathrooms'] ?? '';
        $frequency = $data['frequency'] ?? '';
        $preferred_date = $data['preferred_date'] ?? '';
        $notes = '';
        $message = "New Quote Request\n";
    } else {
         // Booking form
        $name = $data['book_name'] ?? '';
        $email = $data['book_email'] ?? '';
        $phone = $data['book_phone'] ?? '';
        $service = $data['book_service'] ?? '';
        $bedrooms = $data['book_bedrooms'] ?? '';
        $bathrooms = $data['book_bathrooms'] ?? '';
        $frequency = $data['book_frequency'] ?? '';
        $preferred_date = $data['book_date'] ?? '';
        $notes = $data['book_notes'] ?? '';        
        $message = "New Appointment Request\n";  
    }

    $message .= "==========================================\n\n";
    $message .= "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Phone: $phone\n";
    $message .= "Service: $service\n";
    $message .= "Rooms: $bedrooms\n";
    $message .= "Restrooms: $bathrooms\n";
    $message .= "Frequency: $frequency\n";
    $message .= "Preferred Date: $preferred_date\n";
    $message .= "Type: $type\n";
    if (!empty($notes)) {
        $message .= "Notes: $notes\n";
    }
    $message .= "\n==========================================\n";

    $to = "info@spotlesssolutionsnyc.com";
    $subject = "New Quote Request from $name";

    $headers = "From: SpotlessSolutionsNYC@spotlesssolutionsnyc.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $success = mail($to, $subject, $message, $headers);
    
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>