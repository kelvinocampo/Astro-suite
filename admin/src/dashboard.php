<?php
session_start();
include_once "includes/header.php";
include "../conexion.php";
$query1 = mysqli_query($conexion, "SELECT COUNT(id_usuario) AS total FROM usuarios");
$totalusuarios = mysqli_fetch_assoc($query1);
$query2 = mysqli_query($conexion, "SELECT COUNT(id_evento) AS total FROM eventos");
$totalEventos = mysqli_fetch_assoc($query2);
$query3 = mysqli_query($conexion, "SELECT COUNT(id_tema) AS total FROM temas");
$totalTemas = mysqli_fetch_assoc($query3);
$query4 = mysqli_query($conexion, "SELECT COUNT(id_curso) AS total FROM cursos");
$totalCursos = mysqli_fetch_assoc($query4);
$query5 = mysqli_query($conexion, "SELECT COUNT(id_novedad) AS total FROM novedades");
$totalNovedades = mysqli_fetch_assoc($query5);
$query6 = mysqli_query($conexion, "SELECT COUNT(id_curso_tema) AS total FROM cursos_temas");
$totalcurso_temas = mysqli_fetch_assoc($query6);
$query7 = mysqli_query($conexion, "SELECT COUNT(id_usuario_curso) AS total FROM usuarios_cursos");
$totalusuarios_curso = mysqli_fetch_assoc($query7);
?>
<div class="card">
    <div class="card-header text-center">
        Admin
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalusuarios['total']; ?></h3>

                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-user-graduate"></i>
                    </div>
                    <a href="usuarios.php" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $totalCursos['total']; ?></h3>

                        <p>Cursos</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    </div>
                    <a href="cursos.php" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $totalTemas['total']; ?></h3>

                        <p>temas</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-book"></i>
                    </div>
                    <a href="Temas.php" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo $totalNovedades['total']; ?></h3>

                        <p>Novedades</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fa fa-newspaper"></i>
                    </div>
                    <a href="novedades.php" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3><?php echo $totalEventos['total']; ?></h3>

                        <p>Eventos</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fa fa-calendar"></i>
                    </div>
                    <a href="eventos.php" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?php echo $totalcurso_temas['total']; ?></h3>

                        <p>Temas de cursos</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-toolbox"></i>
                    </div>
                    <a href="curso_tema.php" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3><?php echo $totalusuarios_curso['total']; ?></h3>

                        <p>Usuarios inscritos</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-toolbox"></i>
                    </div>
                    <a href="curso_usuario.php" class="small-box-footer">Mas info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>

<script src="../assets/js/dashboard.js"></script>