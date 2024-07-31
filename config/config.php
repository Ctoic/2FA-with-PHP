<?php
$dsn = 'mysql:host=localhost;dbname=SPARTA';
$username = 'root';
$password = 'MyStrongPassword1234$';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
