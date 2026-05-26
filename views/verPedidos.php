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

.card {
    background: white;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 10px;
}

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
?>

<div class="card">
    <h4><?php echo $row['plato']; ?></h4>
    <p><strong>Cliente:</strong> <?php echo $row['usuario']; ?></p>
    <p><strong>Cantidad:</strong> <?php echo $row['cantidad']; ?></p>
    <p><strong>Hora:</strong> <?php echo $row['hora']; ?></p>
</div>

<?php endwhile; ?>

</div>

</body>
</html>