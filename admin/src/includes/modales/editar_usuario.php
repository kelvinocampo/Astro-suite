<?php
include_once "../../../conexion.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $fecha_nac = $_POST['fecha_nac'];
    $correo = $_POST['correo'];


    $query = mysqli_query($conexion, "UPDATE usuarios SET nombre = '$nombre', fecha_nac = '$fecha_nac', correo = '$correo' WHERE id_usuario = $id_usuario");

    if ($query) {
        header('Location:../../usuarios.php'); 
        exit;
    } else {
        echo "Error al editar el usuario: " . mysqli_error($conexion);
    }
} else {
    echo "Método no permitido.";
}
?>