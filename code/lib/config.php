<?php
define('DNS','mysql:host=localhost;dbname=Digi24;charset=utf8mb4');
define('DB_USER','root');
define('DB_PASSWORD','');
$db = new PDO(DNS , DB_USER, DB_PASSWORD);
?>
