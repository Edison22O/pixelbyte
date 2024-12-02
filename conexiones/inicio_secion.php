<?php
session_start();

// Configuración de la base de datos
$host = "localhost";
$dbname = "proyecto";
$username = "root";
$password = "";

try {
    // Conexión a la base de datos
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si se envió el formulario
$error = ""; // Variable para manejar mensajes de error
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
}
    // Validar si los campos están vacíos
    if (empty($username) || empty($password)) {
        $error = "Por favor, completa todos los campos.";
    } 
    else {
        try {
            // Consultar la base de datos para verificar el username
            $sql = "SELECT id, password FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Iniciar sesión
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $username;

                // Redirigir al panel
                header("Location: ../conexiones/galeria.php");
                exit;
            } 
            else {
                $error = "Credenciales incorrectas.";
            }
        } catch (PDOException $e) {
            $error = "Error en el servidor: " . $e->getMessage();
        }
    }
session_start(); // Inicia la sesión
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "proyecto");

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar usuario
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Guardar ID en sesión
            $_SESSION['username'] = $user['username'];
            header("Location: ../galeria.html"); // Redirigir a la galería
            exit;
        } else {
            echo "<p>Contraseña incorrecta.</p>";
        }
    } else {
        echo "<p>Usuario no encontrado.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../conexiones/inicio.css">
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="avatar">
                <img src="../images/usuario.svg" alt="Avatar">
            </div>
            <form action="" method="POST" id="loginForm">
                <div class="input-group">
                    <label for="username">
                        <input type="text" name="username" id="username" placeholder="Usuario" required>
                    </label>
                </div>
                <div class="input-group">
                    <label for="password">
                        <input type="password" name="password" id="password" placeholder="Contraseña" required>
                    </label>
                </div>
                <button type="submit" class="login-btn">INICIAR SESIÓN</button>
                <div class="options">
                    <label>
                        <input type="checkbox"> Recuérdame
                    </label>
                    <a href="./registro.php" class="register-link">Regístrate</a>
                </div>
            </form>
            <?php if ($error): ?>
                <p class="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
