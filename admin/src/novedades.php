<?php
require_once "../conexion.php";
session_start();

if ($_SESSION['active']) {
    if (!empty($_POST)) {
        $alert = "";
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $link = $_POST['link'];
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_temp = $_FILES["imagen"]["tmp_name"];
        $imagen = "image/novedad/" . $imagen_nombre;
        move_uploaded_file($imagen_temp, $imagen);

        if (empty($nombre) || empty($descripcion) || empty($link)) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Todos los campos son obligatorios
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } else {

            $query = mysqli_query($conexion, "SELECT * FROM novedades WHERE nombre = '$nombre'");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    La novedad ya existe
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $query_insert = mysqli_query($conexion, "INSERT INTO novedades(nombre, descripcion, link, imagen) VALUES ('$nombre', '$descripcion', '$link', '$imagen')");

                if ($query_insert) {
                    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Novedad registrada
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                } else {
                    $error_message = mysqli_error($conexion);
                    $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar la Novedad: ' . $error_message . '
                    </div>';
                }
            }
        }
    }

    include_once "includes/header.php";
?>
<?php
    $query_novedades = mysqli_query($conexion, "SELECT * FROM novedades");
    if ($query_novedades) {
        while ($data_novedad = mysqli_fetch_assoc($query_novedades)) {
            echo '<div class="modal fade" id="deleteNovedad' . $data_novedad['id_novedad'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteNovedadLabel' . $data_novedad['id_novedad'] . '" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteNovedadLabel' . $data_novedad['id_novedad'] . '">Eliminar Novedad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar esta novedad?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <form action="includes/modales/eliminar_novedad.php" method="post">
                                <input type="hidden" name="id_novedad" value="' . $data_novedad['id_novedad'] . '">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
?>
<?php
    $query_novedades = mysqli_query($conexion, "SELECT * FROM novedades");
    if ($query_novedades) {
        while ($data_novedad = mysqli_fetch_assoc($query_novedades)) {
            echo '<div class="modal fade" id="editarNovedad' . $data_novedad['id_novedad'] . '" tabindex="-1" role="dialog" aria-labelledby="editarNovedadLabel' . $data_novedad['id_novedad'] . '" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarNovedadLabel' . $data_novedad['id_novedad'] . '">Editar Novedad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario para editar los datos de la novedad -->
                            <form method="post" action="includes/modales/editar_novedad.php" enctype="multipart/form-data">
                                <!-- Campos de edición -->
                                <input type="hidden" name="id_novedad" value="' . $data_novedad['id_novedad'] . '">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="' . $data_novedad['nombre'] . '">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" name="descripcion" value="' . $data_novedad['descripcion'] . '">
                                </div>
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" class="form-control" name="link" value="' . $data_novedad['link'] . '">
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen (Obligatorio para editar)</label>
                                    <input type="file" class="form-control" name="imagen" id="imagen">
                                </div>
                                <!-- Más campos de edición aquí -->
                                <!-- ... -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>      
                    </div>
                </div>
            </div>';
        }
    }
?>
<div class="card shadow-lg">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" autocomplete="off" id="formulario" enctype="multipart/form-data">
                            <?php echo isset($alert) ? $alert : ''; ?>
                            <h3 align="center">Registrar Novedad</h3><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre" class="text-dark font-weight-bold">Nombre</label>
                                        <input type="text" placeholder="Nombre" name="nombre" id="nombre" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion" class="text-dark font-weight-bold">Descripción</label>
                                        <input type="text" placeholder="Descripción" class="form-control" name="descripcion" id="descripcion">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="link" class="text-dark font-weight-bold">Link</label>
                                        <input type="text" placeholder="Link" class="form-control" name="link" id="link">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="imagen" class="text-dark font-weight-bold">Imagen de la Novedad</label>
                                        <input type="file" class="form-control" name="imagen" id="imagen">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <input type="submit" value="Registrar" class="btn btn-primary" id="btnAccion">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <br>
            <h3 align="center">Listado de novedades</h3>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tbl">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Link</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_novedades = mysqli_query($conexion, "SELECT * FROM novedades");
                                if ($query_novedades) {
                                    $result_novedades = mysqli_num_rows($query_novedades);
                                    if ($result_novedades > 0) {
                                        while ($data_novedad = mysqli_fetch_assoc($query_novedades)) {
                                            echo '<tr>
                                                <td>' . $data_novedad["id_novedad"] . '</td>
                                                <td>' . $data_novedad["nombre"] . '</td>
                                                <td>' . $data_novedad["descripcion"] . '</td>
                                                <td>' . $data_novedad["link"] . "</td>
                                                <td><img style='width:100px; height=100px;' src='" . $data_novedad["imagen"] . "'</td>
                                                <td>".'
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteNovedad' . $data_novedad['id_novedad'] . '">
                                                Eliminar
                                                </button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarNovedad' . $data_novedad['id_novedad'] . '">
                                                Editar
                                                </button>
                                                </td>
                                                </tr>';
                                        }
                                    } else {
                                        echo "No se encontraron resultados.";
                                    }
                                } else {
                                    echo "Error en la consulta: " . mysqli_error($conexion);
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php";
} else {
    header('Location: permisos.php');
}
?>