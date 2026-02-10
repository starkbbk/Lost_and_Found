<?php
require_once('initialize.php');
header('Content-Type: text/plain');
echo "Resolved base_url: " . base_url . "\n";
echo "HTTP_HOST: " . $_SERVER['HTTP_HOST'] . "\n";
echo "HTTPS: " . ($_SERVER['HTTPS'] ?? 'off') . "\n";
echo "X-Forwarded-Proto: " . ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? 'missing') . "\n";
