<?php
header('Content-Type: text/plain');
echo "Host: " . $_SERVER['HTTP_HOST'] . "\n";
echo "HTTPS: " . ($_SERVER['HTTPS'] ?? 'off') . "\n";
echo "Port: " . $_SERVER['SERVER_PORT'] . "\n";
echo "X-Forwarded-Proto: " . ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'missing') . "\n";
echo "X-Forwarded-For: " . ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'missing') . "\n";
echo "All Headers:\n";
foreach (getallheaders() as $name => $value) {
    echo "$name: $value\n";
}
print_r($_SERVER);
