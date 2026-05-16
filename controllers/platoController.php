<?php
require_once "../config/db.php";

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$dia = $_POST['dia'];

$imagen = "";

if (!empty($_FILES['imagen']['name'])) {
    $imagen = time() . "_" . $_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'], "../uploads/" . $imagen);
}

$sql = "INSERT INTO platos(nombre, descripcion, precio, dia, imagen)
VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiss", $nombre, $descripcion, $precio, $dia, $imagen);
$stmt->execute();

header("Location: ../views/admin.php");
?>