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
<title>Movimientos</title>
<style>
body {
    font-family: Arial;
    background: #f4f6f9;
    margin: 0;
}
.header {
    background: #2c3e50;
    color: white;
    padding: 15px;
    display: flex;
    justify-content: space-between;
}
.container {
    padding: 20px;
}
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}
th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}
th {
    background: #3498db;
    color: white;
}
.btn-exportar {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 20px;
    background: #27ae60;
    color: white;
    text-decoration: none;
    border-radius: 8px;
}
</style>
</head>
<body>

<div class="header">
    <h3>Movimientos de Pedidos</h3>
    <a href="admin.php" style="color:white;">Volver</a>
</div>

<div class="container">

<table>
    <tr>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Plato</th>
        <th>Cantidad</th>
        <th>Hora</th>
        <th>Estado</th>
    </tr>

<?php
$sql = "SELECT pedidos.*, usuarios.nombre AS usuario, platos.nombre AS plato
FROM pedidos
JOIN usuarios ON pedidos.usuario_id = usuarios.id
JOIN platos ON pedidos.plato_id = platos.id
ORDER BY pedidos.fecha DESC";

$res = $conn->query($sql);

while($row = $res->fetch_assoc()):
?>

<tr>
    <td><?php echo $row['fecha']; ?></td>
    <td><?php echo $row['usuario']; ?></td>
    <td><?php echo $row['plato']; ?></td>
    <td><?php echo $row['cantidad']; ?></td>
    <td><?php echo $row['hora']; ?></td>
    <td><?php echo $row['estado']; ?></td>
</tr>

<?php endwhile; ?>

</table>

<a href="#" class="btn-exportar">📥 Exportar Excel (próximamente)</a>

</div>

</body>
</html>