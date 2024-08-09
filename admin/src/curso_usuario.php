<?php
require_once "../conexion.php";
session_start();

if ($_SESSION['active']) {
    if (!empty($_POST)) {
        $alert = "";
        $correo = $_POST['correo'];
        $id_curso = $_POST['curso'];
        $querycorreo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");
        $row=mysqli_fetch_assoc($querycorreo);
        $id_user=$row["id_usuario"];

        if (empty($id_user) || empty($id_curso)) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Todos los campos son obligatorios
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } else {
            $query = mysqli_query($conexion, "SELECT * FROM usuarios_cursos WHERE id_curso = '$id_curso' and id_curso='$id_curso'");
            $result = mysqli_fetch_array($query);
            if ($result > 0) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    la inscripcion ya existe
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $query_insert = mysqli_query($conexion, "INSERT INTO usuarios_cursos(id_curso,id_usuario) VALUES ('$id_curso', '$id_user')");

                if ($query_insert) {
                    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        inscripcion registrada
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                } else {
                    $error_message = mysqli_error($conexion);
                    $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar la union: ' . $error_message . '
                    </div>';
                }
            }
        }
    }

    include_once "includes/header.php";
?>
<!-- MODAL ELIMINAR -->
<?php
    $query_temas = mysqli_query($conexion, "SELECT usuarios_cursos.id_usuario_curso as id ,usuarios.id_usuario, cursos.nombre as nombre ,usuarios.correo as correo from usuarios_cursos
    join cursos on usuarios_cursos.id_curso=cursos.id_curso
    join usuarios on usuarios_cursos.id_usuario=usuarios.id_usuario");                   
    if ($query_temas) {
        while ($data_tema = mysqli_fetch_assoc($query_temas)) {
            echo '<div class="modal fade" id="deleteusuario_curso' . $data_tema['id'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteusuario_cursoLabel' . $data_tema['id'] . '" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteusuario_cursoLabel' . $data_tema['id'] . '">Eliminar inscripcion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar esta union?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <form action="includes/modales/eliminar_usuario_curso.php" method="post">
                                <input type="hidden" name="id" value="' . $data_tema['id'] . '">
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
    $query_temas = mysqli_query($conexion, "SELECT usuarios_cursos.id_usuario_curso as id ,usuarios.id_usuario, cursos.nombre as nombre ,usuarios.correo as correo from usuarios_cursos
    join cursos on usuarios_cursos.id_curso=cursos.id_curso
    join usuarios on usuarios_cursos.id_usuario=usuarios.id_usuario");
    if ($query_temas) {
        while ($data_tema = mysqli_fetch_assoc($query_temas)) {
            $correo =$data_tema["correo"];
            $curso=$data_tema["nombre"];
            echo '<div class="modal fade" id="editarusuario_curso' . $data_tema['id'] . '" tabindex="-1" role="dialog" aria-labelledby="editarusuario_cursoLabel' . $data_tema['id'] . '" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarusuario_cursoLabel' . $data_tema['id'] . '">Editar enlace</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario para editar los datos del enlace -->
                            <form method="post" action="includes/modales/editar_usuario_curso.php" enctype="multipart/form-data">
                                <!-- Campos de edición -->
                                <input type="hidden" name="id" value="' . $data_tema['id'] . '">
                                    <div class="form-group">
                                        <label for="titulo">curso: </label>
                                        <input type="text" readonly class="form-control" name="curso" value="' . $curso . '">
                                    </div>
                                <div class="form-group">
                                    
                                <label for="correo">correo usuario: </label>
                                <input type="text" class="form-control" name="correo" value="' . $correo . '">
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
                            <h3 align="center">Inscribir un usuario a un curso</h3><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="curso">curso:</label>
                                    <select name="curso"  class="form-control" id="curso">
                                        <option value="">Seleccione un curso</option>
                                            <?php
                                            $consultaCursos = "SELECT * FROM cursos";
                                            $resultCursos = $conexion->query($consultaCursos);
                                            if ($resultCursos->num_rows > 0) {
                                                while ($row = $resultCursos->fetch_assoc()) {
                                                    echo "<option value='" . $row['id_curso'] . "'>" . $row['nombre'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tema">correo del usuario:</label>
                                        <input type="text" placeholder="correo del usuario" class="form-control" name="correo">
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
            <h3 align="center">Usuarios inscritos</h3>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tbl">
                            <thead>
                                <tr>
                                    <th>curso</th>
                                    <th>usuario</th>
                                    <th>acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_temas = mysqli_query($conexion, "SELECT usuarios_cursos.id_usuario_curso as id ,usuarios.id_usuario, cursos.nombre as nombre ,usuarios.correo as correo from usuarios_cursos
                                join cursos on usuarios_cursos.id_curso=cursos.id_curso
                                join usuarios on usuarios_cursos.id_usuario=usuarios.id_usuario");
                                if ($query_temas) {
                                    $result_temas = mysqli_num_rows($query_temas);
                                    if ($result_temas > 0) {
                                        while ($data_tema = mysqli_fetch_assoc($query_temas)) {
                                            echo '<tr>
                                                <td>' . $data_tema["nombre"] . '</td>
                                                <td>' . $data_tema["correo"] . '</td>
                                                <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteusuario_curso' . $data_tema['id'] . '">
                                                Eliminar
                                                </button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarusuario_curso' . $data_tema['id'] . '">
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
