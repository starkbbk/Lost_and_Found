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

echo "Attempting DB Connection to $host...\n";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo "Database Connection Failed: " . $conn->connect_error;
} else {
    echo "Database Connection Successful to $db.";
}
?>
