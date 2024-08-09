<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Curso</title>
    <link rel="stylesheet" href="css/crearcurso.css">
</head>
<body>
    <h1>Formulario de Curso</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del Curso:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="descripcion">Descripción del Curso:</label>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br>

        <label for="complemento_contenido">foto de la descripcion:</label>
        <input type="file" id="complemento_contenido" name="complemento_contenido"><br>

        <label for="dificultad">Dificultad:</label>
        <select id="dificultad" name="dificultad" >
            <option value="Facil">Fácil</option>
            <option value="Intermedio">Intermedio</option>
            <option value="Dificil">Difícil</option>
        </select><br>

        <h2>Temas y Complementos:</h2>
        <ol>
            <li>
                <label for="tema1">Tema 1:</label>
                <input type="text" id="tema1" name="tema1" required>
                <label for="complemento1">Complemento:</label>
                <input type="file" id="complemento1" name="complemento1" required>
            </li>
            <li>
                <label for="tema2">Tema 2:</label>
                <input type="text" id="tema2" name="tema2" >
                <label for="complemento2">Complemento:</label>
                <input type="file" id="complemento2" name="complemento2" >
            </li>
            <li>
                <label for="tema3">Tema 3:</label>
                <input type="text" id="tema3" name="tema3" >
                <label for="complemento3">Complemento:</label>
                <input type="file" id="complemento3" name="complemento3" >
            </li>
            <li>
                <label for="tema4">Tema 4:</label>
                <input type="text" id="tema4" name="tema4" >
                <label for="complemento4">Complemento:</label>
                <input type="file" id="complemento4" name="complemento4" >
            </li>
            <li>
                <label for="tema5">Tema 5:</label>
                <input type="text" id="tema5" name="tema5" >
                <label for="complemento5">Complemento:</label>
                <input type="file" id="complemento5" name="complemento5" >
            </li>
        </ol>

        <input type="submit" value="Enviar">
    </form>

    <div>
        <?php
            // Establece la conexión a la base de datos (reemplaza los valores con los tuyos)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "astro_suite";

            $conn = new mysqli($servername, $username, $password, $database);

            // Verifica la conexión
            if ($conn->connect_error) 
            {
                die("Error de conexión: " . $conn->connect_error);
            }
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $dificultad = $_POST["dificultad"];            
            
            $complemento_contenido_name = $_FILES["complemento_contenido"]["name"];
            $complemento_contenido_tmp = $_FILES["complemento_contenido"]["tmp_name"];
            $complemento_contenido = "imagecursos/" . $complemento_contenido_name;
            move_uploaded_file($complemento_contenido_tmp, $complemento_contenido);
            
            $tema1 = $_POST["tema1"];

            $complemento1_name = $_FILES["complemento1"]["name"];
            $complemento1_tmp = $_FILES["complemento1"]["tmp_name"];
            $complemento1 = "imagecursos/" . $complemento1_name;
            move_uploaded_file($complemento1_tmp, $complemento1);

            $tema2 = $_POST["tema2"];

            $complemento2_name = $_FILES["complemento2"]["name"];
            $complemento2_tmp = $_FILES["complemento2"]["tmp_name"];
            $complemento2 = "imagecursos/" . $complemento2_name;
            move_uploaded_file($complemento2_tmp, $complemento2);
            
            $tema3 = $_POST["tema3"];

            $complemento3_name = $_FILES["complemento3"]["name"];
            $complemento3_tmp = $_FILES["complemento3"]["tmp_name"];
            $complemento3 = "imagecursos/" . $complemento3_name;
            move_uploaded_file($complemento3_tmp, $complemento3);

            $tema4 = $_POST["tema4"];

            $complemento4_name = $_FILES["complemento4"]["name"];
            $complemento4_tmp = $_FILES["complemento4"]["tmp_name"];
            $complemento4 = "imagecursos/" . $complemento4_name;
            move_uploaded_file($complemento4_tmp, $complemento4);

            $tema5 = $_POST["tema5"];

            $complemento5_name = $_FILES["complemento5"]["name"];
            $complemento5_tmp = $_FILES["complemento5"]["tmp_name"];
            $complemento5 = "imagecursos/" . $complemento5_name;
            move_uploaded_file($complemento5_tmp, $complemento5);


            // Consulta SQL para insertar el nuevo curso en la base de datos
            $sql = "INSERT INTO cursos (nombre, descripcion,complemento_contenido, dificultad, tema1, complemento1, tema2, complemento2, tema3, complemento3, tema4, complemento4, tema5, complemento5) 
                    VALUES ('$nombre', '$descripcion','$complemento_contenido' ,'$dificultad', '$tema1', '$complemento1', '$tema2', '$complemento2', '$tema3', '$complemento3', '$tema4', '$complemento4', '$tema5', '$complemento5')";

            if ($conn->query($sql) === TRUE) 
            {
                echo "Nuevo curso registrado con éxito";
            } 
            else 
            {
                echo "Error al registrar el curso: " . $conn->error;
            }
            $conn->close();
        ?>
        
</div>
</body>
</html>