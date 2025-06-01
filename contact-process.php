<?php
declare(strict_types=1);

/**
 * Contact Form Processing Script
 * 
 * Handles the submission of the contact form and sends notification emails using PHPMailer.
 */

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

// Start session at the beginning
session_start();

// Debug: Log request method and raw POST data
error_log("Request Method: " . $_SERVER['REQUEST_METHOD']);
error_log("POST data: " . print_r($_POST, true));

// Check if Composer's autoloader exists
if (!file_exists('vendor/autoload.php')) {
    error_log("Error: vendor/autoload.php not found");
    $_SESSION['contact_form_message'] = [
        'type' => 'error',
        'text' => 'System configuration error. Please contact the administrator.'
    ];
    header('Location: contact.php');
    exit;
}

// Include Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Configuration
$admin_email = 'info@clhomeassist.co.za';
$site_name = 'CL Home Assist';

// Initialize variables
$success = false;
$error_message = '';

// Check if form was submitted via POST and has the required token
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['form_submitted']) || $_POST['form_submitted'] !== '1') {
    $_SESSION['contact_form_message'] = [
        'type' => 'error',
        'text' => 'Invalid form submission. Please try again.'
    ];
    header('Location: contact.php');
    exit;
}

// Validate and sanitize input
$first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Debug logging
error_log("Sanitized input:");
error_log("First Name: " . $first_name);
error_log("Last Name: " . $last_name);
error_log("Email: " . $email);
error_log("Phone: " . $phone);
error_log("Message: " . $message);

// Validate required fields
if (!$first_name || !$last_name || !$email || !$message) {
    $_SESSION['contact_form_message'] = [
        'type' => 'error',
        'text' => 'Please fill in all required fields.'
    ];
    header('Location: contact.php');
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['contact_form_message'] = [
        'type' => 'error',
        'text' => 'Please enter a valid email address.'
    ];
    header('Location: contact.php');
    exit;
}

// Prepare email content
$to = 'info@clhomeassist.co.za';
$subject = 'New Contact Form Submission - CL Home Assist';
$headers = array(
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=UTF-8',
    'From: CL Home Assist <info@clhomeassist.co.za>',
    'Reply-To: ' . $first_name . ' ' . $last_name . ' <' . $email . '>',
    'X-Mailer: PHP/' . phpversion()
);

$email_content = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #0B2447; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background-color: #f9f9f9; }
        .footer { text-align: center; padding: 20px; color: #666; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>New Contact Form Submission</h2>
        </div>
        <div class='content'>
            <p><strong>Name:</strong> " . htmlspecialchars($first_name) . " " . htmlspecialchars($last_name) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
            " . ($phone ? "<p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>" : "") . "
            <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>
        </div>
        <div class='footer'>
            <p>This email was sent from the contact form at clhomeassist.co.za</p>
        </div>
    </div>
</body>
</html>";

// Debug logging
error_log("Attempting to send email to: " . $to);

// Send email
$success = mail($to, $subject, $email_content, implode("\r\n", $headers));

if ($success) {
    error_log("Main email sent successfully");
    
    // Send confirmation email to user
    $confirmation_subject = 'Thank you for contacting CL Home Assist';
    $confirmation_headers = array(
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: CL Home Assist <info@clhomeassist.co.za>'
    );
    
    $confirmation_content = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #0B2447; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; background-color: #f9f9f9; }
            .footer { text-align: center; padding: 20px; color: #666; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Thank You for Contacting Us</h2>
            </div>
            <div class='content'>
                <p>Dear " . htmlspecialchars($first_name) . ",</p>
                <p>Thank you for contacting CL Home Assist. We have received your message and will get back to you as soon as possible.</p>
                <p>For urgent matters, please call us at: 083 503 3081</p>
                <p>Best regards,<br>The CL Home Assist Team</p>
            </div>
            <div class='footer'>
                <p>This is an automated response, please do not reply to this email.</p>
            </div>
        </div>
    </body>
    </html>";
    
    mail($email, $confirmation_subject, $confirmation_content, implode("\r\n", $confirmation_headers));
    error_log("Confirmation email sent to: " . $email);
    
    $_SESSION['contact_form_message'] = [
        'type' => 'success',
        'text' => 'Thank you for your message! We will get back to you soon.'
    ];
} else {
    error_log("Failed to send email");
    $_SESSION['contact_form_message'] = [
        'type' => 'error',
        'text' => 'Sorry, there was a problem sending your message. Please try again later.'
    ];
}

// Debug logging
error_log("Session data before redirect: " . print_r($_SESSION, true));

// Redirect back to contact form
header('Location: contact.php');
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