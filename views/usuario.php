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

/* TU MISMO ESTILO ORIGINAL */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}

.header {
    background: #2c3e50;
    color: white;
    padding: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

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

.container {
    padding: 15px;
}

.user-info {
    background: white;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 15px;
    font-size: 14px;
}

/* ✅ BOTÓN NUEVO */
.btn-mis-pedidos {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 12px;
    background: #e67e22;
    color: white;
    border-radius: 6px;
    text-decoration: none;
}

.nav-dias {
    margin-bottom: 10px;
}

.nav-dias a {
    margin-right: 10px;
    text-decoration: none;
    font-weight: bold;
    color: #3498db;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
    gap: 10px;
}

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

.card form {
    margin-top: 10px;
}

.card input,
.card select {
    width: 100%;
    padding: 6px;
    margin-top: 6px;
    margin-bottom: 6px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 12px;
}

.card button {
    width: 100%;
    padding: 8px;
    background: #27ae60;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.card button:hover {
    background: #219150;
}

@media (max-width: 600px) {
    .grid {
        grid-template-columns: 1fr;
    }
}

</style>

</head>

<body>

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

    <div class="user-info">
        <strong>Teléfono:</strong> <?php echo $user['telefono'] ?? 'No registrado'; ?><br>
        <strong>Dirección:</strong> <?php echo $user['direccion'] ?? 'No registrada'; ?>
        
        <br><br>

        <a href="editarPerfil.php" style="color:#3498db;">
            Editar datos
        </a>

        <br><br>

        <!-- ✅ BOTÓN AGREGADO -->
        <a href="misPedidos.php" class="btn-mis-pedidos">Ver mis pedidos</a>

    </div>

    <h3>Menú del día: <?php echo $dia; ?></h3>

    <div class="nav-dias">
        <a href="?dia=Lunes">Lunes</a>
        <a href="?dia=Martes">Martes</a>
        <a href="?dia=Miercoles">Miércoles</a>
        <a href="?dia=Jueves">Jueves</a>
        <a href="?dia=Viernes">Viernes</a>
    </div>

    <hr>

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

            <form action="../controllers/pedidoController.php" method="POST">

                <input type="hidden" name="plato_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id']; ?>">

                <label>Cantidad:</label>
                <input type="number" name="cantidad" min="1" value="1" required>

                <label>Hora:</label>
                <select name="hora" required>
                    <option value="12:00">12:00</option>
                    <option value="12:30">12:30</option>
                    <option value="13:00">13:00</option>
                    <option value="13:30">13:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                </select>

                <button type="submit">Pedir</button>

            </form>

        </div>

    </div>

    <?php endwhile; ?>

    </div>

</div>

</body>
</html>