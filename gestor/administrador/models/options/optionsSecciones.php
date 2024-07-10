<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT id_seccion, nombre_seccion FROM secciones WHERE est_reg = 'A'";
$query = $pdo->prepare($sql);
$query->execute();
$padres = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($padres, JSON_UNESCAPED_UNICODE);
