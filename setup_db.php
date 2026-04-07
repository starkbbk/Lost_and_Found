<?php
require_once('initialize.php');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'type' column exists
$result = $conn->query("SHOW COLUMNS FROM `item_list` LIKE 'type'");
if ($result->num_rows == 0) {
    // Column doesn't exist, we add it
    $sql = "ALTER TABLE `item_list` ADD COLUMN `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Found, 2=Lost'";
    if ($conn->query($sql) === TRUE) {
        echo "Successfully added 'type' column to item_list. Your database is now fully upgraded!<br>";
    } else {
        echo "Error upgrading database: " . $conn->error . "<br>";
    }
} else {
    echo "'type' column already exists.<br>";
}

echo "<br><a href='./'>Return to Home</a>";
$conn->close();
?>
