<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['id_estudiante']) || empty($_POST['id_grado']) || empty($_POST['id_seccion']) || empty($_POST['año']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asignar variables desde el formulario
        $id_matricula = $_POST['idmatricula'];
        $id_estudiante = $_POST['id_estudiante'];
        $id_grado = $_POST['id_grado'];
        $id_seccion = $_POST['id_seccion'];
        $año = $_POST['año'];
        $est_reg = $_POST['est_reg'];

        // Verificar si ya existe el registro
        $sql = 'SELECT * FROM matriculas WHERE id_estudiante = ? AND id_grado = ? AND id_seccion = ?';
        $params = [$id_estudiante, $id_grado, $id_seccion];

        if (!empty($id_matricula)) {
            $sql .= ' AND id_matricula != ?';
            $params[] = $id_matricula;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'Esta matrícula ya existe para este estudiante, grado, sección y año',
                'id_matricula' => $id_matricula
            );
        } else {
            // Insertar o actualizar el registro
            if (empty($id_matricula)) {
                $sqlInsert = 'INSERT INTO matriculas (id_estudiante, id_grado, id_seccion, año, est_reg) VALUES (?, ?, ?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute([$id_estudiante, $id_grado, $id_seccion, $año, $est_reg]);
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE matriculas SET id_estudiante = ?, id_grado = ?, id_seccion = ?, año = ?, est_reg = ? WHERE id_matricula = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute([$id_estudiante, $id_grado, $id_seccion, $año, $est_reg, $id_matricula]);
                $accion = 2;
            }

            if ($request) {
                $respuesta = array(
                    'status' => true,
                    'msg' => $accion == 1 ? 'Matrícula creada correctamente' : 'Matrícula actualizada correctamente'
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
