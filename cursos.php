<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos de Astro Suite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/cursos.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<header>
        <div class="logo">
            <img id="logo" src="image/logo2.jpeg">
        </div>
        <div class="title">
            <h1>Cursos de Astro Suite</h1>
        </div>
        <nav>
            <ul>
                <li><a href="inicio.php">inicio</a></li>
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
        <section class="cursos">
            <h2>Cursos Disponibles</h2>
            <input type="text" name="buscador" list="list" id="buscador" placeholder="Buscar...">
            <datalist id="list">
                <?php
                    $consultaCursos = "SELECT * FROM cursos";
                    $resultCursos = $conexion->query($consultaCursos);
                    if ($resultCursos->num_rows > 0) {
                        while ($row = $resultCursos->fetch_assoc()) {
                            echo "<option value='" . $row['nombre'] . "'></option>";
                        }
                    }
                ?>
            </datalist>
            <div class="container">
                <div id="card">
                    <?php
                    include "conexion.php";
                    if ($conexion->connect_error) {
                        die("Error de conexión: " . $conexion->connect_error);
                        echo '<ul class="listaCursos">';
                    }
                    $sql = "SELECT * FROM cursos";
                    $result = $conexion->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<li>';
                            echo '<a style="text-decoration:none" href="curso.php?id=' . $row["id_curso"] . '"><div class="curso">';
                            echo '<h1>' . $row["nombre"] . '</h1>';
                            echo '<p>' . $row["descripcion"] . '</p>';
                            echo '</li>';
                            echo '</div></a></ul>';
                        }
                    }
                    $conexion->close();
                    ?>
                </div>
            </div>
        </section>
        <script>
            jQuery(document).ready(function ($) {
                $('#buscador').keyup(function () {
                    var value = reemplazarAcentos($(this).val().toLowerCase());
                    $('.container .curso').hide().filter(function () {
                        return existText($(this).text(), value);
                    }).show();
                });

                function reemplazarAcentos(texto) {
                    return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                }

                function existText(text, value) {
                    return reemplazarAcentos(text.toLowerCase()).indexOf(value) != -1;
                }
            });
        </script>
    </main>
    <footer>
         
    </footer>
</body>
</html>
