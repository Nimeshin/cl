<?php
declare(strict_types=1);

// Custom session configuration
$session_save_path = __DIR__ . '/includes/sessions';
if (!is_dir($session_save_path)) {
    mkdir($session_save_path, 0755, true);
}
ini_set('session.save_path', $session_save_path);
ini_set('session.use_only_cookies', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) ? '1' : '0'); // Set secure flag if HTTPS
ini_set('session.cookie_samesite', 'Lax'); // Mitigate CSRF

// Debug logging - Log more server variables at the VERY START
error_log("--- New Request to contact-process.php ---");
error_log("SERVER Content-Type: " . ($_SERVER['CONTENT_TYPE'] ?? 'N/A'));
error_log("SERVER Request Method: " . $_SERVER['REQUEST_METHOD']);
error_log("SERVER Request URI: " . $_SERVER['REQUEST_URI']);
error_log("SERVER Query String: " . $_SERVER['QUERY_STRING']);
error_log("SERVER HTTP Referer: " . ($_SERVER['HTTP_REFERER'] ?? 'N/A'));
error_log("SERVER Server Protocol: " . $_SERVER['SERVER_PROTOCOL']);
error_log("SERVER POST data: " . print_r($_POST, true));
error_log("SERVER GET data: " . print_r($_GET, true));
error_log("SERVER Request data (php://input): " . file_get_contents('php://input'));

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

// Start session
session_start();

// Debug logging (already present, but ensure it is after session_start)
// error_log("Request Method: " . $_SERVER['REQUEST_METHOD']); // This line is now covered by more detailed logging above
// error_log("POST data: " . print_r($_POST, true)); // This line is now covered by more detailed logging above

/**
 * Contact Form Processing Script
 * 
 * Handles the submission of the contact form and sends notification emails using PHPMailer.
 */

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

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validate required fields
    if (!$first_name || !$last_name || !$email || !$message) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        try {
            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            // Server settings for cPanel
            $mail->isSMTP();
            $mail->Host = 'localhost'; // cPanel mail server
            $mail->Port = 25; // Local SMTP port
            $mail->SMTPAuth = false; // No authentication needed for local mail server

            // Recipients
            $mail->setFrom('noreply@' . $_SERVER['HTTP_HOST'], $site_name);
            $mail->addAddress($admin_email);
            $mail->addReplyTo($email, "$first_name $last_name");

            // Content
            $mail->isHTML(false);
            $mail->Subject = "New Contact Form Submission - $site_name";
            
            // Prepare email content
            $email_content = "New contact form submission from $site_name:\n\n";
            $email_content .= "Name: $first_name $last_name\n";
            $email_content .= "Email: $email\n";
            if ($phone) {
                $email_content .= "Phone: $phone\n";
            }
            $email_content .= "\nMessage:\n$message\n";

            $mail->Body = $email_content;

            // Send email
            if ($mail->send()) {
                $success = true;
            } else {
                throw new Exception('Failed to send email');
            }
        } catch (Exception $e) {
            error_log('Contact form error: ' . $e->getMessage());
            $error_message = 'Sorry, there was an error sending your message. Please try again later. Details: ' . $e->getMessage();
        }
    }
}

// Debug logging
error_log("Session data before redirect: " . print_r($_SESSION, true));
session_write_close(); // Explicitly write and close session before redirect

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