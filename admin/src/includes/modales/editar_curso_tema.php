<?php
require_once "../../../conexion.php";

if (isset($_POST['id_curso_tema'])) {
    $id_curso_temas = $_POST['id_curso_tema'];
    $id_tema = mysqli_real_escape_string($conexion, $_POST['tema']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['curso']);

    $queryc = mysqli_query($conexion, "SELECT id_curso FROM cursos WHERE nombre = '$nombre'");
    if ($queryc) {
        $rowc = mysqli_fetch_assoc($queryc);
        $id_curso = $rowc['id_curso'];
    } else {
        echo "Error al obtener el id del curso: " . mysqli_error($conexion);
        exit;
    }
    
    $query = "UPDATE cursos_temas SET id_curso=?, id_tema = ? WHERE id_curso_tema = ?";
    $stmt = mysqli_prepare($conexion, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi",$id_curso,$id_tema, $id_curso_temas);
    
        if (mysqli_stmt_execute($stmt)) {
            header('Location:../../curso_tema.php');
            exit;
        } else {
            echo "Error al editar el enlace: " . mysqli_error($conexion);
        }
    
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conexion);
    }
} else {
    echo "Método no permitido.";
}
?>