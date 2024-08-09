<?php
session_start();
include "conexion.php";
if (!isset($_SESSION['correo'])) {
    header("Location: inicio_sesion.php");
    exit();
}
if (isset($_GET['id_cursos'])) {
    $id_curso = $_GET['id_cursos'];
    $idUsuario=$_SESSION['id_usuario'];  
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $correoUsuario = $_SESSION['correo'];
    $sql_verificar = "SELECT * FROM usuarios_cursos WHERE id_usuario = '$idUsuario' AND id_curso = '$id_curso'";
    $resultado_verificar = $conexion->query($sql_verificar);
    
    if ($resultado_verificar->num_rows > 0) {
        echo "Ya estás inscrito en este curso.";
    } else {
        $sql_inscribir = "INSERT INTO usuarios_cursos (id_usuario, id_curso) VALUES ('$idUsuario', '$id_curso')";
        
        if ($conexion->query($sql_inscribir) === TRUE) {
            echo "Inscripción exitosa.";
        } else {
            echo "Error al inscribirse en el curso: " . $conexion->error;
        }
    }  
    header("Location: perfil.php");
    $conexion->close();
} else {
    echo "ID de curso no proporcionado.";
}
?>