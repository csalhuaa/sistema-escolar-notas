<?php
session_start();
if (!empty($_POST)) {
    if (empty($_POST['login']) || empty($_POST['pass'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        require_once "conexion.php"; // Asegúrate de que tu script de conexión esté correctamente incluido

        // Verifica si la conexión fue exitosa
        if ($pdo) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            $sql = "SELECT * FROM Usuarios WHERE nombre_usuario = ? AND tipo_usuario = 'docente' AND est_reg = 'A'";
            
            // Prepara y ejecuta la consulta SQL
            $query = $pdo->prepare($sql);
            $query->execute([$login]);
            
            // Obtén el resultado
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Verifica si se obtuvieron filas
            if ($result) {
                // Verifica la contraseña usando password_verify
                if (password_verify($pass, $result['contraseña'])) {
                    if($result['est_reg'] == 'A') {
                        $_SESSION['activeP'] = true;
                        $_SESSION['id_usuario'] = $result['id_usuario'];
                        $_SESSION['nombre_usuario'] = $result['nombre_usuario'];

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
?>