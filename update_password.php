<?php
require_once('initialize.php');
require_once('classes/DBConnection.php');

$db = new DBConnection;
$conn = $db->conn;

$username = 'admin';
$new_password = 'admin@123';
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
$stmt->bind_param("ss", $hashed_password, $username);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "✅ Password successfully updated for user: $username";
    } else {
        echo "⚠️ Query executed, but no rows changed. (Username might not exist or password was already the same)";
    }
} else {
    echo "❌ Error updating password: " . $conn->error;
}
?>

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "✅ Password successfully updated for user: $username";
    } else {
        echo "⚠️ Query executed, but no rows changed. (Username might not exist or password was already the same)";
    }
} else {
    echo "❌ Error updating password: " . $conn->error;
}
?>
