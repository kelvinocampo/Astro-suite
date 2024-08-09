<?php
require_once "../../../conexion.php";

if (isset($_POST['id_tema'])) {
    $id_tema = $_POST['id_tema'];
    $query1 = "DELETE FROM curso_temas WHERE temas_id_tema= $id_tema";
    if ($query1) {
        $result1 = mysqli_query($conexion, $query1);
    }  
    $query = mysqli_query($conexion, "DELETE FROM temas WHERE id_tema = '$id_tema'");

    if ($query) {
        header('Location:../../Temas.php');
    } else {
        echo "Error al eliminar el tema: " . mysqli_error($conexion);
    }
} else {
    echo "Parámetros no proporcionados.";
}
?>


