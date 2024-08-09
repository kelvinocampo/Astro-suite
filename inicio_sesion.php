<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: inicio.php');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['correo']) || empty($_POST['contraseña'])) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Ingrese usuario y contraseña
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            require "conexion.php";
            if (!$conexion) {
                die("Error en la conexión: " . mysqli_connect_error());
            }
            $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
            $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);
            $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo' AND contraseña = '$contraseña'");
            if (!$query) {
                die("Error en la consulta: " . mysqli_error($conexion));
            }
            $resultado = mysqli_num_rows($query);
            if ($resultado > 0) {
                $dato = mysqli_fetch_array($query);
                $_SESSION['id_usuario'] = $dato['id_usuario'];
                $_SESSION['nombre'] = $dato['nombre'];
                $_SESSION['correo'] = $dato['correo'];
                $_SESSION['fecha_nac'] = $dato['fecha_nac'];
                header('Location: perfil.php');
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Contraseña incorrecta
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                session_destroy();
            }
            mysqli_close($conexion);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion ASTRO SUITE</title>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link rel="stylesheet" href="css/inicio_sesion.css">
    
</head>
<body>
    <div class="container2">
    <label role="button" for="checkbox" class="switch">
        <input type="checkbox" id="checkbox" />
        <span class="switch__ball"></span>
        <i class="ri-sun-line switch__sun"></i>
        <i class="ri-moon-line switch__moon"></i>
    </label>
</div>
    
<center>
    <div class="container">
        
        <div class="titulo">  
            
            <h1>
                <strong>
                    INICIO DE SESION <br>
                    ASTROSUITE <br>
                </strong>
            </h1>
            
            <p class="text">
                web para aprender sobre <br> astronomia, astrofisica y astronautica
            </p>
        </div>
        

        <div>
            <div><script src="js/cambio-tema.js"></script></div>
            <form class="form" action="" method="post">
                <input type="email" name="correo" class="quest" id="correo" placeholder="correo electronico" required><br>
                <input type="password" name="contraseña" class="quest" id="contraseña" placeholder="contraseña" required><br>
                <input type="submit" class="boton" value="Ingresar">
                <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
            </form>
        </div>
    </div>
</center>
</body>
</html>