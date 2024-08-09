<?php
require_once "../conexion.php";
session_start();
if ($_SESSION['active']) {
    if (!empty($_POST)) {
        $alert = "";
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $fecha_nac = $_POST['fecha_nac'];
        $contraseña = $_POST['contraseña'];

        if (empty($nombre) || empty($correo) || empty($fecha_nac) || empty($contraseña)) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Todos los campos son obligatorios
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } else {
            $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");
            $result = mysqli_fetch_array($query);
            if ($result > 0) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    El Usuario ya existe
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $query_insert = mysqli_query($conexion, "INSERT INTO usuarios (nombre, fecha_nac, correo, contraseña) VALUES ('$nombre', '$fecha_nac', '$correo', '$contraseña')");
                if ($query_insert) {
                    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Usuario registrado
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                } else {
                    $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar el Usuario
                    </div>';
                }
            }
        }
    }
    include_once "includes/header.php";
?>

<!-- Modales de Eliminar Usuario -->
<?php
$query_us = mysqli_query($conexion, "SELECT * FROM usuarios");

if ($query_us) {
    while ($data_us = mysqli_fetch_assoc($query_us)) {
        echo '<div class="modal fade" id="deleteUsuario' . $data_us['id_usuario'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteUsuarioLabel' . $data_us['id_usuario'] . '" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUsuarioLabel' . $data_us['id_usuario'] . '">Eliminar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar a este usuario?
                    </div>
                    <div class="modal-footer">
                        <form action="includes/modales/eliminar_usuario.php" method="post">
                        <input type="hidden" name="id_usuario" value="' . $data_us['id_usuario'] . '">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>';
    }
}
?>
<?php
$query_us = mysqli_query($conexion, "SELECT * FROM usuarios");

if ($query_us) {
    while ($data_us = mysqli_fetch_assoc($query_us)) {
        echo '<div class="modal fade" id="editarUsuario' . $data_us['id_usuario'] . '" tabindex="-1" role="dialog" aria-labelledby="editarUsuarioLabel' . $data_us['id_usuario'] . '" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarUsuarioLabel' . $data_us['id_usuario'] . '">Editar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario para editar los datos del usuario -->
                        <form method="post" action="includes/modales/editar_usuario.php">
                            <!-- Campos de edición -->
                            <input type="hidden" name="id_usuario" value="' . $data_us['id_usuario'] . '">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="' . $data_us['nombre'] . '">
                            </div>
                            <div class="form-group">
                                <label for="fecha_nac">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="fecha_nac" value="' . $data_us['fecha_nac'] . '">
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="text" class="form-control" name="correo" value="' . $data_us['correo'] . '">
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
                            <h3 align="center">Registrar Usuario</h3><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre" class=" text-dark font-weight-bold">Nombre</label>
                                        <input type="text" placeholder="Nombre" name="nombre" id="nombre" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="correo" class=" text-dark font-weight-bold">Correo</label>
                                        <input type="text" placeholder="Correo" class="form-control" name="correo" id="correo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha_nac" class=" text-dark font-weight-bold">fecha de nacimiento</label>
                                        <input type="date" placeholder="Fecha de nacimiento" class="form-control" name="fecha_nac" id="fecha_nac">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contraseña" class=" text-dark font-weight-bold">Contraseña</label>
                                        <input type="password" placeholder="Contraseña" class="form-control" name="contraseña" id="contraseña">
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
            <h3 align="center">Listado de usuarios</h3>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tbl">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_us = mysqli_query($conexion, "SELECT * FROM usuarios");

                                if ($query_us) {
                                    $result_us = mysqli_num_rows($query_us);

                                    if ($result_us > 0) {
                                        while ($data_us = mysqli_fetch_assoc($query_us)) {
                                            echo '<tr>
                                                <td>' . $data_us["id_usuario"] . '</td>
                                                <td>' . $data_us["nombre"] . '</td>
                                                <td>' . $data_us["fecha_nac"] . '</td>
                                                <td>' . $data_us["correo"] . '</td>
                                                <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUsuario' . $data_us['id_usuario'] . '">
                                                Eliminar
                                                </button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarUsuario' . $data_us['id_usuario'] . '">
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
