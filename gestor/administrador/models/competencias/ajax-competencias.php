<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['id_curso']) || empty($_POST['descripcion']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asigna las variables desde el formulario
        $idcompetencia = $_POST['idcompetencia'];
        $idcurso = $_POST['id_curso'];
        $descripcion = $_POST['descripcion'];
        $est_reg = $_POST['est_reg'];

        // Verifica si el nombre del curso ya existe
        $sql = 'SELECT * FROM competencia WHERE descripcion = ?';
        $params = [$descripcion];

        if (!empty($idcompetencia)) {
            $sql .= ' AND id_competencia != ?';
            $params[] = $idcompetencia;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'Descripcion de la competencia ya existe',
            );
        } else {
            if (empty($idcompetencia)) {   
                $sqlInsert = 'INSERT INTO competencia (id_curso, descripcion, est_reg) VALUES (?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($idcurso, $descripcion, $est_reg));
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE competencia SET id_curso = ?, descripcion = ?, est_reg = ? WHERE id_competencia = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($idcurso, $descripcion, $est_reg, $idcompetencia));
                $accion = 2;
            }

            if ($request) {
                $respuesta = array(
                    'status' => true,
                    'msg' => $accion == 1 ? 'Competencia creada correctamente' : 'Competencia actualizada correctamente'
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
