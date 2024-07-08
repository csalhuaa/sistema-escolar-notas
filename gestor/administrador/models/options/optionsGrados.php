<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT id_grado, nombre_grado FROM grados WHERE est_reg = 'A'";
$query = $pdo->prepare($sql);
$query->execute();
$grados = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($grados, JSON_UNESCAPED_UNICODE);
