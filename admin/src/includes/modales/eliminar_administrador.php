<?php
require_once "../../../conexion.php";
if ($_POST) {
    $doc_administrador = $_POST['doc_administrador'];

    $query = "DELETE FROM administradores WHERE doc_administrador = '$doc_administrador'";

    if (mysqli_query($conexion, $query)) {
        header("Location: ../../config.php");
    } else {
        echo "Error al eliminar el administrador: " . mysqli_error($conexion);
    }
}
?>




