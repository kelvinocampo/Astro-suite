<?php
include "../../../conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_curso = $_POST['id_curso'];
    $query = "DELETE FROM cursos WHERE id_curso = $id_curso";

    if (mysqli_query($conexion, $query)) {
        header('Location:../../Cursos.php');
        exit;
    } else {
        echo "Error al eliminar el curso: " . mysqli_error($conexion);
    }
} else {
    header('Location:../../Cursos.php');
    exit;
}

mysqli_close($conexion);
?>





