<?php
require_once "../../../conexion.php";

if (isset($_POST['id'])) {
    $id_curso_temas = $_POST['id'];
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['curso']);

    $queryu = mysqli_query($conexion, "SELECT id_usuario FROM usuarios WHERE correo = '$correo'");
    if ($queryu) {
        $rowu = mysqli_fetch_assoc($queryu);
        $id_user= $rowu['id_usuario'];
    } else {
        echo "Error al obtener el id del curso: " . mysqli_error($conexion);
        exit;
    }
    $queryc = mysqli_query($conexion, "SELECT id_curso FROM cursos WHERE nombre = '$nombre'");
    if ($queryc) {
        $rowc = mysqli_fetch_assoc($queryc);
        $id_curso = $rowc['id_curso'];
    } else {
        echo "Error al obtener el id del curso: " . mysqli_error($conexion);
        exit;
    }
    
    $query = "UPDATE usuarios_cursos SET id_curso=?, id_usuario = ? WHERE id_usuario_curso = ?";
    $stmt = mysqli_prepare($conexion, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi",$id_curso,$id_user, $id_curso_temas);
    
        if (mysqli_stmt_execute($stmt)) {
            header('Location:../../curso_usuario.php');
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