<?php
session_start();
require_once "conexion.php"; // Asegúrate de que tu script de conexión esté correctamente incluido

if (!empty($_POST)) {
    if (empty($_POST['login']) || empty($_POST['pass'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        // Verifica si la conexión fue exitosa
        if ($pdo) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            $sql = "SELECT u.*, r.nombre_rol, CONCAT(u.nombre, ' ', u.apellido_paterno, ' ', u.apellido_materno) AS nombre_completo
                    FROM usuarios u
                    JOIN roles r ON u.id_rol = r.id_rol
                    WHERE u.nombre_usuario = ? AND r.nombre_rol = 'Docente' AND u.est_reg = 'A'";

            // Prepara y ejecuta la consulta SQL
            $query = $pdo->prepare($sql);
            $query->execute([$login]);

            // Obtén el resultado
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // Inicializa el contador de intentos fallidos si no existe
            if (!isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts'] = [];
            }

            // Verifica si se obtuvieron filas
            if ($result) {
                // Verifica si hay demasiados intentos fallidos
                if (isset($_SESSION['login_attempts'][$login]) && $_SESSION['login_attempts'][$login] >= 3) {
                    // Cambia el estado del usuario a inactivo
                    $sql_set_inactive = "UPDATE Usuarios SET est_reg = 'I' WHERE id_usuario = ?";
                    $query_set = $pdo->prepare($sql_set_inactive);
                    $query_set->execute([$result['id_usuario']]);

                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario inactivo por demasiados intentos fallidos, comuníquese con el administrador</div>';
                } else {
                    // Verifica la contraseña usando password_verify
                    if (password_verify($pass, $result['contraseña'])) {
                        $_SESSION['activeP'] = true;
                        $_SESSION['id_usuario'] = $result['id_usuario'];
                        $_SESSION['nombre_completo'] = $result['nombre_completo'];
                        $_SESSION['nombre_usuario'] = $result['nombre_usuario'];
                        $_SESSION['nombre_rol'] = $result['nombre_rol'];

                        // Restablece el contador de intentos fallidos
                        unset($_SESSION['login_attempts'][$login]);

                        echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button>Redirecting</div>';
                    } else {
                        // Incrementa el contador de intentos fallidos
                        if (!isset($_SESSION['login_attempts'][$login])) {
                            $_SESSION['login_attempts'][$login] = 0;
                        }
                        $_SESSION['login_attempts'][$login] += 1;

                        // Si el siguiente intento fallido excede el límite, cambiar el estado del usuario a inactivo
                        if ($_SESSION['login_attempts'][$login] >= 3) {
                            $sql_set_inactive = "UPDATE Usuarios SET est_reg = 'I' WHERE id_usuario = ?";
                            $query_set = $pdo->prepare($sql_set_inactive);
                            $query_set->execute([$result['id_usuario']]);

                            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario inactivo por demasiados intentos fallidos, comuníquese con el administrador</div>';
                        } else {
                            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o clave incorrecta!</div>';
                        }
                    }
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
