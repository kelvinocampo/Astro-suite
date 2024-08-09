<?php
session_start();
if (!empty($_SESSION['active'])) {
    header('location: src/dashboard.php');
} else {
    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['doc_administrador']) || empty($_POST['contraseña'])) {
            $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Ingrese usuario y contraseña
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        } else {
            require_once "conexion.php";
            if (!$conexion) {
                die("Error en la conexión: " . mysqli_connect_error());
            }
            $doc_administrador = mysqli_real_escape_string($conexion, $_POST['doc_administrador']);
            $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);
            $query = mysqli_query($conexion, "SELECT * FROM administradores WHERE doc_administrador = '$doc_administrador' AND contraseña = '$contraseña'");
            if (!$query) {
                die("Error en la consulta: " . mysqli_error($conexion));
            }
            $resultado = mysqli_num_rows($query);
            if ($resultado > 0) {
                $dato = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['doc_administrador'] = $dato['doc_adminstrador'];
                $_SESSION['nombre'] = $dato['nombre'];
                $_SESSION['correo'] = $dato['correo'];
                header('Location: src/dashboard.php');
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Contraseña incorrecta
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                session_destroy();
            }
            mysqli_close($conexion);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admistracion
                <br>
            </b>ASTRO SUITE</a>
        </div>

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingresa tu usuario y contraseña</p>

                <form action="" method="post" autocomplete="off">
                    <?php echo (isset($alert)) ? $alert : '' ; ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="doc_administrador" placeholder="Documento">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="contraseña" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>

            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>