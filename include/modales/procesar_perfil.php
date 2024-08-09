<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: ../../inicio_sesion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../../conexion.php";

    $idUsuario = $_SESSION['id_usuario'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $fechaNacimiento = $_POST['fecha_nac'];

    if (empty($nombre) || empty($correo) || empty($fechaNacimiento)) {
        header("Location: editar_perfil.php?error=Campos incompletos");
        exit();
    }

    $query = "UPDATE usuarios SET nombre = ?, correo = ?, fecha_nac = ? WHERE id_usuario = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sssi", $nombre, $correo, $fechaNacimiento, $idUsuario);

    if ($stmt->execute()) {
        header("Location: ../../perfil.php?success=Perfil actualizado correctamente");
    } else {
        header("Location: ../../perfil.php?error=Error al actualizar el perfil");
    }

    $stmt->close();
    $conexion->close();
} else {
    header("Location:../../inicio_sesion.php");
    exit();
}
?>
