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

// Start session at the very beginning
session_start();

// Log session state on contact.php load
error_log("[contact.php] Session state on page load: " . print_r($_SESSION, true));

// Enable error reporting for debugging (after session_start)
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

// Set page title
$page_title = 'Contact Us';

// Include header
require_once 'includes/header.php';

// Debug: Log session data
error_log("Session data in contact.php: " . print_r($_SESSION, true));

// Get messages from session
$form_message = null;
if (isset($_SESSION['contact_form_message'])) {
    $form_message = $_SESSION['contact_form_message'];
    unset($_SESSION['contact_form_message']); // Clear the message after retrieving
    error_log("Form message retrieved from session: " . print_r($form_message, true));
}
?>

<main>
    <!-- Contact Form Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Contact Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <!-- Email -->
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-[#0B2447] rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Email Us</h3>
                        <p><a href="mailto:info@clhomeassist.co.za" class="text-[#0B2447] hover:text-yellow-500">info@clhomeassist.co.za</a></p>
                    </div>

                    <!-- Phone -->
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-[#0B2447] rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Call Us</h3>
                        <p><a href="tel:0835033081" class="text-[#0B2447] hover:text-yellow-500">083 503 3081</a></p>
                    </div>

                    <!-- Service Areas -->
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-[#0B2447] rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Service Areas</h3>
                        <p>Midrand, Sandton, Fourways, Randburg, Roodepoort, Krugersdorp, Soweto, Johannesburg South</p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-[#0B2447] rounded-lg shadow-lg p-8 mb-12">
                    <h2 class="text-3xl font-bold text-center mb-8 text-white">Get in Touch</h2>
                    
                    <?php if (isset($_SESSION['contact_form_message'])):
                        error_log("[contact.php] Displaying contact_form_message: " . print_r($_SESSION['contact_form_message'], true));
                    ?>
                        <div class="<?php echo $_SESSION['contact_form_message']['type'] === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700'; ?> border px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline"><?php echo htmlspecialchars($_SESSION['contact_form_message']['text']); ?></span>
                        </div>
                        <?php unset($_SESSION['contact_form_message']); // Unset after display
                        error_log("[contact.php] contact_form_message has been unset.");
                        ?>
                    <?php else:
                        error_log("[contact.php] contact_form_message NOT SET on page display block.");
                    ?>
                    <?php endif; ?>

                    <form method="POST" action="contact-process.php" id="contactForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <input type="text" name="first_name" placeholder="First Name*" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white"
                                    pattern="[A-Za-z\s]+"
                                    title="Please enter a valid first name (letters and spaces only)">
                            </div>
                            <div>
                                <input type="text" name="last_name" placeholder="Last Name*" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white"
                                    pattern="[A-Za-z\s]+"
                                    title="Please enter a valid last name (letters and spaces only)">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <input type="email" name="email" placeholder="Email Address*" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white">
                            </div>
                            <div>
                                <input type="tel" name="phone" placeholder="Phone Number"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white"
                                    pattern="[0-9\s\+\-]{10,}"
                                    title="Please enter a valid phone number (minimum 10 digits)">
                            </div>
                        </div>
                        <div class="mt-6">
                            <textarea name="message" placeholder="Your Message*" required rows="6"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white"
                                minlength="10"></textarea>
                        </div>
                        <div class="mt-6">
                            <button type="submit" name="submit" value="1"
                                class="bg-yellow-500 text-[#0B2447] px-8 py-3 rounded-lg font-bold hover:bg-yellow-600 transition duration-300 w-full md:w-auto">
                                Send Message
                            </button>
                        </div>
                        <input type="hidden" name="form_submitted" value="1">
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?> 