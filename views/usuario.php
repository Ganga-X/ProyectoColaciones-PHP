<?php
session_start();
require_once "../config/db.php";

if ($_SESSION['rol'] != 'usuario') {
    header("Location: login.php");
    exit();
}

/* Obtener datos del usuario */
$user_id = $_SESSION['id'];
$userQuery = $conn->query("SELECT * FROM usuarios WHERE id = $user_id");
$user = $userQuery->fetch_assoc();

$dia = $_GET['dia'] ?? 'Lunes';
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Usuario</title>

<style>

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* BODY */
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}

/* HEADER */
.header {
    background: #2c3e50;
    color: white;
    padding: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* FOTO + USUARIO */
.user-header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-photo {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

/* CONTAINER */
.container {
    padding: 15px;
}

/* INFO */
.user-info {
    background: white;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 15px;
    font-size: 14px;
}

/* NAV DIAS */
.nav-dias {
    margin-bottom: 10px;
}

.nav-dias a {
    margin-right: 10px;
    text-decoration: none;
    font-weight: bold;
    color: #3498db;
}

/* GRID */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
    gap: 10px;
}

/* CARD */
.card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.card img {
    width: 100%;
}

.card-content {
    padding: 10px;
}

/* RESPONSIVE MOBILE */
@media (max-width: 600px) {
    .grid {
        grid-template-columns: 1fr;
    }
}

</style>

</head>

<body>

<!-- HEADER -->
<div class="header">

    <div class="user-header">

        <?php if (!empty($user['foto'])): ?>
            <img src="../uploads/<?php echo $user['foto']; ?>" class="user-photo">
        <?php endif; ?>

        <h3><?php echo $_SESSION['nombre']; ?></h3>
    </div>

    <a href="../controllers/logout.php" style="color:white;">Salir</a>
</div>

<div class="container">

    <!-- INFO USUARIO -->
    <div class="user-info">
        <strong>Teléfono:</strong> <?php echo $user['telefono'] ?? 'No registrado'; ?> <br>
        <strong>Dirección:</strong> <?php echo $user['direccion'] ?? 'No registrada'; ?>
        
        <br><br>

        <a href="editarPerfil.php" style="color:#3498db;">
            Editar datos
        </a>
    </div>

    <!-- MENÚ -->
    <h3>Menú del día: <?php echo $dia; ?></h3>

    <div class="nav-dias">
        <a href="?dia=Lunes">Lunes</a>
        <a href="?dia=Martes">Martes</a>
        <a href="?dia=Miercoles">Miércoles</a>
        <a href="?dia=Jueves">Jueves</a>
        <a href="?dia=Viernes">Viernes</a>
    </div>

    <hr>

    <!-- PLATOS -->
    <div class="grid">

    <?php
    $res = $conn->query("SELECT * FROM platos WHERE dia='$dia'");

    while($row = $res->fetch_assoc()):
    ?>

    <div class="card">

        <img src="../uploads/<?php echo $row['imagen']; ?>">

        <div class="card-content">
            <h4><?php echo $row['nombre']; ?></h4>
            <p><?php echo $row['descripcion']; ?></p>
            <p><strong>$<?php echo $row['precio']; ?></strong></p>
        </div>

    </div>

    <?php endwhile; ?>

    </div>

</div>

</body>
</html>