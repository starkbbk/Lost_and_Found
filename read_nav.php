<?php
header('Content-Type: text/plain');
$file = 'inc/topBarNav.php';
if (file_exists($file)) {
    echo "File content of $file:\n\n";
    echo file_get_contents($file);
} else {
    echo "File $file not found!";
}
?>
