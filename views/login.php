<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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

        <button id="btnInstall" class="install-btn" style="display:none;">
            Instalar App
        </button>

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

    </div>

</div>

</body>
</html>