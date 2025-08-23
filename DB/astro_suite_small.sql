CREATE DATABASE IF NOT EXISTS `astro_suite` 
  DEFAULT CHARACTER SET utf8mb4 
  COLLATE utf8mb4_general_ci;

USE `astro_suite`;

CREATE TABLE `administradores` (
  `doc_administrador` varchar(15) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha_nac` date NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contraseña` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`doc_administrador`),
  UNIQUE KEY `doc_administrador_UNIQUE` (`doc_administrador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `administradores` (`doc_administrador`, `nombre`, `fecha_nac`, `correo`, `contraseña`) VALUES
('1094', 'Kevin Esneider Ocampo Osorio', '2007-06-25', 'Kevinocampooso@gmail.com', '123');

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `dificultad` varchar(20) DEFAULT NULL,
  `test` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_curso`),
  UNIQUE KEY `id_cursos_UNIQUE` (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=11;

INSERT INTO `cursos` (`id_curso`, `nombre`, `descripcion`, `imagen`, `dificultad`, `test`) VALUES
(8, 'Astrofísica Básica ', 'El curso de introducción a la astrofísica proporciona una visión general...', 'image/cursos/R (9).jpeg', 'facil', 'https://es.educaplay.com/recursos-educativos/'),
(10, 'Curso de Astronomía Observacional', 'Este curso de Astronomía Observacional tiene como objetivo...', 'image/cursos/WhatsApp Image 2023-11-08 at 3.13.11 PM.jpeg', 'medio', 'https://quizlet.com/co/700034517/objetos-mess');

CREATE TABLE `cursos_temas` (
  `id_curso_tema` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  PRIMARY KEY (`id_curso_tema`),
  KEY `fk_curso_has_temas_temas1_idx` (`id_tema`),
  KEY `fk_curso_has_temas_curso1_idx` (`id_curso`),
  CONSTRAINT `fk_curso_has_temas_curso1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  CONSTRAINT `fk_curso_has_temas_temas1` FOREIGN KEY (`id_tema`) REFERENCES `temas` (`id_tema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=13;

INSERT INTO `cursos_temas` (`id_curso`, `id_tema`, `id_curso_tema`) VALUES
(8, 7, 1),
(10, 10, 5),
(10, 11, 6),
(10, 12, 7),
(10, 13, 8),
(10, 14, 9),
(10, 15, 10),
(10, 16, 11),
(10, 17, 12);

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=4;

INSERT INTO `eventos` (`id_evento`, `nombre`, `fecha`, `imagen`) VALUES
(2, 'eclipse solar ', '2023-10-14', 'image/eventos/th.jpeg'),
(3, 'Eclipse lunar penumbral ', '2024-03-25', 'image/eventos/R (10).jpeg');

CREATE TABLE `novedades` (
  `id_novedad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(400) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_novedad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=4;

INSERT INTO `novedades` (`id_novedad`, `nombre`, `descripcion`, `link`, `imagen`) VALUES
(1, '18 descubrimientos astronómicos que nos han s', 'Este artículo presenta...', 'https://www.nationalgeographic.com.es/ciencia/18-descubrimientos...', 'image/novedad/descubren-como-se-alimenta-un-agujero-negro_d7ffce83_1280x724.jpg'),
(2, 'Nuevos exoplanetas', 'Descubren 10 exoplanetas potencialmente habitables...', 'https://www.lasexta.com/noticias/ciencia-tecnologia/descubren-59-exoplanetas...', 'image/novedad/recreacion-planeta-tamano-similar-tierra.jpeg');

CREATE TABLE `temas` (
  `id_tema` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(10000) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `pdf` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=18;

-- (se mantienen los inserts de temas, resumidos aquí por espacio)

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contraseña` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuarios_UNIQUE` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=7;

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `fecha_nac`, `correo`, `contraseña`) VALUES
(4, 'Carlos Andrés López Pérez', '2005-08-27', 'reizorlopez1781@gmail.com', '12345'),
(6, 'juan pablo', '2023-11-01', 'pablito@gmail.com', '1234');

CREATE TABLE `usuarios_cursos` (
  `id_usuario_curso` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_curso`),
  KEY `fk_usuarios_has_curso_curso1_idx` (`id_curso`),
  KEY `fk_usuarios_has_curso_usuarios_idx` (`id_usuario`),
  CONSTRAINT `fk_usuarios_has_curso_curso1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  CONSTRAINT `fk_usuarios_has_curso_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=4;

INSERT INTO `usuarios_cursos` (`id_usuario`, `id_curso`, `id_usuario_curso`) VALUES
(4, 8, 1),
(4, 10, 3);
