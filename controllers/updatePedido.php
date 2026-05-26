<?php
require_once "../config/db.php";

$id = $_POST['id'];
$cantidad = $_POST['cantidad'];
$hora = $_POST['hora'];

$sql = "UPDATE pedidos SET cantidad=?, hora=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isi", $cantidad, $hora, $id);
$stmt->execute();

header("Location: ../views/misPedidos.php");