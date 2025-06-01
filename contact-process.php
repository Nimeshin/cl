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

// Check if form was submitted via POST and has the required token
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['form_submitted']) || $_POST['form_submitted'] !== '1') {
    error_log("[contact-process.php] Invalid form submission (method/token). Redirecting.");
    $_SESSION['contact_form_message'] = [
        'type' => 'error',
        'text' => 'Invalid form submission. Please try again.'
    ];
    session_write_close();
    header('Location: contact.php');
    exit;
}

// Validate and sanitize input
$first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
$last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '');
$phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '');
$message_raw = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? ''); // Keep raw for nl2br

// Debug logging: Sanitized input
error_log("[contact-process.php] Sanitized Input: First='$first_name', Last='$last_name', Email='$email', Phone='$phone', Msg='$message_raw'");

// Validate required fields
if (empty($first_name) || empty($last_name) || empty($email) || empty($message_raw)) {
    error_log("[contact-process.php] Validation failed: Required fields missing.");
    $_SESSION['contact_form_message'] = [
        'type' => 'error',
        'text' => 'Please fill in all required fields.'
    ];
    session_write_close();
    header('Location: contact.php');
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    error_log("[contact-process.php] Validation failed: Invalid email format for '$email'.");
    $_SESSION['contact_form_message'] = [
        'type' => 'error',
        'text' => 'Please enter a valid email address.'
    ];
    session_write_close();
    header('Location: contact.php');
    exit;
}

// Prepare email to admin
$to_admin = 'info@clhomeassist.co.za';
$subject_admin = 'New Contact Form Submission - CL Home Assist';
$headers_admin = [
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=UTF-8',
    'From: CL Home Assist <info@clhomeassist.co.za>', // Or a no-reply@yourdomain.com
    'Reply-To: ' . htmlspecialchars($first_name . ' ' . $last_name) . ' <' . htmlspecialchars($email) . '>',
    'X-Mailer: PHP/' . phpversion()
];
$message_admin_html = "
<html><body>
    <h2>New Contact Form Submission</h2>
    <p><strong>Name:</strong> " . htmlspecialchars($first_name) . " " . htmlspecialchars($last_name) . "</p>
    <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
    " . (!empty($phone) ? "<p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>" : "") . "
    <p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message_raw)) . "</p>
</body></html>";

error_log("[contact-process.php] Attempting to send email to admin: $to_admin");
$success_admin = mail($to_admin, $subject_admin, $message_admin_html, implode("\r\n", $headers_admin));

if ($success_admin) {
    error_log("[contact-process.php] Email to admin sent successfully.");
    $_SESSION['contact_form_message'] = [
        'type' => 'success',
        'text' => 'Thank you for your message! We will get back to you soon.'
    ];
    error_log("[contact-process.php] SUCCESS message SET. Session data: " . print_r($_SESSION, true));

    // Prepare confirmation email to user
    $subject_user = 'Thank you for contacting CL Home Assist';
    $headers_user = [
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: CL Home Assist <info@clhomeassist.co.za>',
        'X-Mailer: PHP/' . phpversion()
    ];
    $message_user_html = "
    <html><body>
        <h2>Thank You for Contacting Us</h2>
        <p>Dear " . htmlspecialchars($first_name) . ",</p>
        <p>Thank you for contacting CL Home Assist. We have received your message and will get back to you as soon as possible.</p>
        <p>For urgent matters, please call us at: 083 503 3081</p>
        <p>Best regards,<br>The CL Home Assist Team</p>
    </body></html>";
    
    error_log("[contact-process.php] Attempting to send confirmation email to user: $email");
    mail($email, $subject_user, $message_user_html, implode("\r\n", $headers_user));

} else {
    error_log("[contact-process.php] FAILED to send email to admin.");
    $_SESSION['contact_form_message'] = [
        'type' => 'error',
        'text' => 'Sorry, there was a problem sending your message. Please try again later.'
    ];
    error_log("[contact-process.php] ERROR message SET. Session data: " . print_r($_SESSION, true));
}

error_log("[contact-process.php] Session data IMMEDIATELY BEFORE final session_write_close() and redirect: " . print_r($_SESSION, true));
session_write_close();
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