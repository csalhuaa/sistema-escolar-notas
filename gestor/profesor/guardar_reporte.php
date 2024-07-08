<?php
require_once '../includes/conexion.php';

if (!empty($_POST)) {
    $id_estudiante = $_POST['id_estudiante'];
    $id_curso = $_POST['id_curso'];
    $observaciones = $_POST['observaciones'];
    $fecha = date('Y-m-d'); // Fecha actual

    // Insertar el reporte en la base de datos
    $sql = "INSERT INTO reportes (id_estudiante, id_curso, observaciones, fecha) VALUES (?, ?, ?, ?)";
    $query = $pdo->prepare($sql);
    $query->execute([$id_estudiante, $id_curso, $observaciones, $fecha]);

    // Redirigir a la página de ver notas o a otra página después de guardar el reporte
    header("Location: ver_reportes.php?id_estudiante=$id_estudiante&id_curso=$id_curso");
    exit;
} else {
    // Si no hay datos en POST, redirigir a la página principal de notas
    header("Location: notas.php");
    exit;
}
