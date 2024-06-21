<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'escuela';

try {
    $pdo = new PDO('mysql:host='.$host.';dbname='.$db. ';charset=utf8', $user, $pass);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexion Exitosa"; 
    // $conexion -> exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
