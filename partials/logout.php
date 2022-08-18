<?php
session_start();
echo '<strong>Logging You Out. Please Wait... :)</strong>';
session_destroy();
header('location: /phpdevelopmentvsforumpro/index.php');
?>