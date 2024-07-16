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

            $sql = "SELECT u.*, r.nombre_rol, CONCAT(u.nombre, ' ', u.apellido_paterno, ' ', u.apellido_materno) AS nombre_completo
                    FROM Usuarios u
                    JOIN roles r ON u.id_rol = r.id_rol
                    WHERE u.nombre_usuario = ? AND r.nombre_rol = 'Administrador' AND u.est_reg = 'A'";

            
            // Prepara y ejecuta la consulta SQL
            $query = $pdo->prepare($sql);
            $query->execute([$login]);
            
            // Obtén el resultado
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Verifica si se obtuvieron filas
            if ($result) {
                // Verifica la contraseña usando password_verify
                if (password_verify($pass, $result['contraseña'])) {
                    $_SESSION['active'] = true;
                    $_SESSION['id_usuario'] = $result['id_usuario'];
                    $_SESSION['nombre_completo'] = $result['nombre_completo'];
                    $_SESSION['nombre_usuario'] = $result['nombre_usuario'];
                    $_SESSION['nombre_rol'] = $result['nombre_rol'];

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