<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/informacion.css">
</head>
<body>
    <header>
       <div class="header-title"> 
        <h1>Astro Suite</h1>
        <p>Descubre los misterios del cosmos con nuestro curso de astronomía.</p>
        </div>
        <nav>
            <ul>
            <li><a href="inicio.php">Inicio</a></li>
                <li><a href="cursos.php">Cursos</a></li>
                <?php
                    session_start();
                    require_once "conexion.php";

                    if (isset($_SESSION['active']) && isset($_SESSION['nombre'])) {
                        $nombre = $_SESSION['nombre'];

                        echo '<div class="sidebar">
                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="image">
                                    <a href="perfil.php">
                                        <i class="fas fa-user-circle fa-2x text-info"></i>
                                    </a>
                                </div>
                                <div class="info">
                                    <a href="perfil.php" class="d-block">' . $nombre . '</a>
                                </div>
                            </div>
                        </div>';
                    } else {
                        echo '<div class="sidebar">
                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="image">
                                    <a href="perfil.php">
                                        <i class="fas fa-user-circle fa-2x text-info"></i>
                                    </a>
                                </div>
                            </div>
                        </div>';
                    }
                ?>
                </ul>
        </nav>
    </header>
    <div class="background-container">
    <section class="features">
    <div class="feature">
        <img src="image/curso_informacion.png">
        <h2>Clases con Expertos</h2>
        <p>Aprende de astrónomos expertos en un entorno interactivo y educativo.</p>
    </div>
    <div class="feature">
        <img src="image\Logo_de_Astro_Suite.jpg">
        <h1>ASTRO SUITE</h1>
    </div>
    <div class="feature">
        <img src="image/test_informacion.jpg">
        <h2>Prueba tus límites con un test.</h2>
        <p> Pon abrueba todo lo aprendido en nuestros cursos con un testpara mejorar tu comprensión del universo.</p>
    </div>
    <div class="final-content">
        <hr class="final-divider">
        <i class="fas fa-star final-star"></i>
    </div>
</section>
</div>
<div class="feature">
        <h1>INTEGRANTES</h1>
    </div>
    <div class="container">
        <div class="icon">
            <div class="imgBx active" style="--i:2;" data-id="content1">
                <img src="image/Carlos.jpeg" alt="">
            </div>
            <div class="imgBx" style="--i:4;" data-id="content4">
                <img src="image/kevin.jpeg" alt="">
            </div>
            <div class="imgBx" style="--i:8;" data-id="content6">
                <img src="image/pablo.jpeg" alt="">
            </div>

        </div>
        <div class="content">
            <div class="contentBx active" id="content1">
                <div class="card">
                    <div class="imgBx">
                        <img src="image/Carlos.jpeg" alt="">
                    </div>
                    <div class="textBx">
                        <h2>Carlos Lopez <br><span>Programador lider</span></h2>
                        <ul class="sci">
                            <li><a href="https://www.instagram.com/carlosandreslopez1781/"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="https://wa.me/3135003380"><i class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a href="https://github.com/reizor1781"><i class="fa-brands fa-github"></i></a></li>
                            <li><a href="https://www.facebook.com/profile.php?id=100009525728261"><i class="fa-brands fa-facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="contentBx" id="content4">
                <div class="card">
                    <div class="imgBx">
                        <img src="image/kevin.jpeg" alt="">
                    </div>
                    <div class="textBx">
                        <h2>Kevin Osorio<br><span>programador </span></h2>
                        <ul class="sci">
                            <li><a href="https://instagram.com/kevin_.ocampo?utm_source=qr&igshid=YzU1NGVlODEzOA=="><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="https://wa.me/3059218807"><i class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a href="https://github.com/kelvinocampo"><i class="fa-brands fa-github"></i></a></li>
                            <li><a href="https://www.facebook.com/kevinesneider.ocampoosorio?mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="contentBx" id="content6">
                <div class="card">
                    <div class="imgBx">
                        <img src="image/pablo.jpeg" alt="">
                    </div>
                    <div class="textBx">
                        <h2>Pablo londoño<br><span>Redaccion</span></h2>
                        <ul class="sci">
                            <li><a href="https://instagram.com/pabloo_gomez_7?igshid=OGQ5ZDc2ODk2ZA=="><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="https://wa.me/3244512026"><i class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a href="https://t.me/Pablogomez21"><i class="fa-brands fa-telegram"></i></a></li>
                            <li><a href="https://www.facebook.com/juanpablolondonogomezj?mibextid=ZbWKwL"><i class="fa-brands fa-facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>



        </div>
    </div>


    <script>
        let imgBx = document.querySelectorAll('.imgBx')
        let contentBx = document.querySelectorAll('.contentBx')

        for(let i=0; i < imgBx.length; i++){
            imgBx[i].addEventListener('mouseover', function(){
                for(let i=0; i<contentBx.length; i++){
                    contentBx[i].className = 'contentBx';
                }
                document.getElementById(this.dataset.id).className = 'contentBx active';


                for(let i=0; i<imgBx.length; i++){
                    imgBx[i].className = 'imgBx';
                }
                this.className = 'imgBx active';
            })
        }
    </script>
    <section class="cta">
        <h2>¡Únete a nuestros cursos de astronomía y comienza tu viaje estelar hoy mismo!</h2>
        <a href="registro.php" class="btn">Regístrate</a>
    </section>
    <div class="container-vm">
        <div class="vision"><h1>VISION</h1><h2>En el futuro esta página web académica de astronomía brindará a los estudiantes una experiencia interactiva e innovadora.
             Contará con un diseño atractivo, permitiendo a los estudiantes acceder al contenido desde cualquier dispositivo. Contendrá imágenes y videos de alta calidad para ilustrar los conceptos astronómicos,
             incluyendo videos en 3D para una experiencia inmersiva. Ofrecerá una amplia gama de recursos educativos, adaptados a diferentes niveles educativos, y facilitará la interacción entre estudiantes y expertos en astronomía.
             Será una fuente confiable de información actualizada y un espacio de aprendizaje colaborativo.</h2></div>
        <div class="mision"><h1>MISION</h1><h2>Proponemos ayudar a estudiantes y jóvenes, para facilitarles información con respecto a este tema y
             que se interesen por aprender sobre astronomía, astrofísica y astronáutica.
            También ofrecemos cursos y clases sobre esta área.</h2></div>
    </div>
    <footer class="wrapper">
        <p>&copy; 2023 Astrosuite</p>
        <div class="icons facebook">
            <a href="https://www.facebook.com/profile.php?id=61550944603481&mibextid=ZbWKwL" target="_blank">
            <div class="tooltip">
                Facebook
            </div>
            <span> <i class="fab fa-facebook"></i></span>
        </a>
        </div>
       

        <div class="icons instagram">
            <a href="https://instagram.com/astro_suite_page?igshid=NzZlODBkYWE4Ng==" target="_blank">
            <div class="tooltip">
                Instagram
            </div>
            <span> <i class="fab fa-instagram"></i></span>
        </a>
        </div>

        <div class="icons twitter">
            <a href="https://twitter.com/AstroSuite21?t=CZX73CNgM4YydsE4w_XTsg&s=09" target="_blank">
            <div class="tooltip">
                Twitter
            </div>
            <span> <i class="fab fa-twitter"></i></span>
        </a>
        </div>

        <div class="icons youtube">
            <a href="https://cutt.ly/BRogLTd" target="_blank">
            <div class="tooltip">
                Youtube
            </div>
            <span> <i class="fab fa-youtube"></i></span>
        </a>
        </div>
    </footer>
</body>
</html>
