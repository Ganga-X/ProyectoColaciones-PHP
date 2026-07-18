<?php
require_once "../config/db.php";

$id = $_POST['id'];
$estado = $_POST['estado'];

$sql = "UPDATE pedidos SET estado=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $estado, $id);
$stmt->execute();

header("Location: ../views/verPedidos.php");
exit();
