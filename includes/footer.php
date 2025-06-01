<?php
$trading_hours = [
    'Mon - Fri' => '8:00 - 17:00',
    'Saturday' => '8:00 - 13:00',
    'Sunday' => 'Closed',
    'Public Holidays' => '8:00 - 13:00'
];
?>
<footer class="bg-[#0B2447] text-white mt-8">
    <div class="container mx-auto px-4 py-12">
        <div class="text-2xl font-bold mb-10 text-center">NEED RELIABLE PLUMBING OR ELECTRICAL HELP?</div>
        <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">
            <!-- Quick Links -->
            <div>
                <h3 class="font-bold mb-4 uppercase">QUICK LINKS</h3>
                <ul class="space-y-2">
                    <li><a href="index.php" class="hover:text-gray-300">Home</a></li>
                    <li><a href="about.php" class="hover:text-gray-300">About us</a></li>
                    <li><a href="services.php" class="hover:text-gray-300">Our services</a></li>
                    <li><a href="contact.php" class="hover:text-gray-300">Contact us</a></li>
                </ul>
            </div>

            <!-- Trading Hours -->
            <div>
                <h3 class="font-bold mb-4 uppercase">TRADING HOURS</h3>
                <ul class="space-y-2">
                    <?php foreach($trading_hours as $day => $hours): ?>
                        <li><?php echo $day; ?>: <?php echo $hours; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Get in Touch -->
            <div>
                <h3 class="font-bold mb-4 uppercase">GET IN TOUCH</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="mailto:info@clhomeassist.co.za" class="hover:text-gray-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            info@clhomeassist.co.za
                        </a>
                    </li>
                    <li>
                        <a href="tel:0835033081" class="hover:text-gray-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            083 503 3081
                        </a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0C6.134 0 3 3.134 3 7c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7zm0 9.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"/>
                        </svg>
                        <span>
                            Midrand, Sandton, Fourways, Randburg, Roodepoort, Krugersdorp, Soweto, Johannesburg South
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Follow Us -->
            <div>
                <h3 class="font-bold mb-4 uppercase">FOLLOW US</h3>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-gray-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                        </svg>
                    </a>
                    <a href="#" class="hover:text-gray-300">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
</script>

<!-- Schema Markup -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "CL Home Assist",
  "image": "https://clhomeassist.co.za/images/home-banner.png",
  "description": "Professional plumbing and electrical services in Johannesburg. Available 24/7 for emergencies.",
  "@id": "https://clhomeassist.co.za",
  "url": "https://clhomeassist.co.za",
  "telephone": "083 503 3081",
  "email": "info@clhomeassist.co.za",
  "address": {
    "@type": "PostalAddress",
    "addressRegion": "Gauteng",
    "addressCountry": "ZA"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": -26.2041,
    "longitude": 28.0473
  },
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
      "opens": "08:00",
      "closes": "17:00"
    },
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "Saturday",
      "opens": "08:00",
      "closes": "13:00"
    }
  ],
  "sameAs": [
    "https://www.facebook.com/clhomeassist",
    "https://www.instagram.com/clhomeassist"
  ],
  "priceRange": "$$",
  "servesCuisine": "Plumbing and Electrical Services"
}
</script>

</body>
</html> 