<?php
declare(strict_types=1);

// Determine current page for active navigation links
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="CL Home Assist - Your trusted plumbing and electrical experts in Johannesburg. 24/7 emergency services, professional installations, and repairs.">
    <meta name="keywords" content="plumbing, electrical, Johannesburg, emergency plumber, electrical repairs, geyser installation, leak detection, blocked drains">
    <meta name="author" content="CL Home Assist">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo $page_title ?? 'CL Home Assist'; ?> - Your Trusted Plumbing and Electrical Experts">
    <meta property="og:description" content="Professional plumbing and electrical services in Johannesburg. Available 24/7 for emergencies.">
    <meta property="og:image" content="https://clhomeassist.co.za/images/home-banner.png">
    <meta property="og:url" content="https://clhomeassist.co.za">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $page_title ?? 'CL Home Assist'; ?> - Plumbing & Electrical Services">
    <meta name="twitter:description" content="Professional plumbing and electrical services in Johannesburg. Available 24/7 for emergencies.">
    <meta name="twitter:image" content="https://clhomeassist.co.za/images/home-banner.png">
    
    <title><?php echo $page_title ?? 'CL Home Assist'; ?> - Your Trusted Plumbing and Electrical Experts</title>
    
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="images/favicon/favicon.ico">
    <link rel="icon" type="image/svg+xml" href="images/favicon/favicon.svg">
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
    <link rel="apple-touch-icon" href="images/favicon/apple-touch-icon.png">
    <link rel="manifest" href="images/favicon/site.webmanifest">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0B2447',
                        secondary: '#1e293b',
                        dark: '#0f172a',
                        accent: '#F8B133'
                    }
                }
            }
        }
    </script>
    
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Custom styles for navigation */
        .nav-link {
            position: relative;
            padding: 0.5rem 0;
            margin: 0 1rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #0B2447;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .nav-link.active::after {
            width: 100%;
        }
        
        .nav-link.active {
            font-weight: 600;
        }
    </style>
</head>
<body class="font-sans">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="index.php" class="flex items-center">
                    <img src="images/logo.png" alt="CL Home Assist Logo" class="h-20">
                </a>
                
                <!-- Navigation -->
                <nav class="hidden md:flex items-center">
                    <a href="index.php" class="nav-link text-gray-700 hover:text-blue-900 <?php echo $current_page === 'index.php' ? 'active' : ''; ?>">Home</a>
                    <a href="about.php" class="nav-link text-gray-700 hover:text-blue-900 <?php echo $current_page === 'about.php' ? 'active' : ''; ?>">About us</a>
                    <a href="services.php" class="nav-link text-gray-700 hover:text-blue-900 <?php echo $current_page === 'services.php' ? 'active' : ''; ?>">Our Services</a>
                    <a href="contact.php" class="nav-link text-gray-700 hover:text-blue-900 <?php echo $current_page === 'contact.php' ? 'active' : ''; ?>">Contact us</a>
                </nav>
                
                <!-- Phone Number -->
                <a href="tel:0835033081" class="hidden md:flex items-center text-blue-900">
                    <svg class="w-5 h-5 mr-2 text-blue-900" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                    </svg>
                    <span>083 503 3081</span>
                </a>
                
                <!-- Mobile menu button -->
                <button class="md:hidden" id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile menu -->
            <div class="hidden md:hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 mt-2 border-t">
                    <a href="index.php" class="block px-3 py-2 text-gray-700 hover:text-blue-900 <?php echo $current_page === 'index.php' ? 'font-semibold' : ''; ?>">Home</a>
                    <a href="about.php" class="block px-3 py-2 text-gray-700 hover:text-blue-900 <?php echo $current_page === 'about.php' ? 'font-semibold' : ''; ?>">About us</a>
                    <a href="services.php" class="block px-3 py-2 text-gray-700 hover:text-blue-900 <?php echo $current_page === 'services.php' ? 'font-semibold' : ''; ?>">Our Services</a>
                    <a href="contact.php" class="block px-3 py-2 text-gray-700 hover:text-blue-900 <?php echo $current_page === 'contact.php' ? 'font-semibold' : ''; ?>">Contact us</a>
                    <a href="tel:0835033081" class="block px-3 py-2 flex items-center text-blue-900">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                        <span>083 503 3081</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="min-h-screen"> 