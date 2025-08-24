<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tema</title>
    <link rel="stylesheet" href="css/tema.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body>
    <header>
        <div class="logo">
            <img id="logo" src="image/logo2.jpeg">
        </div>
        <div class="title">
            <?php
            require_once "conexion.php";
            if (isset($_GET['id_tema'])) {
                $id_tema = $_GET['id_tema'];
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }
                $sql = "SELECT * FROM temas WHERE id_tema = '$id_tema'";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<h1>" . $row["titulo"] . "</h1>";
                } else {
                    echo "tema no encontrado.";
                }
                $conexion->close();
            } else {
                echo "ID de tema no proporcionado.";
            }
            ?>
        </div>
        <nav>
            <ul>
                <li><a href="inicio.php">inicio</a></li>
                <li><a href="cursos.php">cursos</a></li>
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
    <section class="tema-detalle">
    <?php
include "conexion.php";
if (isset($_GET['id_tema'])) {
    $id_tema = $_GET['id_tema'];
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $sql = "SELECT * from temas where id_tema='$id_tema'";
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagen = $row["imagen"];
        $pdf = $row["pdf"];
        echo "<div class='tema-image'><img src='admin/src/" . $imagen . "'></div>";
        echo "<div class='tema-info'><h2>" . $row["titulo"] . "</h2>";
        echo "<p>" . $row["descripcion"] . "</p>";
        echo '<a href="admin/src/' . $pdf . '" download><button>Descargar PDF</button></a>';
    } else {
        echo "tema no encontrado.";
    }
    $conexion->close();
} else {
    echo "ID de tema no proporcionado.";
}
?>

            </div>
        </section>
    </main>
    <footer>
    </footer>
</body>
</html>
