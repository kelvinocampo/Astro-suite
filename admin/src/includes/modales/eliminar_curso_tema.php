<?php
require_once "../../../conexion.php";

if (isset($_POST['id'])) {
    $id_curso_temas = $_POST['id'];
    $query = mysqli_query($conexion, "DELETE FROM cursos_temas WHERE id_curso_tema = '$id_curso_temas'");

    if ($query) {
        header('Location:../../curso_tema.php');
    } else {
        echo "Error al eliminar el enlace: " . mysqli_error($conexion);
    }
} else {
    echo "Parámetros no proporcionados.";
}
?>


