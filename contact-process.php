<?php
declare(strict_types=1);

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

// Display errors in development
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
            $mail->Host = 'mail.clhomeassist.co.za'; // Your cPanel mail server
            $mail->SMTPAuth = true;
            $mail->Username = 'info@clhomeassist.co.za'; // Your cPanel email
            $mail->Password = 'your_email_password'; // Your cPanel email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit SSL
            $mail->Port = 465; // SSL port

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

            // Send email
            if ($mail->send()) {
                $success = true;
                
                // Send confirmation email to the user
                $confirmationMail = new PHPMailer(true);
                $confirmationMail->isSMTP();
                $confirmationMail->Host = 'mail.clhomeassist.co.za';
                $confirmationMail->SMTPAuth = true;
                $confirmationMail->Username = 'info@clhomeassist.co.za';
                $confirmationMail->Password = 'your_email_password';
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
            } else {
                throw new Exception('Failed to send email');
            }
        } catch (Exception $e) {
            error_log('Contact form error: ' . $e->getMessage());
            $error_message = 'Sorry, there was an error sending your message. Please try again later.';
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