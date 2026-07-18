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
<title>Ventas Realizadas</title>
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
    background: #27ae60;
    color: white;
}
.total-box {
    margin-top: 20px;
    background: white;
    padding: 20px;
    border-radius: 10px;
    font-size: 22px;
    font-weight: bold;
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
    <h3>Ventas Realizadas</h3>
    <a href="admin.php" style="color:white;">Volver</a>
</div>

<div class="container">

<table>
    <tr>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Plato</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Total</th>
    </tr>

<?php
$totalGeneral = 0;

$sql = "SELECT pedidos.*, usuarios.nombre AS usuario, platos.nombre AS plato, platos.precio
FROM pedidos
JOIN usuarios ON pedidos.usuario_id = usuarios.id
JOIN platos ON pedidos.plato_id = platos.id
WHERE pedidos.estado = 'Entregado'
ORDER BY pedidos.fecha DESC";

$res = $conn->query($sql);

while($row = $res->fetch_assoc()):
    $total = $row['cantidad'] * $row['precio'];
    $totalGeneral += $total;
?>

<tr>
    <td><?php echo $row['fecha']; ?></td>
    <td><?php echo $row['usuario']; ?></td>
    <td><?php echo $row['plato']; ?></td>
    <td><?php echo $row['cantidad']; ?></td>
    <td>$<?php echo number_format($row['precio'],0,',','.'); ?></td>
    <td>$<?php echo number_format($total,0,',','.'); ?></td>
</tr>

<?php endwhile; ?>

</table>

<div class="total-box">
    Total vendido: $<?php echo number_format($totalGeneral,0,',','.'); ?>
</div>

<a href="#" class="btn-exportar">📥 Exportar Excel (próximamente)</a>

</div>

</body>
</html>