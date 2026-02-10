<?php
if (function_exists('opcache_reset')) {
    if (opcache_reset()) {
        echo "✅ PHP Opcache successfully reset.";
    } else {
        echo "❌ Failed to reset PHP Opcache.";
    }
} else {
    echo "⚠️ Opcache is not enabled or function does not exist.";
}
echo "<br>Server Time: " . date('Y-m-d H:i:s');
?>
