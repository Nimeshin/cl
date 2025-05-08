<?php
declare(strict_types=1);

// Set page title
$page_title = 'Our Services';

// Include header
require_once 'includes/header.php';
?>

<main>
    <!-- Services Hero Section -->
    <section class="relative">
        <!-- Full width background image with fixed height -->
        <div class="w-full relative h-[600px] overflow-hidden">
            <img src="images/services.png" alt="Plumbing and Electrical Tools" class="w-full h-full object-cover">
            
            <!-- Overlaid text -->
            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                <div class="w-full px-8">
                    <h1 class="text-4xl md:text-5xl font-bold text-[#0B2447] leading-tight text-center">
                        Your Partner for<br>
                        Quality Plumbing and<br>
                        Electrical Work.
                    </h1>
                </div>
            </div>
        </div>
        
        <!-- Services banner -->
        <div class="bg-[#0B2447] text-white py-4 md:py-6 relative">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold">OUR SERVICES</h2>
            </div>
        </div>
    </section>

    <!-- Services Introduction -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <p class="text-lg mb-8 text-center">
                    At CL Home, we offer a full range of expert Plumbing and Electrical services designed to keep your home or business running smoothly. Whether it's a minor repair, a major installation, or preventative maintenance, our skilled team is ready to deliver quality workmanship and dependable results you can trust.
                </p>
            </div>
        </div>
    </section>

    <!-- Service Categories -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Plumbing Services -->
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-yellow-500">Plumbing Services</h2>
                    <p class="text-lg mb-6">
                        From fixing leaks and clearing blocked drains to installing geysers, water purification systems, septic tanks, and even full bathroom renovations, we handle it all with precision and care. No job is too big or too small. Whether it's a quick repair or a major installation, we're here to keep your water flowing safely and efficiently.
                    </p>
            </div>
            
                <!-- Electrical Services -->
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-yellow-500">Electrical Services</h2>
                    <p class="text-lg mb-6">
                        We provide safe, professional electrical solutions, including repairs, new installations, water supply booster pumps, and electrical maintenance. Using the latest technology and industry best practices, we ensure your property stays properly powered and up to code.
                    </p>
            </div>
        </div>
    </div>
</section>

    <!-- Our Services List -->
    <section id="services-list" class="py-16 bg-white">
    <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-12 text-center text-[#0B2447]">Our Services:</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Geyser Installation & Repairs -->
                <div class="bg-[#0B2447] text-white rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-yellow-500">Geyser Installation & Repairs</h3>
                        <p class="mb-4">
                            We install, repair, and replace electric, gas and solar geysers with precision and care. Our experienced technicians ensure optimal energy efficiency, and long-lasting performance.
                        </p>
                    </div>
                </div>
                
                <!-- Leak Detection & Pipe Repairs -->
                <div class="bg-[#0B2447] text-white rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-yellow-500">Leak Detection & Pipe Repairs</h3>
                        <p class="mb-4">
                            Using advanced technology, we quickly locate hidden leaks and repair pipes with minimal disruption. Trust us to protect your home and prevent expensive water damage.
                        </p>
                    </div>
                </div>
                
                <!-- Electrical Repairs & Upgrades -->
                <div class="bg-[#0B2447] text-white rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-yellow-500">Electrical Repairs & Upgrades</h3>
                        <p class="mb-4">
                            From faulty wiring to outdated systems, we handle all electrical repairs and upgrades with safety and precision. Our solutions keep your home or business powered reliably and up to code.
                        </p>
                    </div>
                </div>
                
                <!-- Water Pressure Solutions -->
                <div class="bg-[#0B2447] text-white rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-yellow-500">Water Pressure Solutions</h3>
                        <p class="mb-4">
                            Struggling with low or unbalanced water pressure? We diagnose the root cause and provide effective solutions to restore strong, consistent flow throughout your property.
                        </p>
                    </div>
                </div>
                
                <!-- 24/7 Emergency Service -->
                <div class="flex items-center justify-center p-6">
                    <img src="images/24-7.jpg" alt="24/7 Service" class="w-48 h-48 object-contain">
                </div>
                
                <!-- Blocked Drain Clearing -->
                <div class="bg-[#0B2447] text-white rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-yellow-500">Blocked Drain Clearing</h3>
                        <p class="mb-4">
                            We offer fast, effective clearing of blocked drains to keep your plumbing flowing. Our team uses professional-grade equipment to tackle even the toughest clogs.
                        </p>
                    </div>
                </div>
                
                <!-- Water Meter Installation & Repair -->
                <div class="bg-[#0B2447] text-white rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-yellow-500">Water Meter Installation & Repair</h3>
                        <p class="mb-4">
                            We install and repair water meters with precision to ensure accurate tracking and billing. Proper meter maintenance helps prevent costly issues.
                        </p>
                    </div>
                </div>
                
                <!-- Booster Pump Installations -->
                <div class="bg-[#0B2447] text-white rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-yellow-500">Booster Pump Installations</h3>
                        <p class="mb-4">
                            Boost your water supply with our expertly installed water pressure booster pumps. Perfect for multi-story buildings, our systems improve flow and efficiency.
                        </p>
                    </div>
                </div>
                
                <!-- General Electrical Installations -->
                <div class="bg-[#0B2447] text-white rounded-lg overflow-hidden shadow-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-yellow-500">General Electrical Installations</h3>
                        <p class="mb-4">
                            Whether you need new lighting, additional outlets, or a complete wiring setup, we provide safe, reliable electrical installations tailored to meet your specific needs.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-12 text-center">Gallery:</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <img src="images/General-Plumbing-Repairs.jpg" alt="Plumbing Repairs" class="w-full h-auto rounded-lg shadow-lg">
                <img src="images/Expert-Drain-Cleaning-Services.jpg" alt="Drain Cleaning" class="w-full h-auto rounded-lg shadow-lg">
                <img src="images/Bathroom-Renovations.jpg" alt="Bathroom Renovations" class="w-full h-auto rounded-lg shadow-lg">
        </div>
    </div>
</section>

    <!-- Call to Action -->
    <section class="py-16 bg-yellow-500">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6 text-[#0B2447]">Ready to get started?</h2>
            <p class="text-lg mb-8 text-[#0B2447]">Contact us today for a consultation or to schedule a service!</p>
            <a href="contact.php" class="inline-block bg-[#0B2447] text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-800 transition duration-300">
                CALL US NOW
            </a>
        </div>
    </section>
</main>

<?php
// Include footer
require_once 'includes/footer.php';
?> 