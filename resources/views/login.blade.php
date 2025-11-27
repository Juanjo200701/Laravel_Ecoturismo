<?php

session_start();
require_once 'conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $errores = [];

    // Validar que los campos no estén vacíos
    if (empty($username) || empty($password)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    // Verificar si el usuario existe solo si no hay errores previos
    if (empty($errores)) {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 0) {
            $errores[] = "El nombre de usuario no existe.";
        } else {
            $usuario = $resultado->fetch_assoc();
            // Verificar la contraseña
            if (!password_verify($password, $usuario['password'])) {
                $errores[] = "Contraseña incorrecta.";
            }
        }
        $stmt->close();
    }

    // Si no hay errores, iniciar sesión
    if (empty($errores) && isset($usuario)) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['username'] = $usuario['username'];
        $mensaje = "<span style='color:green;'>Inicio de sesión exitoso. Bienvenido, " . htmlspecialchars($usuario['username']) . "!</span>";
        header("Location: pagcentral2.php");
        exit;
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
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="icon" href="imagenes/iconoecoturismo.jpg">
    <title>Login</title>
</head>
<body>
    <video autoplay loop muted id="video_background" preload="auto" volume="50">
        <source src="/imagenes/Videofondo2.mp4" type="video/mp4" />
    </video>
    <header>
        <h1>Risaralda EcoTurismo</h1>
    </header>
    <div class="contenedor">
        <div class="login">
            <form id="formulario" action="login.php" method="POST">
                <label for="username">Nombre de usuario:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <button type="button" id="mostrarContraseña"></button>
                <?php if (!empty($mensaje)): ?>
                    <div><?= $mensaje ?></div>
                <?php endif; ?>
                <p><strong>¿Todavía no tienes cuenta?</strong><br><a href="registro.php">Regístrate</a></p>
                
                <button id="btn" type="submit">Iniciar sesión</button>
            </form>
        </div>
        <footer>
            <p>© 2025 Risaralda EcoTurismo</p>
        </footer>
    </div>
    <script type="text/javascript" src="js/login.js"></script>
</body>
</html>