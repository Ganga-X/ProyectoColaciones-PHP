<?php
require_once "../config/db.php";

/* RECIBIR DATOS */
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

$foto = "";

/* ✅ VERIFICAR SI SUBIÓ FOTO */
if (!empty($_FILES['foto']['name'])) {

    /* generar nombre único */
    $foto = time() . "_" . $_FILES['foto']['name'];

    /* guardar imagen en uploads */
    move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/" . $foto);

    /* actualizar incluyendo foto */
    $sql = "UPDATE usuarios 
            SET nombre=?, telefono=?, direccion=?, foto=? 
            WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $telefono, $direccion, $foto, $id);

} else {

    /* sin foto */
    $sql = "UPDATE usuarios 
            SET nombre=?, telefono=?, direccion=? 
            WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $telefono, $direccion, $id);
}

/* EJECUTAR */
if ($stmt->execute()) {

    /* ✅ FUTURO: REGISTRAR CAMBIO PARA ADMIN */
    // ejemplo futuro:
    // INSERT INTO notificaciones (mensaje) VALUES ('Usuario actualizó datos');

    header("Location: ../views/usuario.php");
    exit();

} else {
    echo "Error al actualizar datos";
}
?>