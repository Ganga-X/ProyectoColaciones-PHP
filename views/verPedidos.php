<?php
session_start();
require_once "../config/db.php";

if ($_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Pedidos</title>

<style>
body {
    font-family: Arial;
    background: #f4f6f9;
    margin: 0;
}

/* HEADER */
.header {
    background: #2c3e50;
    color: white;
    padding: 12px;
    display: flex;
    justify-content: space-between;
}

.container {
    padding: 20px;
}

/* CARD */
.card {
    background: white;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 10px;
}

/* ✅ ESTADO COLORES */
.estado {
    padding: 6px 10px;
    border-radius: 8px;
    color: white;
    font-size: 12px;
    display: inline-block;
    margin-bottom: 10px;
}

.pendiente { background: #27ae60; }     /* 🟢 */
.preparacion { background: #f1c40f; }   /* 🟡 */
.entregado { background: #3498db; }     /* 🔵 */

/* ✅ BOTONES ADMIN */
.btn {
    padding: 6px;
    border: none;
    border-radius: 6px;
    margin-top: 5px;
    width: 100%;
    cursor: pointer;
}

.btn-pendiente { background: #27ae60; color: white; }
.btn-preparacion { background: #f1c40f; }
.btn-entregado { background: #3498db; color: white; }

</style>

</head>

<body>

<div class="header">
    <h3>Pedidos</h3>
    <a href="admin.php" style="color:white;">Volver</a>
</div>

<div class="container">

<?php
$sql = "SELECT pedidos.*, usuarios.nombre AS usuario, platos.nombre AS plato, platos.dia
FROM pedidos
JOIN usuarios ON pedidos.usuario_id = usuarios.id
JOIN platos ON pedidos.plato_id = platos.id
ORDER BY platos.dia ASC, pedidos.hora ASC";

$res = $conn->query($sql);

$dia_actual = "";

while($row = $res->fetch_assoc()):

    if ($dia_actual != $row['dia']) {
        $dia_actual = $row['dia'];
        echo "<h2>$dia_actual</h2>";
    }

    /* ✅ DEFINIR COLOR SEGÚN ESTADO */
    $estadoClass = "pendiente";

    if ($row['estado'] == "En preparación") {
        $estadoClass = "preparacion";
    } elseif ($row['estado'] == "Entregado") {
        $estadoClass = "entregado";
    }
?>

<div class="card">

    <h4><?php echo $row['plato']; ?></h4>

    <!-- ✅ ESTADO -->
    <div class="estado <?php echo $estadoClass; ?>">
        <?php echo $row['estado']; ?>
    </div>

    <p><strong>Cliente:</strong> <?php echo $row['usuario']; ?></p>
    <p><strong>Cantidad:</strong> <?php echo $row['cantidad']; ?></p>
    <p><strong>Hora:</strong> <?php echo $row['hora']; ?></p>

    <!-- ✅ CAMBIAR ESTADO -->
    <form action="../controllers/updateEstado.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="estado" value="Pendiente">
        <button class="btn btn-pendiente">Pendiente</button>
    </form>

    <form action="../controllers/updateEstado.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="estado" value="En preparación">
        <button class="btn btn-preparacion">En preparación</button>
    </form>

    <form action="../controllers/updateEstado.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="estado" value="Entregado">
        <button class="btn btn-entregado">Entregado</button>
    </form>

</div>

<?php endwhile; ?>

</div>

</body>
</html>
