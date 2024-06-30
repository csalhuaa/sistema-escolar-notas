<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'bd-4';

try {
    $pdo = new PDO('mysql:host='.$host.';dbname='.$db. ';charset=utf8', $user, $pass);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
