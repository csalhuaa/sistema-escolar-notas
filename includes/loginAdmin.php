<?php
session_start();
if (!empty($_POST)) {
    if (empty($_POST['login']) || empty($_POST['pass'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        require_once "conexion.php"; 
        
        // Verifica si la conexión fue exitosa
        if ($pdo) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            $sql = 'SELECT * FROM Usuarios AS u INNER JOIN Roles AS r ON u.Usuario_Rol = r.RolId WHERE u.Usuario_Nombre = ?';
            
            // Prepara y ejecuta la consulta SQL
            $query = $pdo->prepare($sql);
            $query->execute([$login]);
            
            // Obtén el resultado
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Verifica si se obtuvieron filas
            if ($result) {
                // Verifica la contraseña usando password_verify
                if (password_verify($pass, $result['Usuario_Password'])) {
                    $_SESSION['active'] = true;
                    $_SESSION['nombre'] = $result['Usuario_Nombre'];
                    $_SESSION['id_usuario'] = $result['Usuario_Id'];
                    $_SESSION['rol'] = $result['RolId'];
                    $_SESSION['nombre_rol'] = $result['RolNombre'];

                    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button>Redirecting</div>';
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
?>
