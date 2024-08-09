<?php
require_once "../../../conexion.php";
if (isset($_POST['id_novedad'])) {
        $id_novedad = $_POST['id_novedad'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $link = $_POST['link'];
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_temp = $_FILES["imagen"]["tmp_name"];
        $imagen = "../../image/novedad/" . $imagen_nombre;
        $imagen2 = "image/novedad/" . $imagen_nombre;
        move_uploaded_file($imagen_temp, $imagen);

        if (empty($nombre) || empty($descripcion) || empty($link)) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Todos los campos son obligatorios
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } else {
            $query_update = mysqli_query($conexion, "UPDATE novedades SET nombre = '$nombre', descripcion = '$descripcion', link = '$link', imagen = ' $imagen2 ' WHERE id_novedad = $id_novedad");

            if ($query_update) {
                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    novedad actualizada
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $error_message = mysqli_error($conexion);
                $alert = '<div class="alert alert-danger" role="alert">
                    Error al actualizar la Novedad: ' . $error_message . '
                </div>';
            }
        }
    }
    header('Location: ../../novedades.php');
?>