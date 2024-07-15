<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT id_usuario, nombre, apellido_paterno, apellido_materno FROM Usuarios WHERE id_rol = '3' AND est_reg = 'A'";
$query = $pdo->prepare($sql);
$query->execute();
$padres = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($padres, JSON_UNESCAPED_UNICODE);
