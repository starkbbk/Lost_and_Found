<?php
require_once('initialize.php');
require_once('classes/DBConnection.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new DBConnection;
$conn = $db->conn;

function run_sql_file($conn, $location){
    //load file
    $content = file_get_contents($location);
    echo "Read " . strlen($content) . " bytes from file.<br>";

    //delete comments
    $lines = explode("\n",$content);
    $commands = '';
    foreach($lines as $line){
        $line = trim($line);
        if( $line && !startsWith($line,'--') ){
            $commands .= $line . "\n";
        }
    }

    //convert to array
    $commands = explode(";", $commands);
    echo "Found " . count($commands) . " commands to execute.<br>";

    //run commands
    $total = $success = 0;
    foreach($commands as $command){
        if(trim($command)){
            $result = $conn->query($command);
            if($result){
                $success += 1;
            } else {
                echo "Error executing query: " . $conn->error . "<br><pre>$command</pre><br>";
            }
            $total += 1;
        }
    }
    
    return array(
        "success" => $success,
        "total" => $total
    );
}

function startsWith ($string, $startString) {
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

echo "<h2>Importing Database...</h2>";

$sql_file = 'database/lfis_db.sql';
if(file_exists($sql_file)){
    $result = run_sql_file($conn, $sql_file);
    echo "Successfully executed " . $result['success'] . " out of " . $result['total'] . " queries.<br>";
    echo "<h3>Import Complete!</h3>";
    echo "<p>You can now delete this file (import_db.php) and <a href='index.php'>Go to Home</a></p>";
} else {
    echo "Error: SQL file not found at $sql_file";
}
?>
