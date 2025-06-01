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
error_log("Raw POST data: " . file_get_contents('php://input'));
error_log("POST array: " . print_r($_POST, true));

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

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Set header to prevent caching
    header('Cache-Control: no-cache, must-revalidate');
    header('Content-Type: application/json');
    
    try {
        // Validate form data
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Debug: Log sanitized data
        error_log("Sanitized Form Data:");
        error_log("First Name: $first_name");
        error_log("Last Name: $last_name");
        error_log("Email: $email");
        error_log("Phone: $phone");
        error_log("Message: $message");

        // Validate required fields
        if (!$first_name || !$last_name || !$email || !$message) {
            throw new Exception('Please fill in all required fields.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Please enter a valid email address.');
        }

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        // Enable verbose debug output
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Debugoutput = function($str, $level) {
            error_log("PHPMailer Debug [$level]: $str");
        };

        // Server settings for cPanel
        $mail->isSMTP();
        $mail->Host = 'mail.clhomeassist.co.za';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@clhomeassist.co.za';
        $mail->Password = 'Cl@ssist2024';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Debug: Test SMTP connection
        try {
            $smtp = fsockopen($mail->Host, $mail->Port, $errno, $errstr, 30);
            if (!$smtp) {
                error_log("SMTP Connection Error: $errstr ($errno)");
            } else {
                error_log("SMTP Connection Successful");
                fclose($smtp);
            }
        } catch (Exception $e) {
            error_log("SMTP Connection Test Error: " . $e->getMessage());
        }

        // Recipients
        $mail->setFrom('info@clhomeassist.co.za', $site_name);
        $mail->addAddress($admin_email);
        $mail->addReplyTo($email, "$first_name $last_name");

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission - $site_name";
        
        // Prepare email content
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
                    <p><strong>Name:</strong> $first_name $last_name</p>
                    <p><strong>Email:</strong> $email</p>
                    " . ($phone ? "<p><strong>Phone:</strong> $phone</p>" : "") . "
                    <p><strong>Message:</strong><br>$message</p>
                </div>
                <div class='footer'>
                    <p>This email was sent from the contact form at clhomeassist.co.za</p>
                </div>
            </div>
        </body>
        </html>";

        $mail->Body = $email_content;
        $mail->AltBody = "New contact form submission from $site_name:\n\n"
            . "Name: $first_name $last_name\n"
            . "Email: $email\n"
            . ($phone ? "Phone: $phone\n" : "")
            . "\nMessage:\n$message";

        // Debug: Log before sending
        error_log("Attempting to send email...");

        // Send email
        if ($mail->send()) {
            error_log("Main email sent successfully");
            $success = true;

            // Send confirmation email
            try {
                $confirmationMail = new PHPMailer(true);
                $confirmationMail->isSMTP();
                $confirmationMail->Host = 'mail.clhomeassist.co.za';
                $confirmationMail->SMTPAuth = true;
                $confirmationMail->Username = 'info@clhomeassist.co.za';
                $confirmationMail->Password = 'Cl@ssist2024';
                $confirmationMail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $confirmationMail->Port = 465;
                
                $confirmationMail->setFrom('info@clhomeassist.co.za', $site_name);
                $confirmationMail->addAddress($email, "$first_name $last_name");
                
                $confirmationMail->isHTML(true);
                $confirmationMail->Subject = "Thank you for contacting $site_name";
                
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
                            <p>Dear $first_name,</p>
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
                
                $confirmationMail->Body = $confirmation_content;
                $confirmationMail->AltBody = "Dear $first_name,\n\n"
                    . "Thank you for contacting CL Home Assist. We have received your message and will get back to you as soon as possible.\n\n"
                    . "For urgent matters, please call us at: 083 503 3081\n\n"
                    . "Best regards,\nThe CL Home Assist Team";
                
                $confirmationMail->send();
                error_log("Confirmation email sent successfully");
            } catch (Exception $e) {
                error_log("Error sending confirmation email: " . $e->getMessage());
                // Don't set error message here as the main email was sent successfully
            }
        } else {
            throw new Exception("Failed to send email");
        }
    } catch (Exception $e) {
        error_log("Contact form error: " . $e->getMessage());
        $error_message = $e->getMessage();
    }

    // Store messages in session and return JSON response
    if ($success) {
        $_SESSION['contact_form_message'] = [
            'type' => 'success',
            'text' => 'Thank you for your message! We will get back to you soon.'
        ];
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
    } elseif ($error_message) {
        $_SESSION['contact_form_message'] = [
            'type' => 'error',
            'text' => $error_message
        ];
        echo json_encode(['status' => 'error', 'message' => $error_message]);
    }

    // Debug: Log session data
    error_log("Session data before response: " . print_r($_SESSION, true));
} else {
    // Handle non-POST requests
    $_SESSION['contact_form_message'] = [
        'type' => 'error',
        'text' => 'Invalid request method. Please try again.'
    ];
    
    // Return JSON error for API requests
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        exit;
    }
    
    // Redirect for direct browser requests
    header('Location: contact.php');
    exit;
}

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