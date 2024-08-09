<?php
require_once "../conexion.php";
session_start();

if ($_SESSION['active']) {
    if (!empty($_POST)) {
        $alert = "";
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_temp = $_FILES["imagen"]["tmp_name"];
        $imagen = "image/temas/" . $imagen_nombre;
        move_uploaded_file($imagen_temp, $imagen);
        $pdf_nombre = $_FILES["pdf"]["name"];
        $pdf_temp = $_FILES["pdf"]["tmp_name"];
        $pdf = "pdf/tema/" . $pdf_nombre;
        move_uploaded_file($pdf_temp, $pdf);

        if (empty($titulo) || empty($descripcion)) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Todos los campos son obligatorios
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } else {
            $query = mysqli_query($conexion, "SELECT * FROM temas WHERE titulo = '$titulo'");
            $result = mysqli_fetch_array($query);
            if ($result > 0) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    El Tema ya existe
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $query_insert = mysqli_query($conexion, "INSERT INTO temas(titulo, descripcion, imagen, pdf) VALUES ('$titulo', '$descripcion', '$imagen', '$pdf')");

                if ($query_insert) {
                    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Tema registrado
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                } else {
                    $error_message = mysqli_error($conexion);
                    $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar el Tema: ' . $error_message . '
                    </div>';
                }
            }
        }
    }

    include_once "includes/header.php";
?>
<!-- MODAL ELIMINAR -->
<?php
    $query_temas = mysqli_query($conexion, "SELECT * FROM temas");
    if ($query_temas) {
        while ($data_tema = mysqli_fetch_assoc($query_temas)) {
            echo '<div class="modal fade" id="deleteTema' . $data_tema['id_tema'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteTemaLabel' . $data_tema['id_tema'] . '" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteTemaLabel' . $data_tema['id_tema'] . '">Eliminar Tema</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar este tema?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <form action="includes/modales/eliminar_tema.php" method="post">
                                <input type="hidden" name="id_tema" value="' . $data_tema['id_tema'] . '">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
        }
    } 
?>
<!-- MODAL EDITAR -->
<?php
    $query_temas = mysqli_query($conexion, "SELECT * FROM temas");
    if ($query_temas) {
        while ($data_tema = mysqli_fetch_assoc($query_temas)) {
            echo '<div class="modal fade" id="editarTema' . $data_tema['id_tema'] . '" tabindex="-1" role="dialog" aria-labelledby="editarTemaLabel' . $data_tema['id_tema'] . '" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarTemaLabel' . $data_tema['id_tema'] . '">Editar Tema</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario para editar los datos del tema -->
                            <form method="post" action="includes/modales/editar_tema.php" enctype="multipart/form-data">
                                <!-- Campos de edición -->
                                <input type="hidden" name="id_tema" value="' . $data_tema['id_tema'] . '">
                                <div class="form-group">
                                    <label for="titulo">Título</label>
                                    <input type="text" class="form-control" name="titulo" value="' . $data_tema['titulo'] . '">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" class="form-control" name="descripcion" value="' . $data_tema['descripcion'] . '">
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen (Obligatorio para editar)</label>
                                    <input type="file" class="form-control" name="imagen" id="imagen">
                                </div>
                                <div class="form-group">
                                    <label for="pdf">PDF (Obligatorio para editar)</label>
                                    <input type="file" class="form-control" name="pdf" id="pdf">
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
                            <h3 align="center">Registrar Tema</h3><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titulo" class="text-dark font-weight-bold">Título</label>
                                        <input type="text" placeholder="Título" name="titulo" id="titulo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class "form-group">
                                        <label for="descripcion" class="text-dark font-weight-bold">Contenido</label>
                                        <input type="text" placeholder="Contenido MAX 10000" class="form-control" name="descripcion" id="descripcion">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="imagen" class="text-dark font-weight-bold">Imagen del Tema</label>
                                        <input type="file" class="form-control" name="imagen" id="imagen">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pdf" class="text-dark font-weight-bold">PDF del Tema</label>
                                        <input type="file" class="form-control" name="pdf" id="pdf">
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
            <h3 align="center">Listado de temas</h3>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tbl">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Imagen</th>
                                    <th>PDF</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_temas = mysqli_query($conexion, "SELECT * FROM temas");
                                if ($query_temas) {
                                    $result_temas = mysqli_num_rows($query_temas);
                                    if ($result_temas > 0) {
                                        while ($data_tema = mysqli_fetch_assoc($query_temas)) {
                                            echo '<tr>
                                                <td>' . $data_tema["id_tema"] . '</td>
                                                <td>' . $data_tema["titulo"] . '</td>
                                                <td>' . $data_tema["descripcion"] . "</td>
                                                <td><img style='width:100px; height=100px;' src='" . $data_tema["imagen"] . "'</td>
                                                <td>" . $data_tema["pdf"] . '</td>
                                                <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteTema' . $data_tema['id_tema'] . '">
                                                Eliminar
                                                </button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarTema' . $data_tema['id_tema'] . '">
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
} 
?>
