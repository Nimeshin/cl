<?php
/**
 * PHP-based URL Router
 * 
 * Use this file if .htaccess-based URL rewriting doesn't work on your server.
 * Upload this file to your server and include it at the top of your index.php file.
 */

// Only run the router if URL rewriting isn't working via .htaccess
if (!isset($_GET['using_php_router'])) {
    // Get the requested URI
    $request_uri = $_SERVER['REQUEST_URI'];
    
    // Remove query string if present
    $uri_parts = explode('?', $request_uri);
    $request_uri = $uri_parts[0];
    
    // Get query string if it exists
    $query_string = isset($uri_parts[1]) ? '?' . $uri_parts[1] : '';
    
    // Remove trailing slash if present
    $request_uri = rtrim($request_uri, '/');
    
    // If the request is for the home page
    if ($request_uri == '' || $request_uri == '/') {
        // Already on index.php, do nothing
        return;
    }
    
    // Determine if the request has a PHP extension
    $has_php_extension = (substr($request_uri, -4) === '.php');
    
    // If the URL doesn't have a .php extension
    if (!$has_php_extension) {
        // Check if a PHP file exists for this request
        $script_path = $_SERVER['DOCUMENT_ROOT'] . $request_uri . '.php';
        
        if (file_exists($script_path)) {
            // Include the PHP file directly
            include($script_path);
            exit;
        }
    }
}

/**
 * Instructions for use:
 * 
 * 1. Upload this file to your server
 * 2. Add this code to the top of your index.php file:
 * 
 * <?php
 * include_once 'router.php';
 * ?>
 * 
 * 3. Update your navigation links to use clean URLs:
 * 
 * <a href="/about">About</a>
 * <a href="/contact">Contact</a>
 * 
 * This solution only works for direct navigation from the homepage.
 * For a more complete solution, you'd need to modify all pages to include this router.
 */
?> 