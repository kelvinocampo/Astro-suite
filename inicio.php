<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astro suite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/inicio.css">
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
                <li><a href="cursos.php">Cursos</a></li>
                <li><a href="informacion.php">Información</a></li>
                <?php
// session_start();
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
        <section class="intro">
            <h2>Explora el Universo</h2>
            <p>Descubre cursos, realiza tests y encuentra información fascinante sobre astronomía y astrofísica.</p>
        </section>
        <div class="container">
    <div class="eventos">
        <h2>Eventos</h2>
        <ul>
            <?php
            include "conexion.php";
            $resultado = mysqli_query($conexion, "SELECT * FROM eventos");
            while ($consulta = mysqli_fetch_array($resultado)) {
                echo '<li>';
                echo '<h3 class="titulo_evento">' . $consulta['nombre'] . '</h3>';
                echo '<p class="fecha_evento">' . $consulta['fecha'] . '</p>';
                echo '<div class="imagen_evento"><img src="admin/src/' . $consulta['imagen'] . '" alt=""></div>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>

    <div class="novedades">
        <h2>Novedades</h2>
        <ul>
            <?php
            include "conexion.php";
            $resultado = mysqli_query($conexion, "SELECT * FROM novedades");
            while ($consulta = mysqli_fetch_array($resultado)) {
                echo '<li>';
                echo '<h3 class="titulo_novedad">' . $consulta['nombre'] . '</h3>';
                echo '<p class="descripcion_novedad">' . $consulta['descripcion'] . '</p>';
                echo '<img src="admin/src/'.$consulta['imagen'].'" alt="">';
                echo '<div class="link_novedad"><a href="' . $consulta['link'] . '">leer más</a>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>
</div>
    </main>
    <footer class="wrapper">
        <p>&copy; 2023 Astrosuite</p>
        <div class="icons facebook">
            <a href="https://www.facebook.com/profile.php?id=61550944603481&mibextid=ZbWKwL" target="_blank">
            <div class="tooltip">
                Facebook
            </div>
            <span> <i class="fab fa-facebook"></i></span>
        </a>
        </div>
       

        <div class="icons instagram">
            <a href="https://instagram.com/astro_suite_page?igshid=NzZlODBkYWE4Ng==" target="_blank">
            <div class="tooltip">
                Instagram
            </div>
            <span> <i class="fab fa-instagram"></i></span>
        </a>
        </div>

        <div class="icons twitter">
            <a href="https://twitter.com/AstroSuite21?t=CZX73CNgM4YydsE4w_XTsg&s=09" target="_blank">
            <div class="tooltip">
                Twitter
            </div>
            <span> <i class="fab fa-twitter"></i></span>
        </a>
        </div>

        <div class="icons youtube">
            <a href="https://cutt.ly/BRogLTd" target="_blank">
            <div class="tooltip">
                Youtube
            </div>
            <span> <i class="fab fa-youtube"></i></span>
        </a>
        </div>
    </footer>
</body>
</html>
