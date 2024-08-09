<?php
require_once "../../../conexion.php";

if (isset($_POST['id'])) {
    $id_usuario_curso = $_POST['id'];
    $query = mysqli_query($conexion, "DELETE FROM usuarios_cursos WHERE id_usuario_curso = '$id_usuario_curso'");

    if ($query) {
        header('Location:../../curso_usuario.php');
    } else {
        echo "Error al eliminar la inscripcion: " . mysqli_error($conexion);
    }
} else {
    echo "Parámetros no proporcionados.";
}
?>