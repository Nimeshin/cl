<?php
declare(strict_types=1);

// Set page title
$page_title = 'About Us';

// Include header
require_once 'includes/header.php';
?>

<main>
    <!-- About Us Hero Section -->
    <section class="relative">
        <!-- Full width background image with fixed height -->
        <div class="w-full relative h-[600px] overflow-hidden">
            <img src="images/about-banner.png" alt="Plumbing Tools" class="w-full h-full object-cover">
            
            <!-- Overlaid text -->
            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                <div class="w-full px-8">
                    <h1 class="text-4xl md:text-5xl font-bold text-[#0B2447] leading-tight text-center">
                        Reliable Solutions.<br>
                        Quality Workmanship.<br>
                        Service With Heart.
                    </h1>
                </div>
            </div>
        </div>
        
        <!-- About Us banner -->
        <div class="bg-[#0B2447] text-white py-4 md:py-6 relative">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold">ABOUT US</h2>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="prose max-w-none">
                    <h2 class="text-3xl font-bold mb-6">Your Trusted Plumbing and Electrical Partner</h2>
                    <p class="mb-6">
                        At CL Home Assist, we take pride in being your reliable partner for all plumbing and electrical needs. With years of experience in the industry, our team of certified professionals is dedicated to delivering top-quality services that meet and exceed your expectations.
                    </p>
                    <p class="mb-6">
                        We understand that plumbing and electrical issues can be stressful and disruptive to your daily life. That's why we prioritize quick response times, efficient solutions, and transparent communication throughout every project we undertake.
                    </p>
                    <p class="mb-6">
                        Our commitment to excellence is reflected in our workmanship, customer service, and the lasting relationships we build with our clients. Whether you need emergency repairs, routine maintenance, or complete system installations, you can count on CL Home Assist to get the job done right.
                    </p>
                </div>

                <!-- Why Choose Us -->
                <div class="mt-16">
                    <h2 class="text-3xl font-bold mb-8 text-center">Why Choose CL Home Assist?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Experience -->
                        <div class="text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-[#0B2447] rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Experienced Team</h3>
                            <p>Years of expertise in plumbing and electrical services, ensuring quality workmanship.</p>
                        </div>

                        <!-- 24/7 Service -->
                        <div class="text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-[#0B2447] rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">24/7 Emergency Service</h3>
                            <p>Available around the clock for emergency repairs when you need us most.</p>
                        </div>

                        <!-- Customer Service -->
                        <div class="text-center">
                            <div class="w-16 h-16 mx-auto mb-4 bg-[#0B2447] rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Customer Satisfaction</h3>
                            <p>Committed to providing excellent service and ensuring customer satisfaction.</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Section -->
                <div class="mt-16">
                    <h2 class="text-3xl font-bold mb-8 text-center">Our Work</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="aspect-w-4 aspect-h-3">
                            <img src="images/gallery/work-1.jpg" alt="Plumbing Work" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <div class="aspect-w-4 aspect-h-3">
                            <img src="images/gallery/work-2.jpg" alt="Electrical Work" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <div class="aspect-w-4 aspect-h-3">
                            <img src="images/gallery/work-3.jpg" alt="Installation Work" class="w-full h-full object-cover rounded-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?> 