<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Colaciones</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <h1>Crear Cuenta</h1>
        <p class="subtitle">Registro de usuario</p>

        <form action="../controllers/registerController.php" method="POST">

            <div class="input-group">
                <input type="text" name="nombre" required>
                <label>Nombre completo</label>
            </div>

            <div class="input-group">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" required>
                <label>Contraseña</label>
            </div>

            <div class="input-group">
                <input type="text" name="telefono" required>
                <label>Teléfono</label>
            </div>

            <div class="input-group">
                <input type="text" name="direccion" required>
                <label>Dirección</label>
            </div>

            <button type="submit" class="btn-login">
                Crear Cuenta
            </button>

        </form>

        <hr style="margin:20px 0;">

        <p>¿Ya tienes cuenta?</p>

        <a href="login.php">
            <button class="install-btn">
                Volver al login
            </button>
        </a>

    </div>

</div>

</body>
</html>
