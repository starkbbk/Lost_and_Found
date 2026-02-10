<?php
// health_check.php
header('Content-Type: text/plain');
echo "PHP is running successfully.\n";
echo "Server usage: " . memory_get_usage() . " bytes\n";

// Check Database Connection
require_once('initialize.php');
$host = DB_SERVER;
$user = DB_USERNAME;
$pass = DB_PASSWORD;
$db   = DB_NAME;
$raw_port = getenv('DB_PORT');
$port = (int)DB_PORT;

echo "Debug Info:\n";
echo "- Host: $host\n";
echo "- Raw Port (Env): " . var_export($raw_port, true) . "\n";
echo "- Cast Port (Int): $port\n\n";

echo "Attempting DB Connection to $host:$port...\n";

$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    echo "Database Connection Failed: " . $conn->connect_error;
} else {
    echo "Database Connection Successful to $db.";
}
?>