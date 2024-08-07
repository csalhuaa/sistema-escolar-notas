<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asigna las variables desde el formulario
        $idbimestre = $_POST['idbimestre'];
        $nombre = $_POST['Nombre'];
        $est_reg = $_POST['est_reg'];

        $sql = 'SELECT * FROM bimestre WHERE nombre_bimestre = ? AND est_reg = "A"';
        $params = [$nombre];

        if (!empty($idbimestre)) {
            $sql .= ' AND id_bimestre != ?';
            $params[] = $idbimestre;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El nombre de bimestre ya existe',
                'idbimestre' => $idbimestre
            );
        } else {
            // Crea una nueva sección
            if (empty($idbimestre)) {   
                $sqlInsert = 'INSERT INTO bimestre (nombre_bimestre, est_reg) VALUES (?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $est_reg));
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE bimestre SET nombre_bimestre = ?, est_reg = ? WHERE id_bimestre = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre, $est_reg, $idbimestre));
                $accion = 2;
            }

            if ($request) {
                $respuesta = array(
                    'status' => true,
                    'msg' => $accion == 1 ? 'Bimestre creada correctamente' : 'Bimestre actualizada correctamente'
                );
            } else {
                $respuesta = array(
                    'status' => false,
                    'msg' => 'No se pudo ejecutar la operación'
                );
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}
?>
