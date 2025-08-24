<?php
require_once "config.php";
// session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: inicio_sesion.php");
    exit();
}

$correoUsuario = isset($_SESSION['correo']) ? $_SESSION['correo'] : "";
$nombreUsuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : "";
$fechaUsuario = isset($_SESSION['fecha_nac']) ? $_SESSION['fecha_nac'] : "";
$idUsuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perfil Astro suite</title>
    <link rel="stylesheet" href="css/perfil.css">
</head>
<body>
        <header>
        <div class="logo">
            <img id="logo" src="image/logo2.jpeg">
        </div>
        <div class="title">
            <h1>Astro Suite</h1>
        </div>
        <nav>
            <ul>
                <li><a href="inicio.php">inicio</a></li>
                <li><a href="cursos.php">Cursos</a></li>
                <li><a href="informacion.php">Información</a></li>
                </ul>
        </nav>
    </header>
    <main>
    <h1>Perfil de Usuario</h1>
    <div class="contenedor">
    <a href="include/editar_perfil.php" class="editar-button">Cambiar Información de la Cuenta</a>
    <a href="include/cerrar_sesion.php" class="cerrar-button">Cerrar sesion</a>
    </div>
    <p>Correo Electrónico: <?php echo $correoUsuario; ?></p>
    <p>nombre: <?php echo $nombreUsuario; ?></p>
    <p>fecha de nacimiento : <?php echo $fechaUsuario; ?></p>
</main>
    <section class="cursos">
            <h2>Cursos Inscritos</h2>

            <div class="container">
            <?php
                include "conexion.php";
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }
                $sql = "SELECT cursos.nombre AS nombre_curso, cursos.dificultad AS cursos_dificultad, cursos.test AS cursos_test, temas.titulo AS temas_titulo,temas.id_tema AS tema_id_tema 
                FROM usuarios_cursos
                JOIN cursos ON usuarios_cursos.id_curso = cursos.id_curso
                JOIN cursos_temas ON cursos.id_curso = cursos_temas.id_curso
                JOIN temas ON cursos_temas.id_tema = temas.id_tema
                WHERE usuarios_cursos.id_usuario = '$idUsuario'";
                $result = $conexion->query($sql);
                if ($result !== false) {
                    echo '<div class="listaCursos">';
                    if ($result->num_rows > 0) {
                        $cursos = array();
                        while ($row = $result->fetch_assoc()) {
                            $curso = $row["nombre_curso"];
                            if (!isset($cursos[$curso])) {
                                $cursos[$curso] = array(
                                    "dificultad" => $row["cursos_dificultad"],
                                    "test" => $row["cursos_test"],
                                    "temas" => array(),
                                );
                            }
                            $cursos[$curso]["temas"][] = array(
                                "titulo" => $row["temas_titulo"],
                                "id_tema" => $row["tema_id_tema"],
                            );
                        }
                        foreach ($cursos as $nombreCurso => $infoCurso) {
                            echo '<li>';
                            echo '<div class="curso">';
                            echo '<h5>' . $nombreCurso . '</h5>';
                            echo '<p>Dificultad: ' . $infoCurso["dificultad"] . '</p>';
                            echo '<p>Temas:';
                            echo '<ul>';
                            foreach ($infoCurso["temas"] as $tema) {
                                echo '<li>';
                                echo '<a href="tema.php?id_tema=' . $tema["id_tema"] . '" target="_blank">' . $tema["titulo"] . '</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                            echo '</p>';
                            echo '<p><a href="' . $infoCurso["test"] . '">Test</a></p>';
                            echo '</li>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No estás inscrito en ningún curso.</p>";
                    }
                    echo "</div>";
                } else {
                    echo "Error en la consulta: " . $conexion->error;
                }

                $conexion->close();
            ?>
        </div>
    </section>
</body>
</html>