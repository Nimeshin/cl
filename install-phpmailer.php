<?php
// Create vendor directory if it doesn't exist
if (!file_exists('vendor')) {
    mkdir('vendor', 0755, true);
    mkdir('vendor/phpmailer', 0755, true);
    mkdir('vendor/phpmailer/phpmailer', 0755, true);
    mkdir('vendor/phpmailer/phpmailer/src', 0755, true);
}

// PHPMailer files to download
$files = [
    'PHPMailer.php',
    'SMTP.php',
    'Exception.php'
];

// Download each file
foreach ($files as $file) {
    $url = "https://raw.githubusercontent.com/PHPMailer/PHPMailer/master/src/$file";
    $destination = "vendor/phpmailer/phpmailer/src/$file";
    
    echo "Downloading $file...\n";
    $content = file_get_contents($url);
    
    if ($content === false) {
        die("Failed to download $file\n");
    }
    
    if (file_put_contents($destination, $content) === false) {
        die("Failed to save $file\n");
    }
    
    echo "Successfully downloaded and saved $file\n";
}

// Create autoload.php
$autoload_content = '<?php
spl_autoload_register(function ($class) {
    $prefix = "PHPMailer\\\\PHPMailer\\\\";
    $base_dir = __DIR__ . "/phpmailer/phpmailer/src/";

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace("\\\\", "/", $relative_class) . ".php";

    if (file_exists($file)) {
        require $file;
    }
});';

file_put_contents('vendor/autoload.php', $autoload_content);

echo "Installation complete!\n";
?> 