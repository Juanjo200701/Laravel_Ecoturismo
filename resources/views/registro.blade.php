<?php
session_start();
require_once 'conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    $errores = [];

    // Validar que los campos no estén vacíos
    if (empty($username) || empty($email) || empty($password) || empty($password2)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    // Validar formato del correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    // Validar que la contraseña tenga al menos 6 caracteres
    if (strlen($password) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    // Validar que las contraseñas coincidan
    if ($password !== $password2) {
        $errores[] = "Las contraseñas no coinciden.";
    }

    // Verificar si el usuario ya existe solo si no hay errores previos
    if (empty($errores)) {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $errores[] = "El nombre de usuario o el correo electrónico ya están en uso.";
        }
        $stmt->close();
    }

    // Si no hay errores, insertar el nuevo usuario
    if (empty($errores)) {
        $stmt = $conexion->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $username, $email, $password_hash);
        if ($stmt->execute()) {
            $mensaje = "<span style='color:green;'>Registro exitoso. Puedes iniciar sesión ahora.</span>";
        } else {
            $mensaje = "Error al registrar el usuario: " . $stmt->error;
        }
        $stmt->close();
    } else {
        foreach ($errores as $error) {
            $mensaje .= "<span style='color:red;'>$error</span><br>";
        }
    }
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css">
    <link rel="icon" href="imagenes/iconoecoturismo.jpg">
    <title>Registro</title>
</head>
<body>
    <header>
        <h2>Risaralda EcoTurismo</h2>
    </header>
    <div class="contenedor">
        <div class="login">
            <form id="formulario" action="pagcentral2.php" method="POST">
                <h3>Regístrate...</h3>
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" name="username" required>
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <button type="button" id="mostrarContraseña"></button>
                <label for="password2">Repita Contraseña:</label>
                <input type="password" id="password2" name="password2" required>
                <button type="button" id="mostrarContraseña2"></button>
                <?php if (!empty($mensaje)): ?>
                    <div><?= $mensaje ?></div>
                <?php endif; ?>
                <p><strong>¿Ya tienes una cuenta?</strong><br><a href="login.html">Inicia Sesión</a></p>
                <button id="btn" type="submit">Ingresar</button>
            </form>
        </div>
        <footer>
            <p>© 2025 Risaralda EcoTurismo</p>
        </footer>
    </div>
    <script type="text/javascript" src="js/registro.js"></script>
</body>
</html>