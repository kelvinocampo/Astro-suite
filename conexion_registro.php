<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registro_est</title>
</head>
<body>
    <?php
    $conexion=mysqli_connect("localhost","root","","Astro_Suite")
    or die ("problemas en la conexion ");
    if ($conexion==true) {
        $usuario=$_POST["usuario"];
        $correo=$_POST["correo"];
        $password=$_POST["password"];

        $insertar=mysqli_query($conexion,"INSERT INTO usuarios(usuario,correo,password)
        values ('$usuario','$correo','$password')")
        or die ("problemas con el registro de datos".mysqli_error($conexion));
        if ($insertar==true) {
        header("Location: inicio.php");
        exit;
        }else
            echo $insertar;
    }else {
        echo $conexion;
    }

    ?>
</body>
</html>