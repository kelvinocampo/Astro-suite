<?php
require_once "../../../conexion.php";
session_start();

if ($_SESSION['active']) {
    if (!empty($_POST)) {
        $alert = "";
        $id_evento = $_POST['id_evento'];
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_temp = $_FILES["imagen"]["tmp_name"];
        $imagen = "../../image/eventos/" . $imagen_nombre;
        $imagen2 = "image/eventos/" . $imagen_nombre;
        move_uploaded_file($imagen_temp, $imagen);

        if (empty($nombre) || empty($fecha)) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Todos los campos son obligatorios
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } else {
            $query_update = mysqli_query($conexion, "UPDATE eventos SET nombre = '$nombre', fecha = '$fecha', imagen = '$imagen2' WHERE id_evento = $id_evento");

            if ($query_update) {
                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Evento actualizado
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $error_message = mysqli_error($conexion);
                $alert = '<div class="alert alert-danger" role="alert">
                    Error al actualizar el Evento: ' . $error_message . '
                </div>';
            }
        }
    }

    header('Location: ../../eventos.php');
} 
?>