<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_estudiante = $_POST['id_estudiante'];
    $id_curso = $_POST['id_curso'];
    $id_periodo = $_POST['id_periodo'];
    $competencias = $_POST['competencias'];

    if (empty($id_estudiante) || empty($id_curso) || empty($id_periodo) || empty($competencias)) {
        die("Datos del formulario incompletos.");
    }

    try {
        $pdo->beginTransaction();

        foreach ($competencias as $id_competencia => $nota) {
            $sql = "INSERT INTO notas (id_estudiante, id_curso, id_competencia, id_periodo, nota, est_reg)
                    VALUES (?, ?, ?, ?, ?, 'A')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_estudiante, $id_curso, $id_competencia, $id_periodo, $nota]);
        }

        $pdo->commit();
        echo "Notas guardadas correctamente.";
        header('Location: notas.php');
        exit;

    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Error al guardar las notas: " . $e->getMessage());
    }
} else {
    header('Location: notas.php');
    exit;
}
?>