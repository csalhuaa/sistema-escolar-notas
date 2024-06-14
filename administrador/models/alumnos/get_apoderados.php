<?php
require_once '../../../includes/conexion.php';

$sql = "SELECT ID, Nombre, Apellido_Paterno, Apellido_Materno FROM usuarios WHERE id_rol = 3 AND Est_Reg = 'A'";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$apoderados = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $apoderado = array(
        "ID" => $row["ID"],
        "Nombre" => $row["Nombre"],
        "Apellido_Paterno" => $row["Apellido_Paterno"],
        "Apellido_Materno" => $row["Apellido_Materno"]
    );
    array_push($apoderados, $apoderado);
}

echo json_encode($apoderados);
?>
