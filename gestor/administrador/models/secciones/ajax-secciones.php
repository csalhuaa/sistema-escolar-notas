<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asigna las variables desde el formulario
        $idseccion = $_POST['idseccion'];
        $nombre = $_POST['Nombre'];
        $est_reg = $_POST['est_reg'];

        // Verifica si el nombre de sección ya existe para el mismo grado
        $sql = 'SELECT * FROM secciones WHERE nombre_seccion = ? AND id_grado = ? AND est_reg = "A"';
        $params = [$nombre, $listGrado];

        if (!empty($idseccion)) {
            $sql .= ' AND id_seccion != ?';
            $params[] = $idseccion;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El nombre de sección ya existe para este grado',
                'idseccion' => $idseccion // Agregar el id a la respuesta
            );
        } else {
            // Crea una nueva sección
            if (empty($idseccion)) {   
                $sqlInsert = 'INSERT INTO secciones (nombre_seccion, est_reg) VALUES (?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $est_reg));
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE secciones SET nombre_seccion = ?, est_reg = ? WHERE id_seccion = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre, $est_reg, $idseccion));
                $accion = 2;
            }

            if ($request) {
                $respuesta = array(
                    'status' => true,
                    'msg' => $accion == 1 ? 'Sección creada correctamente' : 'Sección actualizada correctamente'
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
