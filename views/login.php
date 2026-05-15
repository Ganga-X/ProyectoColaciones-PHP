<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<div class="container">
    <h2 style="text-align:center;">Sistema de Colaciones</h2>

    <form action="../controllers/authController.php" method="POST">

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contraseña" required>

        <button type="submit">Ingresar</button>

    </form>
</div>

</body>
</html>
