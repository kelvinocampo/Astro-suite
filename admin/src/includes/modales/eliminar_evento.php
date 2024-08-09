<?php
require_once "../../../conexion.php";
session_start();

if ($_SESSION['active']) {
    if (!empty($_POST)) {
        $id_evento = $_POST['id_evento'];

        $query_delete = mysqli_query($conexion, "DELETE FROM eventos WHERE id_evento = $id_evento");

        if ($query_delete) {
            $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Evento eliminado
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } else {
            $error_message = mysqli_error($conexion);
            $alert = '<div class="alert alert-danger" role="alert">
                Error al eliminar el Evento: ' . $error_message . '
            </div>';
        }
    }

    header('Location:../../eventos.php');
} else {
    header('Location: ../../../index.php');
}
?>
