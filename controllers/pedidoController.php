<?php
require_once "../config/db.php";

$usuario_id = $_POST['usuario_id'];
$plato_id = $_POST['plato_id'];
$cantidad = $_POST['cantidad'];
$hora = $_POST['hora'];

/* Obtener el precio del plato */
$sqlPrecio = "SELECT precio FROM platos WHERE id = ?";
$stmtPrecio = $conn->prepare($sqlPrecio);
$stmtPrecio->bind_param("i", $plato_id);
$stmtPrecio->execute();
$resultado = $stmtPrecio->get_result();
$plato = $resultado->fetch_assoc();

$precio_unitario = $plato['precio'];
$total = $precio_unitario * $cantidad;

/* Insertar pedido */
$sql = "INSERT INTO pedidos (
            usuario_id,
            plato_id,
            cantidad,
            precio_unitario,
            total,
            hora
        )
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "iiidds",
    $usuario_id,
    $plato_id,
    $cantidad,
    $precio_unitario,
    $total,
    $hora
);

$stmt->execute();

header("Location: ../views/usuario.php");
exit();
?>