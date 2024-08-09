<?php
require_once "../conexion.php";
session_start();
if ($_SESSION['active']) {
    if (!empty($_POST)) {
        $alert = "";
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_temp = $_FILES["imagen"]["tmp_name"];
        $imagen = "image/eventos/" . $imagen_nombre;
        move_uploaded_file($imagen_temp, $imagen);

        if (empty($nombre) || empty($fecha)) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Todos los campos son obligatorios
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } else {

            $query = mysqli_query($conexion, "SELECT * FROM eventos WHERE nombre = '$nombre'");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    El evento ya existe
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $query_insert = mysqli_query($conexion, "INSERT INTO eventos(nombre, fecha, imagen) VALUES ('$nombre', '$fecha', '$imagen')");

                if ($query_insert) {
                    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Evento registrado
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                } else {
                    $error_message = mysqli_error($conexion);
                    $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar el Evento: ' . $error_message . '
                    </div>';
                }
            }
        }
    }

    include_once "includes/header.php";
?>
<?php
    $query_eventos = mysqli_query($conexion, "SELECT * FROM eventos");
    if ($query_eventos) {
        while ($data_evento = mysqli_fetch_assoc($query_eventos)) {
            echo '<div class="modal fade" id="deleteEvento' . $data_evento['id_evento'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteEventoLabel' . $data_evento['id_evento'] . '" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteEventoLabel' . $data_evento['id_evento'] . '">Eliminar Evento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar este evento?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <form action="includes/modales/eliminar_evento.php" method="post">
                                <input type="hidden" name="id_evento" value="' . $data_evento['id_evento'] . '">
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
    $query_eventos = mysqli_query($conexion, "SELECT * FROM eventos");
    if ($query_eventos) {
        while ($data_evento = mysqli_fetch_assoc($query_eventos)) {
            echo '<div class="modal fade" id="editarEvento' . $data_evento['id_evento'] . '" tabindex="-1" role="dialog" aria-labelledby="editarEventoLabel' . $data_evento['id_evento'] . '" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarEventoLabel' . $data_evento['id_evento'] . '">Editar Evento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario para editar los datos del evento -->
                            <form method="post" action="includes/modales/editar_evento.php" enctype="multipart/form-data">
                                <!-- Campos de edición -->
                                <input type="hidden" name="id_evento" value="' . $data_evento['id_evento'] . '">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="' . $data_evento['nombre'] . '">
                                </div>
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control" name="fecha" value="' . $data_evento['fecha'] . '">
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
                            <h3 align="center">Registrar Evento</h3><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre" class="text-dark font-weight-bold">Nombre</label>
                                        <input type="text" placeholder="Nombre" name="nombre" id="nombre" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha" class="text-dark font-weight-bold">Fecha</label>
                                        <input type="date" placeholder="Fecha" class="form-control" name="fecha" id="fecha">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="imagen" class="text-dark font-weight-bold">Imagen del Evento</label>
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
            <h3 align="center">Listado de eventos</h3>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tbl">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_eventos = mysqli_query($conexion, "SELECT * FROM eventos");
                                if ($query_eventos) {
                                    $result_eventos = mysqli_num_rows($query_eventos);
                                    if ($result_eventos > 0) {
                                        while ($data_evento = mysqli_fetch_assoc($query_eventos)) {
                                            echo '<tr>
                                                <td>' . $data_evento["id_evento"] . '</td>
                                                <td>' . $data_evento["nombre"] . '</td>
                                                <td>' . $data_evento["fecha"] . "</td>
                                                <td><img style='width:100px; height=100px;' src='" . $data_evento["imagen"] . "'</td>
                                                <td>".'
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteEvento' . $data_evento['id_evento'] . '">
                                                Eliminar
                                                </button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarEvento' . $data_evento['id_evento'] . '">
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
