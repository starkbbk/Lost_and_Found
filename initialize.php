<?php
// Define base_url dynamically or via ENV
if(!defined('base_url')){
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8080';
    define('base_url', getenv('APP_URL') ?: $protocol . $host . '/');
}

if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );

// Database Credentials - Use ENV if available, else fallback to localhost defaults
if(!defined('DB_SERVER')) define('DB_SERVER', getenv('DB_HOST') ?: "localhost");
if(!defined('DB_USERNAME')) define('DB_USERNAME', getenv('DB_USERNAME') ?: "root");
if(!defined('DB_PASSWORD')) define('DB_PASSWORD', getenv('DB_PASSWORD') ?: "");
if(!defined('DB_NAME')) define('DB_NAME', getenv('DB_DATABASE') ?: "lfis_db");
?>