<?php
$host = 'localhost';
<<<<<<< HEAD:gestor/includes/conexion.php
$user = 'root';
$pass = '';
<<<<<<< HEAD:gestor/includes/conexion.php
$db = 'colegio';
=======
$db = 'bd-2';
>>>>>>> e875db1024f8170241615d2d93b0edbfd7d817df:includes/conexion.php
=======
$user = 'prueba';
$pass = 'prueba123';
$db = 'escuela';
>>>>>>> 910fae2 (agregar usuarios):includes/conexion.php

try {
    $pdo = new PDO('mysql:host='.$host.';dbname='.$db. ';charset=utf8', $user, $pass);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexion Exitosa"; 
    // $conexion -> exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
