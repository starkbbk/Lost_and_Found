<?php
// Define base_url dynamically or via ENV
if(!defined('base_url')){
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    
    // Check for proxy headers (Render, etc.)
    if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false){
        $protocol = "https://";
    }
    
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8080';
    
    // Force HTTPS on Render domains
    if (strpos($host, 'onrender.com') !== false) {
        $protocol = "https://";
    }
    
    $env_url = getenv('APP_URL');
    
    // Use ENV URL if set, but fix protocol if needed
    if ($env_url) {
        if ($protocol === 'https://' && strpos($env_url, 'http://') === 0) {
            $env_url = str_replace('http://', 'https://', $env_url);
        }
        // Ensure trailing slash
        if(substr($env_url, -1) !== '/') $env_url .= '/';
        define('base_url', $env_url);
    } else {
        define('base_url', $protocol . $host . '/');
    }
}

if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );

// Database Credentials - Use ENV if available, else fallback to localhost defaults
if(!defined('DB_SERVER')) define('DB_SERVER', getenv('DB_HOST') ?: "localhost");
if(!defined('DB_USERNAME')) define('DB_USERNAME', getenv('DB_USERNAME') ?: "root");
if(!defined('DB_PASSWORD')) define('DB_PASSWORD', getenv('DB_PASSWORD') ?: "");
if(!defined('DB_NAME')) define('DB_NAME', getenv('DB_DATABASE') ?: "lfis_db");
if(!defined('DB_PORT')) define('DB_PORT', getenv('DB_PORT') ?: 3306);
?>