<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Colaciones</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/styles.css">

    <!-- PWA -->
    <link rel="manifest" href="../manifest.json">

    <!-- JS -->
    <script src="../assets/js/app.js" defer></script>
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <h1>🍱 Colaciones</h1>
        <p class="subtitle">Sistema de pedidos</p>

        <!-- BOTÓN INSTALAR APP -->
        <button id="btnInstall" class="install-btn" style="display:none;">
            Instalar App
        </button>

        <!-- FORM LOGIN -->
        <form action="../controllers/authController.php" method="POST">

            <div class="input-group">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" required>
                <label>Contraseña</label>
            </div>

            <button type="submit" class="btn-login">
                Iniciar Sesión
            </button>

        </form>

        <!-- SEPARADOR -->
        <hr style="margin:20px 0;">

        <!-- BOTÓN REGISTRO -->
        <p>
            ¿No tienes cuenta?
        </p>

        <a href="register.php">
            <button class="install-btn" style="background:#8e44ad;">
                Crear cuenta
            </button>
        </a>

    </div>

</div>

</body>
</html>