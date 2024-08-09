<?php
require_once "../../../conexion.php";

if (isset($_POST['id_tema'])) {
    $id_tema = $_POST['id_tema'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $pdf_nombre = $_FILES["pdf"]["name"];
        $pdf_temp = $_FILES["pdf"]["tmp_name"];
        $pdf_path = "../../pdf/tema/" . $pdf_nombre;
        $pdf_path2 = "pdf/tema/" . $pdf_nombre;
        move_uploaded_file($pdf_temp, $pdf_path);
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_temp = $_FILES["imagen"]["tmp_name"];
        $imagen_path = "../../image/temas/" . $imagen_nombre;
        $imagen_path2 = "image/temas/" . $imagen_nombre;
        move_uploaded_file($imagen_temp, $imagen_path);

        $query = "UPDATE temas SET titulo = ?, descripcion = ?,imagen = ? , pdf = ? WHERE id_tema = ?";
        $stmt = mysqli_prepare($conexion, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssi", $titulo, $descripcion, $imagen_path2, $pdf_path2, $id_tema );
    
            if (mysqli_stmt_execute($stmt)) {
                header('Location:../../Temas.php'); 
                exit;
            } else {
                echo "Error al editar el tema: " . mysqli_error($conexion);
            }
    
            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta";
        }
    } else {
        echo "Método no permitido.";
    }
    ?>