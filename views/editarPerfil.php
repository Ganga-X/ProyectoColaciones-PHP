<?php
session_start();
require_once "../config/db.php";

/* Validación */
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'usuario') {
    header("Location: login.php");
    exit();
}

/* Obtener datos del usuario */
$id = $_SESSION['id'];

$result = $conn->query("SELECT * FROM usuarios WHERE id = $id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Perfil</title>

<!-- CSS -->
<link rel="stylesheet" href="../assets/css/styles.css">

</head>

<body>

<div class="header">
    <h3>Editar Perfil</h3>
    <a href="usuario.php" style="color:white;">Volver</a>
</div>

<div class="container">

    <div class="login-card">

        <h2>Actualizar datos</h2>

        <!-- ✅ IMPORTANTE: enctype para subir imagen -->
        <form action="../controllers/updatePerfil.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <!-- FOTO ACTUAL -->
            <div style="text-align:center; margin-bottom:20px;">
                <?php if (!empty($user['foto'])): ?>
                    <img src="../uploads/<?php echo $user['foto']; ?>" 
                         style="width:100px; height:100px; border-radius:50%; object-fit:cover;">
                <?php else: ?>
                    <p>No hay foto</p>
                <?php endif; ?>
            </div>

            <!-- INPUT FOTO -->
            <div class="input-group">
                <input type="file" name="foto" accept="image/*" capture="environment">
                <label>Foto de perfil</label>
            </div>

            <!-- NOMBRE -->
            <div class="input-group">
                <input type="text" name="nombre" value="<?php echo $user['nombre']; ?>" required>
                <label>Nombre</label>
            </div>

            <!-- TELÉFONO -->
            <div class="input-group">
                <input type="text" name="telefono" value="<?php echo $user['telefono']; ?>" required>
                <label>Teléfono</label>
            </div>

            <!-- DIRECCIÓN -->
            <div class="input-group">
                <input type="text" name="direccion" value="<?php echo $user['direccion']; ?>" required>
                <label>Dirección</label>
            </div>

            <button type="submit" class="btn-login">
                Guardar cambios
            </button>

        </form>

    </div>

</div>

</body>
</html>