<?php
require_once "../config/db.php";

$usuario_id = $_POST['usuario_id'];
$plato_id = $_POST['plato_id'];
$cantidad = $_POST['cantidad'];
$hora = $_POST['hora'];

$sql = "INSERT INTO pedidos (usuario_id, plato_id, cantidad, hora)
VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiis", $usuario_id, $plato_id, $cantidad, $hora);

$stmt->execute();

header("Location: ../views/usuario.php");
exit();
?>
``