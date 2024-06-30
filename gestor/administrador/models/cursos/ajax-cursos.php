<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['Nombre']) || empty($_POST['descripcion']) || empty($_POST['est_reg'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asigna las variables desde el formulario
        $idcurso = $_POST['idcurso'];
        $nombre = $_POST['Nombre'];
        $descripcion = $_POST['descripcion'];
        $est_reg = $_POST['est_reg'];

        // Verifica si el nombre del curso ya existe
        $sql = 'SELECT * FROM cursos WHERE nombre = ? AND est_reg = "A"';
        $params = [$nombre];

        if (!empty($idcurso)) {
            $sql .= ' AND id_curso != ?';
            $params[] = $idcurso;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'El nombre del curso ya existe',
            );
        } else {
            // Crea un nuevo curso o actualiza uno existente
            if (empty($idcurso)) {   
                $sqlInsert = 'INSERT INTO cursos (nombre, descripcion, est_reg) VALUES (?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute(array($nombre, $descripcion, $est_reg));
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE cursos SET nombre = ?, descripcion = ?, est_reg = ? WHERE id_curso = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute(array($nombre, $descripcion, $est_reg, $idcurso));
                $accion = 2;
            }

            if ($request) {
                $respuesta = array(
                    'status' => true,
                    'msg' => $accion == 1 ? 'Curso creado correctamente' : 'Curso actualizado correctamente'
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
