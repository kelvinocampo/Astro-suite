<?php
require_once "../../../conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_novedad']) && !empty($_POST['id_novedad'])) {
        $id_novedad = $_POST['id_novedad'];
        $query = "DELETE FROM novedades WHERE id_novedad = $id_novedad";
        $result = mysqli_query($conexion, $query);

        if ($result) {
            header("Location: ../../novedades.php");
        } else {
            echo "Error al eliminar la novedad: " . mysqli_error($conexion);
        }
    }
} else {
    header("Location:../../novedades.php");
}
?>