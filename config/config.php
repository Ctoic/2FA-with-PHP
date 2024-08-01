<?php
$dsn = 'mysql:host=localhost;dbname=xeros';
$username = 'root';
$password = 'MyStrongPassword1234$';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
