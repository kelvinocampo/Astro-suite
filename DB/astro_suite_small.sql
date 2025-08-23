-- CREATE DATABASE IF NOT EXISTS `astro_suite` 
--   DEFAULT CHARACTER SET utf8mb4 
--   COLLATE utf8mb4_general_ci;

-- USE `astro_suite`;

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

CREATE TABLE `temas` (
  `id_tema` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(10000) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `pdf` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci AUTO_INCREMENT=18;

INSERT INTO `temas` (`id_tema`, `titulo`, `descripcion`, `imagen`, `pdf`) VALUES
(7, 'astrofísica 1', 'La astronomía es una de las ciencias más antiguas de la humanidad. Su actividad básica es estudiar el cielo y aprender sobre lo que vemos en el universo. La astronomía observacional es una actividad que los observadores aficionados disfrutan como un pasatiempo y fue el primer tipo de astronomía que hicieron los humanos. Hay millones de personas en el mundo que observan las estrellas regularmente desde sus patios traseros o observatorios personales. La mayoría no están necesariamente capacitados en la ciencia, pero simplemente les encanta mirar las estrellas.', 'image/temas/th.jpeg', 'pdf/tema/Chapters1-2.pdf'),
(9, 'observacional 1,2', 'aqui hay un contenido', 'image/temas/45867375d62cddf6ba8edab2327438bb_8-282js06.jpg', 'pdf/tema/Infografía de Red Hood.pdf'),
(10, '¿Qué es la astronomía observacional?', 'La astronomía observacional es una rama de la astronomía que se enfoca en la observación directa de objetos celestes utilizando instrumentos especializados. Los astrónomos observacionales recopilan datos reales sobre la posición, el movimiento, la composición y otros atributos de estrellas, planetas, galaxias y otros objetos en el universo. Estos datos se utilizan para realizar investigaciones, hacer descubrimientos y responder preguntas fundamentales sobre el cosmos. La astronomía observacional abarca diversas áreas de estudio y desempeña un papel crucial en la ampliación de nuestra comprensión del universo.', 'image/temas/9cec527b-05df-45d3-aac9-b74ca68fe0e4.jpeg', 'pdf/tema/'),
(11, 'Óptica de telescopios', 'La óptica de telescopios se refiere al conjunto de componentes y principios ópticos utilizados en la construcción y funcionamiento de telescopios. Los telescopios son instrumentos diseñados para recoger y enfocar la luz de objetos distantes, permitiendo a los astrónomos observar detalles celestes con mayor claridad. Aquí te presento una descripción general de los tipos de telescopios más comunes y sus características:', 'image/temas/WhatsApp Image 2023-11-08 at 3.28.17 PM.jpeg', 'pdf/tema/'),
(12, 'Telescopios Refractores:', '   - También conocidos como telescopios de lentes, utilizan lentes de vidrio para enfocar la luz. Tienen un tubo largo y delgado con una lente objetiva en la parte frontal y una lente ocular en la parte posterior. Son conocidos por su calidad de imagen y nitidez en la observación de objetos brillantes, como la Luna y planetas.  Ejemplo: Telescopio refractor Hubble.', 'image/temas/9eedf9e8-c58a-4967-956e-763824d7bdf1.jpeg', 'pdf/tema/'),
(13, 'Telescopios Reflectores ', '   - Emplean espejos para recolectar y enfocar la luz. Tienen un espejo primario que recoge la luz y un espejo secundario que dirige la luz hacia el ocular. Son adecuados para observar objetos débiles y difusos, como galaxias y nebulosas, debido a su mayor apertura y capacidad de captar más luz.   Ejemplo: Telescopio reflector Newtoniano.', 'image/temas/d54869b3-ea12-477e-bd57-896fd0777668.jpeg', 'pdf/tema/'),
(14, 'Telescopios Catadióptricos', '  - Estos telescopios combinan elementos refractores y reflectores, utilizando tanto lentes como espejos. El diseño más común es el telescopio tipo Schmidt-Cassegrain. Ofrecen una combinación de las ventajas de los telescopios refractores y reflectores, siendo versátiles y compactos.   Ejemplo: Telescopio Schmidt-Cassegrain.  En términos de características generales, los telescopios varían en términos de apertura (diámetro del objetivo), distancia focal, calidad óptica y diseño. La elección del telescopio depende de los objetivos de observación del astrónomo, ya sea la observación planetaria, estelar, de galaxias, de objetos de cielo profundo o de fenómenos específicos.', 'image/temas/d5885624-c9d9-47b0-bfd0-5ec04d6d70bb.jpeg', 'pdf/tema/'),
(15, 'Observación de objetos Astronómicos', 'La observación de objetos astronómicos es el estudio y seguimiento de diferentes cuerpos celestes, como estrellas, planetas, galaxias, nebulosas y cometas. Esta actividad nos permite aprender más sobre el universo y comprender mejor cómo funcionan los fenómenos astronómicos.', 'image/temas/cb050db2-67a2-4cbe-80e2-01c2da68f8bd.jpeg', 'pdf/tema/'),
(16, 'Observación de objetos Astronómicos 2', 'Para observar objetos astronómicos, es importante tener en cuenta algunos aspectos: -Escoge un lugar oscuro: Busca un lugar alejado de las luces de la ciudad para minimizar la contaminación lumínica. Cuanto más oscuro sea el cielo, mejor será la visibilidad de los objetos astronómicos.  Utiliza instrumentos adecuados: Puedes comenzar con binoculares o un telescopio sencillo, dependiendo de tus objetivos y presupuesto. Estos instrumentos te permitirán acercarte a los objetos y apreciar más detalles. Estudia el cielo y su movimiento: Familiarízate con la ubicación de los objetos astronómicos en función de las estaciones del año y la hora del día. Puedes utilizar aplicaciones móviles (STELLARIUM) o mapas estelares para identificar constelaciones y otros objetos.', 'image/temas/8f90fabe-4262-4729-99f6-ef5a02773bbb.jpeg', 'pdf/tema/'),
(17, 'Observación de objetos Astronómicos 3', 'Respecto a los objetos astronómicos más comunes, estos son algunos ejemplos: - Estrellas: Puedes observar estrellas individuales y constelaciones. Algunas opciones conocidas son la Estrella Polar, el Cinturón de Orión o la estrella más brillante en el cielo, Sirio. - Planetas: Los planetas visibles desde la Tierra incluyen a Mercurio, Venus, Marte, Júpiter y Saturno. Estos pueden ser más fácilmente identificables debido a su brillo y movimiento respecto a las estrellas. - Galaxias: Entre las galaxias más conocidas se encuentra la Vía Láctea, ¡nuestra propia galaxia! También es posible observar la galaxia de Andrómeda, la más cercana a la nuestra. - Nebulosas: Ejemplos populares de nebulosas son la Nebulosa de Orión y la Nebulosa del Cangrejo. Estas nubes de gas y polvo resultan fascinantes para su observación. Cada uno de estos objetos astronómicos tiene características únicas, como tamaño, brillo, ubicación y composición. Explorarlos te permitirá maravillarte con la diversidad y la belleza del universo. Recuerda que la paciencia y la práctica son clave en la observación astronómica.', 'image/temas/3892700c-844a-4059-81b5-4a9ca4f04270.jpeg', 'pdf/tema/');

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
