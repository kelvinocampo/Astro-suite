<?php
include_once "../../../conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_curso = $_POST['id_curso'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen_nombre = $_FILES["imagen"]["name"];
    $imagen_temp = $_FILES["imagen"]["tmp_name"];
    $ruta_imagen = "../../image/cursos/" . $imagen_nombre;
    $ruta_imagen2 = "image/cursos/" . $imagen_nombre;
    move_uploaded_file($imagen_temp, $ruta_imagen);

    $dificultad = $_POST['dificultad'];
    $test = $_POST['test'];

    $query = "UPDATE cursos SET nombre = ?, descripcion = ?,imagen = ? , dificultad = ?, test = ? WHERE id_curso = ?";
    $stmt = mysqli_prepare($conexion, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $descripcion, $ruta_imagen2, $dificultad, $test, $id_curso);

        if (mysqli_stmt_execute($stmt)) {
            header('Location:../../Cursos.php'); 
            exit;
        } else {
            echo "Error al editar el curso: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error al preparar la consulta";
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }
} else {
    echo "Método no permitido.";
}
?>