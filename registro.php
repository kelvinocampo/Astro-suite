<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro ASTRO SUITE</title>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
    rel="stylesheet"/>
    <link rel="stylesheet" href="css/registro.css">
    
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
                    REGISTRO <br>
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
                <input type="text" name="nombre" id="nombre" placeholder="nombre completo" class="quest" required><br>
                <input type="date" name="fecha_nac" class="quest" id="fecha_nac" placeholder="fecha de nacimiento" required><br>
                <input type="email" name="correo" class="quest" id="correo" placeholder="correo electronico" required><br>
                <input type="password" name="contraseña" class="quest" id="contraseña" placeholder="contraseña" required><br>
                <input type="submit" class="boton" value="registrar">
                <p>Ya tienes cuenta? <a href="inicio_sesion.php">Inicia sesion</a></p>
            </form>
        </div>
        <?php
            session_start();
            include "conexion.php";
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nombre = $_POST['nombre'];
                    $correo = $_POST['correo'];
                    $fecha_nac = $_POST['fecha_nac'];
                    $contraseña = $_POST['contraseña'];

                $consulta = "SELECT * FROM usuarios WHERE correo = '$correo'";
                $resultado = $conexion->query($consulta);

                if ($resultado->num_rows > 0) {
                    $mensajeError = "El correo electrónico ya está registrado.";
                    echo "<div class='alerta'>".$mensajeError."</div>";
                } else {
                    $sql = "INSERT INTO usuarios (nombre, fecha_nac, correo, contraseña)
                            VALUES ('$nombre', '$fecha_nac', '$correo', '$contraseña')";

                    if ($conexion->query($sql) === TRUE) {
                        header("Location: inicio_sesion.php");
                        exit();
                    } else {
                        $mensajeError = "Error al registrar el usuario: " . $conexion->error;
                        echo "<div class='alerta'>".$mensajeError."</div>";
                    }
                }
            }
            $conexion->close();
        ?>
    </div>
        
</center>
</body>
</html>