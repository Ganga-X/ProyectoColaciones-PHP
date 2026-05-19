<?php
require_once "../config/db.php";

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

$sql = "INSERT INTO usuarios (nombre, email, password, rol, telefono, direccion)
VALUES (?, ?, ?, 'usuario', ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $nombre, $email, $password, $telefono, $direccion);

if ($stmt->execute()) {
    header("Location: ../views/login.php");
    exit();
} else {
    echo "Error al registrar usuario";
}
?>
