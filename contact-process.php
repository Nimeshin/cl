<?php
declare(strict_types=1);

/**
 * Contact Form Processing Script
 * 
 * Handles the submission of the contact form and sends notification emails.
 */

// Configuration
$admin_email = 'info@clhomeassist.co.za';
$site_name = 'CL Home Assist';

// Display errors in development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$success = false;
$error_message = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (!$first_name || !$last_name || !$email || !$message) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        // Prepare email content
        $to = $admin_email;
        $subject = "New Contact Form Submission - $site_name";
        $email_content = "New contact form submission from $site_name:\n\n";
        $email_content .= "Name: $first_name $last_name\n";
        $email_content .= "Email: $email\n";
        if ($phone) {
            $email_content .= "Phone: $phone\n";
        }
        $email_content .= "\nMessage:\n$message\n";

        // Email headers
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Send email
        try {
            if (mail($to, $subject, $email_content, $headers)) {
                $success = true;
            } else {
                throw new Exception('Failed to send email');
            }
        } catch (Exception $e) {
            error_log('Contact form error: ' . $e->getMessage());
            $error_message = 'Sorry, there was an error sending your message. Please try again later. Details: ' . $e->getMessage();
            // Add more details if mail() returned false and set an error
            $last_error = error_get_last();
            if ($last_error && $last_error['type'] === E_WARNING) {
                $error_message .= ' PHP Warning: ' . $last_error['message'];
            }
        }
    }
}

// Redirect based on result
if ($success) {
    header('Location: contact.php?success=1');
} else {
    header('Location: contact.php?error=' . urlencode($error_message));
}
exit;

// Function to save form submission to database (if needed)
function saveToDatabase(array $data): void {
    // Implement database storage logic here
    // Example:
    /*
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=your_database", "username", "password");
        $stmt = $pdo->prepare("INSERT INTO contact_submissions (first_name, last_name, email, phone, message, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['message']
        ]);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
    }
    */
} 