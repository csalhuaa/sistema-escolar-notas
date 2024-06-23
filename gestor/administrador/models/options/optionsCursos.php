<?php

require_once '../../../includes/conexion.php';

$sql = "SELECT id_curso, nombre FROM Cursos WHERE est_reg = 'A'";
$query = $pdo->prepare($sql);
$query->execute();
$profesores = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($profesores, JSON_UNESCAPED_UNICODE);
