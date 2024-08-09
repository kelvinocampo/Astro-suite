<?php
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: ../inicio_sesion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si ocurrió un error al iniciar sesión
    if (isset($_GET['error']) && $_GET['error'] === 'inicio_sesion') {
        echo '<script>alert("Error al iniciar sesión. Verifica tus credenciales.");</script>';
    }

    header("Location:../perfil.php");
    exit();
}

$correoUsuario = $_SESSION['correo'];
$nombreUsuario = $_SESSION['nombre'];
$fechaUsuario = $_SESSION['fecha_nac'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Información de la Cuenta</title>
    <link rel="stylesheet" href="../css/editar_perfil.css">
</head>
<body>
    <center>
    <header>
    </header>
    <main>
        <h1>Cambiar Información de la Cuenta</h1>
        <form method="post" action="modales/procesar_perfil.php">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $correoUsuario; ?>">
            
            <label for "nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombreUsuario; ?>">
            
            <label for="fecha_nac">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nac" name="fecha_nac" value="<?php echo $fechaUsuario; ?>">
            <a href="javascript:history.go(-1);" class="cancel-button">Cancelar</a>
            <input type="submit" value="Guardar Cambios">
        </form>
    </main>
    </center>
</body>
</html>
