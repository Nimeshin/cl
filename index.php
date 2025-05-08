<?php
declare(strict_types=1);

// Set page title
$page_title = 'Home';

// Include header
require_once 'includes/header.php';
?>

<main>
<!-- Hero Section -->
    <section class="relative h-[600px] bg-cover bg-center" style="background-image: url('images/home-banner.png');">
        <div class="container mx-auto px-4 h-full flex items-center relative z-10">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 text-[#0B2447] text-shadow">Your Trusted Plumbing and Electrical Experts</h1>
                <div class="mb-8">
                    <a href="contact.php" class="bg-[#0B2447] text-white px-8 py-3 inline-block rounded font-semibold hover:bg-blue-800 transition duration-300">CALL US NOW</a>
                </div>
                <p class="text-xl mb-8 text-[#0B2447] font-medium text-shadow">At CL Home, we are dedicated to providing top-notch plumbing and electrical services to homes and businesses. With years of experience in the industry, our skilled team of certified professionals is committed to delivering reliable, efficient, and affordable solutions tailored to meet your needs.</p>
        </div>
    </div>
</section>

    <!-- Features Section -->
    <section class="py-12 bg-white">
    <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="p-6 flex flex-col items-center">
                    <img src="images/icons/icon01.png" alt="Expert Technicians" class="w-28 h-28 object-contain mb-6">
                    <h3 class="text-lg font-semibold mb-2 text-yellow-500">Expert Technicians</h3>
                    <p class="text-gray-600">Our team brings years of experience and expertise to every job, ensuring quality workmanship in every project.</p>
                </div>
                <div class="p-6 flex flex-col items-center">
                    <img src="images/icons/icon02.png" alt="Affordable Rates" class="w-28 h-28 object-contain mb-6">
                    <h3 class="text-lg font-semibold mb-2 text-yellow-500">Affordable Rates</h3>
                    <p class="text-gray-600">We provide high-quality services at competitive prices to ensure good value for your investment.</p>
                </div>
                <div class="p-6 flex flex-col items-center">
                    <img src="images/icons/icon03.png" alt="Client Satisfaction" class="w-28 h-28 object-contain mb-6">
                    <h3 class="text-lg font-semibold mb-2 text-yellow-500">Client Satisfaction</h3>
                    <p class="text-gray-600">We dedicate ourselves to providing quality service and exceeding your expectations.</p>
                </div>
                <div class="p-6 flex flex-col items-center">
                    <img src="images/icons/icon04.png" alt="24/7 Service" class="w-28 h-28 object-contain mb-6">
                    <h3 class="text-lg font-semibold mb-2 text-yellow-500">24/7 Service</h3>
                    <p class="text-gray-600">We're available around the clock for your emergency plumbing and electrical needs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Banner -->
    <section class="py-12 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-[#0B2447] to-[#1B4D89] z-0">
            <div class="absolute inset-0 water-ripple opacity-15"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col items-center justify-center">
                <!-- Text and BEE Logo Row -->
                <div class="flex flex-col md:flex-row items-center justify-center mb-8 text-center">
                    <div class="max-w-2xl text-center">
                        <h2 class="text-3xl font-bold mb-2 text-white">Whether it's a minor repair or a large installation project, trust CL Home to get the job done right the first time!</h2>
                        <p class="text-xl mb-6 md:mb-0 text-white">Explore our services and contact us today for a free consultation!</p>
                    </div>
                    <img src="images/bee level1.png" alt="BEE Level 1" class="h-36 md:h-44 mt-6 md:mt-0 md:ml-8">
                </div>
                
                <!-- Call to Action Button -->
                <div class="w-full max-w-md flex justify-center">
                    <a href="contact.php" class="bg-yellow-500 hover:bg-yellow-400 text-blue-900 px-10 py-4 rounded-lg font-bold text-xl transition duration-300 transform hover:scale-105 shadow-lg w-full md:w-auto text-center">CALL US NOW</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="overflow-hidden rounded shadow-md">
                    <div class="aspect-square max-h-64 w-full">
                        <img src="images/General-Plumbing-Repairs.jpg" alt="General Plumbing Repairs" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 bg-blue-900 text-white text-center">
                        <h3 class="text-lg font-semibold">General Plumbing Repairs</h3>
                </div>
                </div>
                <div class="overflow-hidden rounded shadow-md">
                    <div class="aspect-square max-h-64 w-full">
                        <img src="images/leak detection.png" alt="Leak Detection" class="w-full h-full object-cover">
            </div>
                    <div class="p-4 bg-blue-900 text-white text-center">
                        <h3 class="text-lg font-semibold">Leak Detection</h3>
                </div>
                </div>
                <div class="overflow-hidden rounded shadow-md">
                    <div class="aspect-square max-h-64 w-full">
                        <img src="images/geyser installations.png" alt="Geyser Installations" class="w-full h-full object-cover">
            </div>
                    <div class="p-4 bg-blue-900 text-white text-center">
                        <h3 class="text-lg font-semibold">Geyser Installations</h3>
                </div>
                </div>
                <div class="overflow-hidden rounded shadow-md">
                    <div class="aspect-square max-h-64 w-full">
                        <img src="images/burst pipe repairs.png" alt="Burst Pipe Repairs" class="w-full h-full object-cover">
            </div>
                    <div class="p-4 bg-blue-900 text-white text-center">
                        <h3 class="text-lg font-semibold">Burst Pipe Repairs</h3>
        </div>
    </div>
                <div class="overflow-hidden rounded shadow-md">
                    <div class="aspect-square max-h-64 w-full">
                        <img src="images/Expert-Drain-Cleaning-Services.jpg" alt="Expert Drain Cleaning Services" class="w-full h-full object-cover">
            </div>
                    <div class="p-4 bg-blue-900 text-white text-center">
                        <h3 class="text-lg font-semibold">Expert Drain Cleaning Services</h3>
            </div>
        </div>
                <div class="overflow-hidden rounded shadow-md">
                    <div class="aspect-square max-h-64 w-full">
                        <img src="images/Bathroom-Renovations.jpg" alt="Bathroom Renovations" class="w-full h-full object-cover">
    </div>
                    <div class="p-4 bg-blue-900 text-white text-center">
                        <h3 class="text-lg font-semibold">Bathroom Renovations</h3>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <a href="services.php" class="inline-block bg-yellow-500 text-blue-900 px-8 py-3 rounded font-semibold hover:bg-yellow-400 transition duration-300">LEARN MORE</a>
        </div>
    </div>
</section>

    <!-- Testimonials -->
    <section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-blue-900">Satisfied clients</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex text-yellow-500 mb-3">
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                    </div>
                    <blockquote class="italic text-gray-600 mb-4">"Very quick and efficient service. Used an electrical emergency on date night!"</blockquote>
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-900 flex items-center justify-center text-white font-bold">RK</div>
                        <p class="ml-3 font-semibold">Ryan King</p>
                    </div>
            </div>
            
            <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex text-yellow-500 mb-3">
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                    </div>
                    <blockquote class="italic text-gray-600 mb-4">"A pleasant experience, dealing with people who know what they're doing and care about their work."</blockquote>
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-900 flex items-center justify-center text-white font-bold">DT</div>
                        <p class="ml-3 font-semibold">Delene Trussell</p>
                    </div>
            </div>
            
            <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex text-yellow-500 mb-3">
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                    </div>
                    <blockquote class="italic text-gray-600 mb-4">"Great team, thanks for such excellent and professional service."</blockquote>
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-900 flex items-center justify-center text-white font-bold">CH</div>
                        <p class="ml-3 font-semibold">Candice Hart</p>
                    </div>
                </div>
                
                <!-- Testimonial 4 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex text-yellow-500 mb-3">
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
    </div>
                    <blockquote class="italic text-gray-600 mb-4">"Excellent, friendly and efficient service!"</blockquote>
                <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-900 flex items-center justify-center text-white font-bold">SB</div>
                        <p class="ml-3 font-semibold">Sadia Biryat</p>
                    </div>
                </div>
                
                <!-- Testimonial 5 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex text-yellow-500 mb-3">
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                    </div>
                    <blockquote class="italic text-gray-600 mb-4">"Professional and polite."</blockquote>
                <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-900 flex items-center justify-center text-white font-bold">BP</div>
                        <p class="ml-3 font-semibold">Beulah Patrick</p>
                    </div>
                </div>
                
                <!-- Testimonial 6 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="flex text-yellow-500 mb-3">
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                        <span class="star-icon">★</span>
                    </div>
                    <blockquote class="italic text-gray-600 mb-4">"Very knowledgeable and professional. Highly recommended."</blockquote>
                <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-900 flex items-center justify-center text-white font-bold">MJ</div>
                        <p class="ml-3 font-semibold">Marojy</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-8 text-blue-900">Contact form</h2>
                <form action="contact-process.php" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <input type="text" name="first_name" placeholder="First Name*" required
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <input type="text" name="last_name" placeholder="Last Name*" required
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <input type="tel" name="phone" placeholder="Phone" 
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="E-mail*" required
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        </div>
                    </div>
                    <div>
                        <textarea name="message" placeholder="Message*" required
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500 h-32"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-yellow-500 text-blue-900 px-8 py-3 rounded font-semibold hover:bg-yellow-400 transition duration-300">
                            SEND MESSAGE
                        </button>
                    </div>
                </form>
        </div>
    </div>
</section>
</main>

<style>
.speech-bubble {
    position: relative;
    background: #f3f4f6;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 25px;
}

.speech-bubble:after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 20px;
    border-width: 15px 15px 0;
    border-style: solid;
    border-color: #f3f4f6 transparent;
}

.text-shadow {
    text-shadow: 0 2px 4px rgba(255, 255, 255, 0.7);
}

.star-icon {
    color: #FBBF24;
    display: inline-block;
    width: 20px;
    height: 20px;
}

.water-ripple {
    background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.1) 10%, transparent 20%),
                radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.15) 10%, transparent 25%),
                radial-gradient(circle at 70% 60%, rgba(255, 255, 255, 0.1) 15%, transparent 30%),
                radial-gradient(circle at 20% 70%, rgba(255, 255, 255, 0.12) 8%, transparent 16%),
                radial-gradient(circle at 85% 25%, rgba(255, 255, 255, 0.08) 12%, transparent 22%),
                radial-gradient(circle at 40% 30%, rgba(255, 255, 255, 0.1) 5%, transparent 10%),
                radial-gradient(circle at 60% 80%, rgba(255, 255, 255, 0.15) 10%, transparent 20%),
                radial-gradient(circle at 15% 25%, rgba(255, 255, 255, 0.05) 15%, transparent 25%),
                radial-gradient(circle at 90% 65%, rgba(255, 255, 255, 0.1) 10%, transparent 20%),
                radial-gradient(circle at 50% 90%, rgba(255, 255, 255, 0.05) 8%, transparent 15%);
    background-size: 200% 200%;
    background-position: 0 0;
    animation: ripple-animation 20s linear infinite;
}

@keyframes ripple-animation {
    0% { background-position: 0% 0%; }
    25% { background-position: 100% 0%; }
    50% { background-position: 100% 100%; }
    75% { background-position: 0% 100%; }
    100% { background-position: 0% 0%; }
}

@keyframes wave-slow {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

@keyframes wave-fast {
    0% { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

.animate-wave-slow {
    animation: wave-slow 15s linear infinite;
}

.animate-wave-fast {
    animation: wave-fast 10s linear infinite;
}
</style>

<?php
// Include footer
require_once 'includes/footer.php';
?> 