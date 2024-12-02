<?php
// Configuración de la base de datos
$host = "localhost"; 
$dbname = "proyecto"; 
$username = "root"; 
$password = ""; 

try {
    // Conexión a la base de datos usando PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"]; // Cambié 'fullname' por 'username'
    $email = $_POST["email"];
    $contrasena = $_POST["password"];
    $confirmar_contrasena = $_POST["confirmPassword"];
    $telefono = $_POST["telefono"]; // Cambié 'phoneNumber' por 'telefono'

    // Validaciones básicas
    if (empty($username) || empty($email) || empty($contrasena) || empty($confirmar_contrasena) || empty($telefono)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Verificar si las contraseñas coinciden
    if ($contrasena !== $confirmar_contrasena) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Cifrar la contraseña
    $contrasena_cifrada = password_hash($contrasena, PASSWORD_BCRYPT);

    try {
        // Insertar el usuario en la base de datos
        $sql = "INSERT INTO users (username, email, password, telefono) 
                VALUES (:username, :email, :password, :telefono)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $contrasena_cifrada);
        $stmt->bindParam(':telefono', $telefono); // Cambié la referencia

        $stmt->execute();
        echo "Registro exitoso.";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Código para errores de duplicación (email único)
            echo "El email ya está registrado.";
        } else {
            echo "Error al registrar el usuario: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear una cuenta</title>
    <link rel="stylesheet" href="./registro.css">
</head>
<body>
<div class="container">
  <h1>Regístrate</h1>
  <form action="" method="POST" class="registration-form">
    <div class="form-group">
      <label for="username">Nombre de usuario</label>
      <input type="text" id="username" name="username" placeholder="Ingresa tu nombre de usuario" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Ingresa tu Email" required>
    </div>
    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
    </div>
    <div class="form-group">
      <label for="confirmPassword">Confirmar contraseña</label>
      <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirma tu contraseña" required>
    </div>
    <div class="form-group">
      <label for="telefono">Número de teléfono</label>
      <input type="tel" id="telefono" name="telefono" placeholder="Ingresa tu número de teléfono" required>
    </div>
    <button type="submit" class="btn">Registrarse</button>
  </form>
</div>
</body>
</html>
