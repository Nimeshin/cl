<?php
declare(strict_types=1);

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

// Start session
session_start();

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
                    
                    <?php if ($form_message): ?>
                        <div class="<?php echo $form_message['type'] === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700'; ?> border px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline"><?php echo htmlspecialchars($form_message['text']); ?></span>
                        </div>
                    <?php endif; ?>

                    <form action="contact-process.php" method="POST" class="space-y-6" id="contactForm" novalidate>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <input type="text" name="first_name" placeholder="First Name*" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white"
                                    pattern="[A-Za-z ]+"
                                    title="Please enter a valid first name (letters and spaces only)">
                                <div class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                            <div>
                                <input type="text" name="last_name" placeholder="Last Name*" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white"
                                    pattern="[A-Za-z ]+"
                                    title="Please enter a valid last name (letters and spaces only)">
                                <div class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <input type="email" name="email" placeholder="Email Address*" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                    title="Please enter a valid email address">
                                <div class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                            <div>
                                <input type="tel" name="phone" placeholder="Phone Number"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white"
                                    pattern="[0-9+ -]{10,}"
                                    title="Please enter a valid phone number (minimum 10 digits)">
                                <div class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                        </div>
                        <div>
                            <textarea name="message" placeholder="Your Message*" required rows="6"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white"
                                minlength="10"
                                title="Please enter a message (minimum 10 characters)"></textarea>
                            <div class="text-red-500 text-sm mt-1 hidden"></div>
                        </div>
                        <div>
                            <button type="submit"
                                class="bg-yellow-500 text-[#0B2447] px-8 py-3 rounded-lg font-bold hover:bg-yellow-600 transition duration-300 relative">
                                <span class="flex items-center justify-center">
                                    <span>Send Message</span>
                                    <span class="loading-spinner ml-2 hidden">
                                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitButton = form.querySelector('button[type="submit"]');
    const loadingSpinner = submitButton.querySelector('.loading-spinner');
    
    // Function to show error message
    function showError(input, message) {
        const errorDiv = input.nextElementSibling;
        errorDiv.textContent = message;
        errorDiv.classList.remove('hidden');
        input.classList.add('border-red-500');
    }
    
    // Function to hide error message
    function hideError(input) {
        const errorDiv = input.nextElementSibling;
        errorDiv.classList.add('hidden');
        input.classList.remove('border-red-500');
    }
    
    // Validate individual input
    function validateInput(input) {
        hideError(input);
        
        if (input.required && !input.value.trim()) {
            showError(input, `${input.placeholder.replace('*', '')} is required`);
            return false;
        }
        
        if (input.pattern && input.value.trim()) {
            const regex = new RegExp(input.pattern);
            if (!regex.test(input.value.trim())) {
                showError(input, input.title);
                return false;
            }
        }
        
        if (input.name === 'message' && input.value.trim().length < 10) {
            showError(input, 'Message must be at least 10 characters long');
            return false;
        }
        
        return true;
    }
    
    // Add validation on input
    form.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', () => validateInput(input));
        input.addEventListener('blur', () => validateInput(input));
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate all inputs
        let isValid = true;
        form.querySelectorAll('input, textarea').forEach(input => {
            if (!validateInput(input)) {
                isValid = false;
            }
        });
        
        if (isValid) {
            // Show loading spinner
            submitButton.disabled = true;
            loadingSpinner.classList.remove('hidden');
            
            // Submit the form
            this.submit();
        }
    });
});
</script>

<?php require_once 'includes/footer.php'; ?> 