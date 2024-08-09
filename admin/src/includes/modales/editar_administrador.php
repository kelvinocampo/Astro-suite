<?php
require_once "../../../conexion.php";

if ($_POST) {
    $doc_administrador = $_POST['doc_administrador'];
    $nombre = $_POST['nombre'];
    $fecha_nac = $_POST['fecha_nac'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $query = "UPDATE administradores SET nombre = '$nombre', fecha_nac = '$fecha_nac', correo = '$correo', contraseña = '$contraseña' WHERE doc_administrador = '$doc_administrador'";

    if (mysqli_query($conexion, $query)) {
        header("Location: ../../config.php");
    } else {
        echo "Error al actualizar el administrador: " . mysqli_error($conexion);
    }
}

include_once "includes/header.php";
?>

<div class="card">
    <div class="card-body">
        <h3 align="center">Editar Administrador</h3><br>
        <form method="post" action="">
            <?php
            $doc_administrador = $_GET['doc_administrador']; 
            $query = mysqli_query($conexion, "SELECT * FROM administradores WHERE doc_administrador = '$doc_administrador'");
            $data = mysqli_fetch_assoc($query);
            ?>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $data['nombre']; ?>">
            </div>
            <div class="form-group">
                <label for="doc_administrador">Documento del Administrador</label>
                <input type="text" class="form-control" name="doc_administrador" value="<?php echo $data['doc_administrador']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="fecha_nac">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nac" value="<?php echo $data['fecha_nac']; ?>">
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="text" class="form-control" name="correo" value="<?php echo $data['correo']; ?>">
            </div>
            <div class="form-group">
                <label for="correo">Contraseña</label>
                <input type="text" class="form-control" name="contraseña" value="<?php echo $data['contraseña']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Guardar Cambios" class="btn btn-primary">
                <a href="administradores.php" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>