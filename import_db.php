<?php
require_once('initialize.php');
require_once('classes/DBConnection.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_implicit_flush(true);
while (ob_get_level()) ob_end_clean();

$db = new DBConnection;
$conn = $db->conn;

function run_sql_file($conn, $location){
    // Drop existing tables to ensure clean import
    $tables = ['category_list', 'inquiry_list', 'item_list', 'system_info', 'users'];
    foreach ($tables as $table) {
        $conn->query("DROP TABLE IF EXISTS `$table`");
        echo "Dropped table `$table` (if existed).<br>";
    }

    if (!file_exists($location)) {
        die("❌ SQL file not found at: $location");
    }
    //load file
    $lines = file($location);
    if ($lines === false) {
        die("❌ Could not read file content.");
    }
    echo "✅ Read " . count($lines) . " lines from file.<br>";

    $buffer = '';
    $total = $success = 0;
    
    foreach($lines as $line){
        // Skip comments and empty lines if buffer is empty
        $trimmed = trim($line);
        if ($buffer === '' && ($trimmed === '' || startsWith($trimmed, '--'))) {
            continue;
        }

        $buffer .= $line;
        
        // If line ends with semicolon, execute buffer
        if (substr($trimmed, -1) === ';') {
            if($conn->query($buffer)){
                $success++;
                echo "Executed query successfully.<br>";
            } else {
                echo "❌ Error: " . $conn->error . "<br>";
            }
            $total++;
            $buffer = '';
        }
    }
    
    echo "Successfully executed " . $success . " out of " . $total . " queries.<br>";
    echo "<h3>Import Complete!</h3>";
    echo "<p>You can now delete this file (import_db.php) and <a href='index.php'>Go to Home</a></p>";
}

function startsWith ($string, $startString) {
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

echo "<h2>Importing Database...</h2>";

$sql_file = 'database/lfis_db.sql';
if(file_exists($sql_file)){
    run_sql_file($conn, $sql_file);
} else {
    echo "Error: SQL file not found at $sql_file";
}
?>
