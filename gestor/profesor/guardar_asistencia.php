<?php
require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_aula = $_POST['id_aula'];
    $asistencia = $_POST['asistencia'] ?? []; // Si no está presente, se asigna un array vacío
    $fecha = date('Y-m-d');

    // Obtener todos los estudiantes del aula
    $sql = "SELECT id_estudiante FROM estudiantes WHERE id_aula = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$id_aula]);
    $estudiantes = $query->fetchAll(PDO::FETCH_COLUMN);

    try {
        $pdo->beginTransaction();

        foreach ($estudiantes as $id_estudiante) {
            $presente = isset($asistencia[$id_estudiante]) ? 1 : 0;

            $sql = "INSERT INTO Asistencia (id_estudiante, id_aula, fecha, presente) VALUES (?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE presente = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$id_estudiante, $id_aula, $fecha, $presente, $presente]);
        }

        $pdo->commit();
        header("Location: asistencia.php?id_aula=$id_aula&status=success");
    } catch (PDOException $e) {
        $pdo->rollBack();
        header("Location: asistencia.php?id_aula=$id_aula&status=error");
    }
    exit();
} else {
    header('Location: index.php');
    exit();
}
?>
