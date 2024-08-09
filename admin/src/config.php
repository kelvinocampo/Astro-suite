<?php
require_once "../conexion.php";
session_start();

if ($_SESSION['active']) {
    if (!empty($_POST)) {
        $alert = "";
        $doc_administrador = $_POST['doc_administrador'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $fecha_nac = $_POST['fecha_nac'];
        $contrasena = $_POST['contrasena'];

        if (empty($doc_administrador) || empty($nombre) || empty($correo) || empty($fecha_nac) || empty($contrasena)) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Todos los campos son obligatorios
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } else {
            $query = mysqli_query($conexion, "SELECT * FROM administradores WHERE doc_administrador = '$doc_administrador'");
            if (mysqli_num_rows($query) > 0) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    El Administrador ya existe
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $query_insert = mysqli_query($conexion, "INSERT INTO administradores (doc_administrador, nombre, correo, fecha_nac, contraseña) VALUES ('$doc_administrador', '$nombre', '$correo', '$fecha_nac', '$contrasena')");
                if ($query_insert) {
                    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Administrador registrado
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                } else {
                    $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar el Administrador
                    </div>';
                }
            }
        }
    }
    include_once "includes/header.php";
?>

<!-- Modales de Eliminar Administrador -->
<?php
$query_admins = mysqli_query($conexion, "SELECT * FROM administradores");

if ($query_admins) {
    while ($data_admin = mysqli_fetch_assoc($query_admins)) {
        echo '<div class="modal fade" id="deleteAdministrador' . $data_admin['doc_administrador'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteAdministradorLabel' . $data_admin['doc_administrador'] . '" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAdministradorLabel' . $data_admin['doc_administrador'] . '">Eliminar Administrador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar a este administrador?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="includes/modales/eliminar_administrador.php" method="post">
                        <input type="hidden" name="doc_administrador" value="' . $data_admin['doc_administrador'] . '">
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

<!-- Modales de Editar Administrador -->
<?php
$query_admins = mysqli_query($conexion, "SELECT * FROM administradores");

if ($query_admins) {
    while ($data_admin = mysqli_fetch_assoc($query_admins)) {
        echo '<div class="modal fade" id="editarAdministrador' . $data_admin['doc_administrador'] . '" tabindex="-1" role="dialog" aria-labelledby="editarAdministradorLabel' . $data_admin['doc_administrador'] . '" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarAdministradorLabel' . $data_admin['doc_administrador'] . '">Editar Administrador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario para editar los datos del administrador -->
                        <form method="post" action="includes/modales/editar_administrador.php">
                            <!-- Campos de edición -->
                            <input type="hidden" name="doc_administrador" value="' . $data_admin['doc_administrador'] . '">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" value="' . $data_admin['nombre'] . '">
                            </div>
                            <div class="form-group">
                                <label for="fecha_nac">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="fecha_nac" value="' . $data_admin['fecha_nac'] . '">
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="text" class="form-control" name="correo" value="' . $data_admin['correo'] . '">
                            </div>
                            <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="text" class="form-control" name="contraseña" value="' . $data_admin['contraseña'] . '">
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
<!-- Termina la sección de modales -->

<div class="card shadow-lg">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" autocomplete="off" id="formulario" enctype="multipart/form-data">
                            <?php echo isset($alert) ? $alert : ''; ?>
                            <h3 align="center">Registrar Administrador</h3><br>
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="doc_administrador" class=" text-dark font-weight-bold">Documento del Administrador</label>
                                    <input type="text" placeholder="Documento del Administrador" class="form-control" name="doc_administrador" id="doc_administrador">
                                </div>
                            </div>
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
                                        <label for="fecha_nac" class=" text-dark font-weight-bold">Fecha de nacimiento</label>
                                        <input type="date" placeholder="Fecha de nacimiento" class="form-control" name="fecha_nac" id="fecha_nac">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contrasena" class=" text-dark font-weight-bold">Contraseña</label>
                                        <input type="password" placeholder="Contraseña" class="form-control" name="contrasena" id="contrasena">
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
            <h3 align="center">Listado de administradores</h3>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tbl">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Administrador</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_admins = mysqli_query($conexion, "SELECT * FROM administradores");

                                if ($query_admins) {
                                    $result_admins = mysqli_num_rows($query_admins);

                                    if ($result_admins > 0) {
                                        while ($data_admin = mysqli_fetch_assoc($query_admins)) {
                                            echo '<tr>
                                                <td>' . $data_admin["doc_administrador"] . '</td>
                                                <td>' . $data_admin["nombre"] . '</td>
                                                <td>' . $data_admin["fecha_nac"] . '</td>
                                                <td>' . $data_admin["correo"] . '</td>
                                                <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAdministrador' . $data_admin['doc_administrador'] . '">
                                                Eliminar
                                                </button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarAdministrador' . $data_admin['doc_administrador'] . '">
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