<?php
// Configuración de conexión a la base de datos
$servername = "localhost"; // Cambia según tu configuración
$username = "root"; // Cambia según tu usuario
$password = ""; // Cambia según tu contraseña
$database = "proyecto"; // Cambia según tu base de datos

// Crear conexión
$conn = new mysqli("localhost", "root", "", "proyecto");

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Procesar formulario de subida
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['archivo']) && is_array($_FILES['archivo']['name'])) {
        $totalArchivos = count($_FILES['archivo']['name']); // Para múltiples archivos
        $uploadDir = "uploads/";

        // Crear el directorio si no existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        for ($i = 0; $i < $totalArchivos; $i++) {
            if ($_FILES['archivo']['error'][$i] === UPLOAD_ERR_OK) {
                $imageName = basename($_FILES['archivo']['name'][$i]);
                $imageTmpPath = $_FILES['archivo']['tmp_name'][$i];
                $uploadPath = $uploadDir . $imageName;

                // Mover la imagen al directorio de subida
                if (move_uploaded_file($imageTmpPath, $uploadPath)) {
                    $userId = 1; // Cambia según sea necesario
                    $title = "Imagen " . ($i + 1); // Puedes modificar para recibir desde un formulario
                    $description = "Descripción automática"; // También se puede personalizar
                    $uploadedAt = date('Y-m-d H:i:s');

                    // Insertar datos en la base de datos
                    $stmt = $conn->prepare("INSERT INTO images (user_id, image_url, title, description, uploaded_at) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("issss", $userId, $uploadPath, $title, $description, $uploadedAt);

                    if ($stmt->execute()) {
                        echo "Imagen " . ($i + 1) . " subida y datos guardados correctamente.<br>";
                    } else {
                        echo "Error al guardar los datos de la imagen " . ($i + 1) . ": " . $stmt->error . "<br>";
                    }

                    $stmt->close();
                } else {
                    echo "Error al mover la imagen " . ($i + 1) . " al directorio de subida.<br>";
                }
            } else {
                $errorCode = $_FILES['archivo']['error'][$i];
                $errorMessages = [
                    UPLOAD_ERR_INI_SIZE => "El archivo excede el tamaño máximo permitido por la configuración del servidor.",
                    UPLOAD_ERR_FORM_SIZE => "El archivo excede el tamaño máximo permitido por el formulario.",
                    UPLOAD_ERR_PARTIAL => "El archivo fue subido parcialmente.",
                    UPLOAD_ERR_NO_FILE => "No se seleccionó ningún archivo.",
                    UPLOAD_ERR_NO_TMP_DIR => "Falta la carpeta temporal en el servidor.",
                    UPLOAD_ERR_CANT_WRITE => "No se pudo escribir el archivo en el disco.",
                    UPLOAD_ERR_EXTENSION => "Una extensión de PHP detuvo la subida del archivo."
                ];

                echo "Error al subir la imagen " . ($i + 1) . ": " . ($errorMessages[$errorCode] ?? "Error desconocido.") . "<br>";
            }
        }
    } else {
        echo "No se seleccionó ningún archivo o el formato del campo no es correcto.<br>";
    }
}

// Obtener imágenes para la galería
$query = "SELECT image_url, title, description FROM images ORDER BY uploaded_at DESC";
$result = $conn->query($query);

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixelbyte</title>

    <link rel="stylesheet" href="../conexiones/Galeria.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .gallery {
            margin: 20px auto;
            max-width: 30%; /* Ancho máximo de la galería */
            height: 350px; /* Altura fija de la galería */
            overflow-y: auto; /* Activar el scroll vertical */
            padding: 10px;
            background-color: #fff;
            border-radius: 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columnas */
            gap: 20px;
        }

        .gallery-item {
            text-align: center;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .gallery-item h3 {
            margin: 10px 0 5px;
            font-size: 1rem;
        }

        .gallery-item p {
            font-size: 0.9rem;
            color: #555;
        }
    </style>
</head>
<body>
    <!--Header - Menu-->
    <header>
        <div class="container__header">
            <div class="logo">
                <a href="#">
                    <img src="../images/logo/Logo.PNG" alt="">
                </a>
            </div>

            <div class="menu">
                <nav>
                    <ul>
                        <li><a href="../index.html">Inicio</a></li>
                        <li><a href="../conexiones/galeria.php">Galeria</a></li>
                        <li><a href="./index.html">Inicio</a></li>
                        <li><a href="./conexiones/inicio_secion.php">Galeria</a></li>

                    </ul>
                </nav>
                <div class="socialMedia">
                    <a href="#"><img src="../images/Redes/facebook.png" alt=""></a>
                    <a href="#"><img src="../images/Redes/instagram.png" alt=""></a>
                    <a href="#"><img src="../images/Redes/twitter.png" alt=""></a>
                    <a href="#"><img src="../images/Redes/youtube.png" alt=""></a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!--Form para subir múltiples imágenes-->
        <div class="container__cover div__offset">
            <div class="cover">
                
        <!-- Mostrar imágenes -->
        <div class="gallery">
            <h2>Galería de Imágenes</h2>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="gallery-item">
                        <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay imágenes disponibles.</p>
            <?php endif; ?>
        </div>
                <section class="text__cover"></section>
                <section class="image__cover1">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <label for="archivo">Seleccionar imágenes:</label>
                        <input type="file" name="archivo[]" multiple required><br><br>
                        <button type="submit" class="trig">Enviar</button>
                    </form>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
