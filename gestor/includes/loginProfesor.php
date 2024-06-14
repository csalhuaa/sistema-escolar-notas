<?php
session_start();

if (!empty($_POST)) {
    if (empty($_POST['loginProfesor']) || empty($_POST['passProfesor'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        require_once "conexion.php"; // Asegúrate de que tu script de conexión esté correctamente incluido

        // Verifica si la conexión fue exitosa
        if ($pdo) {
            $login = $_POST['loginProfesor'];
            $pass = $_POST['passProfesor'];
            $sql = 'SELECT * FROM Usuarios AS u INNER JOIN Roles AS r ON u.tipo_usuario = r.ID WHERE u.nombre_usuario = ? AND u.Est_Reg = "A"';
            
            // Prepara y ejecuta la consulta SQL
            $query = $pdo->prepare($sql);
            $query->execute([$login]);
            
            // Obtén el resultado
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Verifica si se obtuvieron filas
            if ($result) {
                // Verifica la contraseña usando password_verify
                if (password_verify($pass, $result['contraseña'])) {
                    if($result['Est_Reg'] == 'A') {
                        $_SESSION['active'] = true;
                        $_SESSION['nombre'] = $result['nombre_usuario'];
                        $_SESSION['id_usuario'] = $result['ID'];
                        $_SESSION['rol'] = $result['ID'];
                        $_SESSION['nombre_rol'] = $result['nombre_rol'];

                        echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button>Redirecting</div>';
                    } else {
                        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario inactivo, comuníquese con el administrador!</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o clave incorrecta!</div>';
                }
            } else {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o clave incorrecta!</div>';
            }
        } else {    
            // Mensaje de error si la conexión no fue exitosa
            echo "Error: No se pudo conectar a la base de datos";
        }
    }
}
?>;
