<?php
echo "<h2>Apache Module Check</h2>";
if(function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    echo "mod_rewrite: " . (in_array('mod_rewrite', $modules) ? 'Enabled' : 'Disabled') . "<br>";
} else {
    echo "Unable to check Apache modules - probably running on CGI/FastCGI<br>";
    echo "Alternative check: ";
    echo (getenv('HTTP_MOD_REWRITE') == 'On' ? 'Enabled' : 'Might be disabled');
    
    // Output server info
    echo "<h3>Server Info:</h3>";
    echo "<pre>";
    echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
    echo "</pre>";
}
?> 