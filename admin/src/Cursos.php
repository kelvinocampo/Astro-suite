<?php
require_once "../conexion.php";
session_start();
if ($_SESSION['active']) {
    if (!empty($_POST)) {
        $alert = "";
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_temp = $_FILES["imagen"]["tmp_name"];
        $ruta_imagen = "image/cursos/" . $imagen_nombre;
        move_uploaded_file($imagen_temp, $ruta_imagen);
        $dificultad = $_POST['dificultad'];
        $test = $_POST['test'];

        if (empty($nombre) || empty($descripcion) ||  empty($dificultad) || empty($test)) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Todos los campos son obligatorios
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } else {
            $query = mysqli_query($conexion, "SELECT * FROM cursos WHERE nombre = '$nombre'");
            $result = mysqli_fetch_array($query);
            if ($result > 0) {
                $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    El Curso ya existe
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            } else {
                $query_insert = mysqli_query($conexion, "INSERT INTO cursos(nombre, descripcion,imagen,dificultad, test) VALUES ('$nombre', '$descripcion','$ruta_imagen', '$dificultad', '$test')");
                if ($query_insert) {
                                        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Curso registrado
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                } else {
                    $error_message = mysqli_error($conexion);
                    $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar el Curso: ' . $error_message . '
                    </div>';
                }
            }
        }
    }
    include_once "includes/header.php";
?>
<?php
  $query_cursos = mysqli_query($conexion, "SELECT * FROM cursos");
if ($query_cursos) {
    while ($data_curso = mysqli_fetch_assoc($query_cursos)) {
        echo '<div class="modal fade" id="deleteCurso' . $data_curso['id_curso'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteCursoLabel' . $data_curso['id_curso'] . '" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCursoLabel' . $data_curso['id_curso'] . '">Eliminar Curso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar este curso?
                    </div>
                    <div class="modal-footer">
                        <form action="includes/modales/eliminar_curso.php" method="post">
                            <input type="hidden" name="id_curso" value="' . $data_curso['id_curso'] . '">
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
$query_cursos = mysqli_query($conexion, "SELECT * FROM cursos");
if ($query_cursos) {
    while ($data_curso = mysqli_fetch_assoc($query_cursos)) {
        echo '<div class="modal fade" id="editarCurso' . $data_curso['id_curso'] . '" tabindex="-1" role="dialog" aria-labelledby="editarCursoLabel' . $data_curso['id_curso'] . '" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarCursoLabel' . $data_curso['id_curso'] . '">Editar Curso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para editar los datos del curso -->
                    <form method="post" action="includes/modales/editar_curso.php" enctype="multipart/form-data">
                    <!-- Campos de edición -->
                    <input type="hidden" name="id_curso" value="' . $data_curso['id_curso'] . '">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="' . $data_curso['nombre'] . '">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" value="' . $data_curso['descripcion'] . '">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen (Obligatorio para editar)</label>
                        <input type="file" class="form-control" name="imagen" id="imagen" src="' . $data_curso['imagen'] .'">
                    </div>
                    <div class="form-group">
                        <label for="dificultad">Dificultad</label>
                        <select class="form-control" name="dificultad" id="dificultad">
                            <option value="facil">Fácil</option>
                            <option value="medio">Medio</option>
                            <option value="dificil">Difícil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="test">Test</label>
                        <input type="text" class="form-control" name="test" value="' . $data_curso['test'] . '">
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
                            <h3 align="center">Registrar Curso</h3><br>
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
                                        <label for="imagen" class="text-dark font-weight-bold">Imagen del Curso</label>
                                        <input type="file" class="form-control" name="imagen" id="imagen">
                                    </div>
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dificultad" class="text-dark font-weight-bold">Dificultad</label>
                                        <select class="form-control" name="dificultad" id="dificultad">
                                            <option value="facil">Fácil</option>
                                            <option value="medio">Medio</option>
                                            <option value="dificil">Difícil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="test" class="text-dark font-weight-bold">Test</label>
                                        <input type="text" placeholder="Test" class="form-control" name="test" id="test">
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
            <h3 align="center">Listado de cursos</h3>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tbl">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Imagen</th>
                                    <th>Dificultad</th>
                                    <th>Test</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_cursos = mysqli_query($conexion, "SELECT * FROM cursos");

                                if ($query_cursos) {
                                    $result_cursos = mysqli_num_rows($query_cursos);

                                    if ($result_cursos > 0) {
                                        while ($data_curso = mysqli_fetch_assoc($query_cursos)) {
                                            echo '<tr>
                                                <td>' . $data_curso["id_curso"] . '</td>
                                                <td>' . $data_curso["nombre"] . '</td>
                                                <td>' . $data_curso["descripcion"] . "</td>
                                                <td><img style='width:100px; height=100px;' src='". $data_curso["imagen"]  ."'></td>
                                                <td>" . $data_curso["dificultad"] . '</td>
                                                <td>' . $data_curso["test"] . '</td>
                                                <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCurso' . $data_curso['id_curso'] . '">
                                                Eliminar
                                                </button>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editarCurso' . $data_curso['id_curso'] . '">
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