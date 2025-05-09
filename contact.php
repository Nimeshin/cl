<?php
declare(strict_types=1);

// Set page title
$page_title = 'Contact Us';

// Include header
require_once 'includes/header.php';

// Initialize variables
$success_message = $error_message = '';

// Get success/error messages from URL parameters
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success_message = 'Thank you for your message! We will get back to you soon.';
}

if (isset($_GET['error'])) {
    $error_message = urldecode($_GET['error']);
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
                    
                    <?php if ($success_message): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline"><?php echo htmlspecialchars($success_message); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($error_message): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline"><?php echo htmlspecialchars($error_message); ?></span>
                        </div>
                    <?php endif; ?>

                    <form action="contact-process.php" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <input type="text" name="first_name" placeholder="First Name*" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white">
                            </div>
                            <div>
                                <input type="text" name="last_name" placeholder="Last Name*" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <input type="email" name="email" placeholder="Email Address*" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white">
                            </div>
                            <div>
                                <input type="tel" name="phone" placeholder="Phone Number"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white">
                            </div>
                        </div>
                        <div>
                            <textarea name="message" placeholder="Your Message*" required rows="6"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-500 bg-white"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="bg-yellow-500 text-[#0B2447] px-8 py-3 rounded-lg font-bold hover:bg-yellow-600 transition duration-300">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?> 