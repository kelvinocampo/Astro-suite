<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso de Astrofísica Básica</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/curso.css">
</head>
<body>
    <header>
        <div class="logo">
            <img id="logo" src="image/logo2.jpeg">
        </div>
        <div class="title">
            <?php
            require_once "conexion.php";
            if (isset($_GET['id'])) {
                $id_curso = $_GET['id'];
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }
                $sql = "SELECT * FROM cursos WHERE id_curso = '$id_curso'";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<h1>" . $row["nombre"] . "</h1>";
                } else {
                    echo "Curso no encontrado.";
                }
                $conexion->close();
            } else {
                echo "ID de curso no proporcionado.";
            }
            ?>
        </div>
        <nav>
            <ul>
                <li><a href="inicio.php">inicio</a></li>
                <li><a href="Cursos.php">cursos</a></li>
                <li><a href="informacion.php">Información</a></li>
                <?php
                session_start();
                require_once "conexion.php";

                if (isset($_SESSION['active']) && isset($_SESSION['nombre'])) {
                    $nombre = $_SESSION['nombre'];

                    echo '<div class="sidebar">
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <a href="perfil.php">
                                    <i class="fas fa-user-circle fa-2x text-info"></i>
                                </a>
                            </div>
                            <div class="info">
                                <a href="perfil.php" class="d-block"></a>
                            </div>
                        </div>
                    </div>';
                } else {
                    echo '<div class="sidebar">
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <a href="perfil.php">
                                    <i class="fas fa-user-circle fa-2x text-info"></i>
                                </a>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
    <section class="curso-detalle">
    <?php
include "conexion.php";
if (isset($_GET['id'])) {
    $id_curso = $_GET['id'];
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $sql = "SELECT c.nombre AS nombre_curso, c.descripcion AS cursos_descripcion, c.dificultad AS cursos_dificultad, c.test AS cursos_test, c.imagen AS cursos_imagen, t.titulo AS temas_titulo, t.id_tema AS tema_id_tema 
            FROM cursos c
            INNER JOIN cursos_temas ct ON c.id_curso = ct.id_curso
            INNER JOIN temas t ON ct.id_tema = t.id_tema
            WHERE c.id_curso = '$id_curso'";
    $result = $conexion->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagen = $row["cursos_imagen"];
        echo "<div class='curso-image'><img src='admin/src/" . $imagen . "'></div>";
        echo "<div class='curso-info'><h2>" . $row["nombre_curso"] . "</h2>";
        echo "<p>" . $row["cursos_descripcion"] . "</p>";
        echo "<strong><p>Dificultad:</strong> " . $row["cursos_dificultad"] . "</p>";
        echo "<h3>Contenido del curso</h3>";
        echo '<ul>';
        echo '<li>' . $row["temas_titulo"] . '</li>';
        while ($row = $result->fetch_assoc()) {
            echo '<li>' . $row["temas_titulo"] . '</li>';
        }
        echo '</ul>';
        echo "<a href='inscripcioncurso.php?id_cursos=$id_curso' class='editar-button'>Inscribirse</a>";
    } else {
        echo "Curso no encontrado.";
    }
    $conexion->close();
} else {
    echo "ID de curso no proporcionado.";
}
?>

            </div>
        </section>
    </main>
    <footer>
    </footer>
</body>
</html>
