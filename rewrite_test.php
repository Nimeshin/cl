<?php
// This file helps diagnose .htaccess and rewrite issues

echo "<h1>URL Rewrite Test</h1>";

// Output basic server information
echo "<h2>Server Information</h2>";
echo "<ul>";
echo "<li>Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "</li>";
echo "<li>PHP Version: " . phpversion() . "</li>";
echo "<li>Request URI: " . $_SERVER['REQUEST_URI'] . "</li>";
echo "<li>Script Name: " . $_SERVER['SCRIPT_NAME'] . "</li>";
echo "</ul>";

// Test if .htaccess is being read
echo "<h2>.htaccess Test</h2>";
$htaccessTest = "";
if (function_exists('apache_get_modules')) {
    if (in_array('mod_rewrite', apache_get_modules())) {
        $htaccessTest .= "✅ mod_rewrite is enabled<br>";
    } else {
        $htaccessTest .= "❌ mod_rewrite is NOT enabled<br>";
    }
} else {
    $htaccessTest .= "⚠️ Cannot directly check for mod_rewrite (CGI/FastCGI)<br>";
}

// Check for AllowOverride settings
if (is_file(".htaccess")) {
    $htaccessTest .= "✅ .htaccess file exists<br>";
    
    // Try to create a temporary file to test write permissions
    $testFile = ".htaccess-test-delete-me";
    if (@file_put_contents($testFile, "# Test")) {
        $htaccessTest .= "✅ Directory is writable<br>";
        @unlink($testFile);
    } else {
        $htaccessTest .= "❌ Directory is NOT writable<br>";
    }
} else {
    $htaccessTest .= "❌ .htaccess file does NOT exist<br>";
}

echo $htaccessTest;

// Hosting provider detection
echo "<h2>Hosting Provider Detection</h2>";
$hostingInfo = "";

// Check for common hosting environments
if (strpos($_SERVER['SERVER_SOFTWARE'], 'cPanel') !== false || is_dir('/usr/local/cpanel')) {
    $hostingInfo .= "Detected: cPanel hosting<br>";
    $hostingInfo .= "⚠️ Recommendation: Make sure mod_rewrite is enabled in cPanel → 'Select PHP Version'<br>";
} elseif (strpos($_SERVER['SERVER_SOFTWARE'], 'Plesk') !== false) {
    $hostingInfo .= "Detected: Plesk hosting<br>";
    $hostingInfo .= "⚠️ Recommendation: Enable mod_rewrite in Plesk control panel<br>";
} elseif (file_exists('/etc/cloudlinux') || file_exists('/etc/cloudlinux-release')) {
    $hostingInfo .= "Detected: CloudLinux (common in shared hosting)<br>";
    $hostingInfo .= "⚠️ Recommendation: Contact hosting support to enable mod_rewrite<br>";
} else {
    $hostingInfo .= "Unknown hosting environment<br>";
    $hostingInfo .= "⚠️ General recommendation: Contact your hosting provider to ensure mod_rewrite is enabled<br>";
}

echo $hostingInfo;

// Recommendations based on findings
echo "<h2>Recommendations</h2>";
echo "<ol>";
echo "<li>Test if the server processes the .htaccess file by accessing <a href='/test-rewrite'>this test link</a></li>";
echo "<li>If you see a 404 error when clicking the test link, your .htaccess isn't being processed</li>";
echo "<li>Contact your hosting provider to ensure mod_rewrite is enabled and AllowOverride is set to All</li>";
echo "<li>Try using the alternative .htaccess-alternative file we provided</li>";
echo "<li>As a last resort, you might need to modify your site to work without URL rewriting</li>";
echo "</ol>";

// Output .htaccess instructions for specific hosting providers
echo "<h2>Common Hosting Provider Instructions</h2>";
echo "<h3>cPanel</h3>";
echo "<ol>";
echo "<li>Login to cPanel</li>";
echo "<li>Go to 'Select PHP Version'</li>";
echo "<li>Click on 'Switch to PHP Options'</li>";
echo "<li>Make sure 'mod_rewrite' is enabled</li>";
echo "</ol>";

echo "<h3>Plesk</h3>";
echo "<ol>";
echo "<li>Login to Plesk</li>";
echo "<li>Go to 'Domains' > your domain</li>";
echo "<li>Click on 'Apache & nginx Settings'</li>";
echo "<li>Under 'Additional directives for HTTP', ensure AllowOverride is set to 'All'</li>";
echo "</ol>";

echo "<h3>General Shared Hosting</h3>";
echo "<ol>";
echo "<li>Contact support and specifically ask them to confirm mod_rewrite is enabled for your account</li>";
echo "<li>Ask them to check if AllowOverride is set to 'All' in the Apache configuration</li>";
echo "<li>Provide them with your .htaccess file and ask if there are any rules that might not be compatible with their server</li>";
echo "</ol>";
?> 