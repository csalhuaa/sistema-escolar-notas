<?php
require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['id_docente']) || empty($_POST['id_curso']) || empty($_POST['id_aula'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son necesarios');
    } else {
        // Asignar variables desde el formulario
        $id_docente_aula = $_POST['iddocenteaula']; // Si se usa para actualización
        $id_docente = $_POST['id_docente'];
        $id_curso = $_POST['id_curso'];
        $id_aula = $_POST['id_aula'];

        // Verificar si ya existe el registro
        $sql = 'SELECT * FROM docente_aula WHERE id_docente = ? AND id_curso = ? AND id_aula = ?';
        $params = [$id_docente, $id_curso, $id_aula];

        if (!empty($id_docente_aula)) {
            $sql .= ' AND id_docente_aula != ?';
            $params[] = $id_docente_aula;
        }

        $query = $pdo->prepare($sql);
        $query->execute($params);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $respuesta = array(
                'status' => false,
                'msg' => 'Esta relación docente-aula-curso ya existe',
                'id_docente_aula' => $id_docente_aula
            );
        } else {
            // Insertar o actualizar el registro
            if (empty($id_docente_aula)) {
                $sqlInsert = 'INSERT INTO docente_aula (id_docente, id_curso, id_aula) VALUES (?, ?, ?)';
                $queryInsert = $pdo->prepare($sqlInsert);
                $request = $queryInsert->execute([$id_docente, $id_curso, $id_aula]);
                $accion = 1;
            } else {
                $sqlUpdate = 'UPDATE docente_aula SET id_docente = ?, id_curso = ?, id_aula = ? WHERE id_docente_aula = ?';
                $queryUpdate = $pdo->prepare($sqlUpdate);
                $request = $queryUpdate->execute([$id_docente, $id_curso, $id_aula, $id_docente_aula]);
                $accion = 2;
            }

            if ($request) {
                $respuesta = array(
                    'status' => true,
                    'msg' => $accion == 1 ? 'Relación creada correctamente' : 'Relación actualizada correctamente'
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
