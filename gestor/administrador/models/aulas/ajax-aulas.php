<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['id_grado']) || empty($_POST['id_seccion']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asigna las variables desde el formulario
        $id_aula = $_POST['idaula'];
        $id_grado = $_POST['id_grado'];
        $id_seccion = $_POST['id_seccion'];
        $est_reg = $_POST['est_reg'];

        $sql = 'SELECT * FROM aulas WHERE id_grado = ? AND id_seccion = ? AND est_reg = "A"';
        $params = [$id_grado, $id_seccion];

        if (!empty($id_aula)) {
            $sql .= 'AND id_aula != ?';
            $params[] = $id_aula;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El Aula ya existe para este grado',
                'id_aula' => $id_aula // Agregar el id a la respuesta
            );
        } else {
            // Crea una nueva sección
            if (empty($id_aula)) {   
                $sqlInsert = 'INSERT INTO aulas (id_grado, id_seccion, est_reg) VALUES (?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($id_grado, $id_seccion, $est_reg));
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE aulas SET id_grado = ?, id_seccion = ?, est_reg = ? WHERE id_aula = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($id_grado, $id_seccion, $est_reg, $id_aula));
                $accion = 2;
            }

            if ($request) {
                $respuesta = array(
                    'status' => true,
                    'msg' => $accion == 1 ? 'Aula creada correctamente' : 'Aula actualizada correctamente'
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
