<?php
declare(strict_types=1);

// Custom session configuration (ensure this matches contact-process.php)
$session_save_path = __DIR__ . '/includes/sessions';
if (!is_dir($session_save_path)) { mkdir($session_save_path, 0755, true); }
ini_set('session.save_path', $session_save_path);
ini_set('session.use_only_cookies', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) ? '1' : '0');
ini_set('session.cookie_samesite', 'Lax');

session_start();
error_log("[contact.php MINIMAL TEST] Session state on page load: " . print_r($_SESSION, true));

$display_message_text = null;
$display_message_type_class = '';

if (isset($_SESSION['contact_form_message'])) {
    error_log("[contact.php MINIMAL TEST] contact_form_message IS SET.");
    $message_data = $_SESSION['contact_form_message'];
    $display_message_text = htmlspecialchars($message_data['text'] ?? 'Error: Message text missing.');
    $is_success = ($message_data['type'] ?? 'error') === 'success';
    $display_message_type_class = $is_success ? 'background-color:lightgreen; color:green; border:1px solid green; padding:10px; margin:10px;' : 'background-color:pink; color:red; border:1px solid red; padding:10px; margin:10px;';
    unset($_SESSION['contact_form_message']);
    error_log("[contact.php MINIMAL TEST] contact_form_message has been processed and unset.");
} else {
    error_log("[contact.php MINIMAL TEST] contact_form_message NOT SET.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Minimal Test</title>
</head>
<body>
    <h1>Contact Page (Minimal Test)</h1>

    <?php if ($display_message_text): ?>
        <div style="<?php echo $display_message_type_class; ?>">
            <?php echo $display_message_text; ?>
        </div>
    <?php endif; ?>

    <p>This is a minimal contact page to test session messages.</p>
    <p><a href="contact.php">Reload page (to see if message disappears after unset)</a></p>

    <!-- A very basic form to allow re-testing if needed -->
    <hr>
    <form method="POST" action="contact-process.php">
        <input type="hidden" name="form_submitted" value="1">
        <label>First Name: <input type="text" name="first_name" value="TestFirst" required></label><br>
        <label>Last Name: <input type="text" name="last_name" value="TestLast" required></label><br>
        <label>Email: <input type="email" name="email" value="test@example.com" required></label><br>
        <label>Message: <textarea name="message" required>Minimal test message.</textarea></label><br>
        <button type="submit" name="submit" value="1">Send Test Message</button>
    </form>

</body>
</html> 