<?php
include "../../..//conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $query = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";

    if (mysqli_query($conexion, $query)) {
        header('Location:../../usuarios.php'); 
        exit;
    } else {
        echo "Error al eliminar el usuario: " . mysqli_error($conexion);
    }
} else {
    header('Location: usuarios.php');
    exit;
}

mysqli_close($conexion);
?>




