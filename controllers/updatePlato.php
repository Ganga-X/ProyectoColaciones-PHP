<?php
require_once "../config/db.php";

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$dia = $_POST['dia'];

/* SI SUBE IMAGEN */
if (!empty($_FILES['imagen']['name'])) {

    $imagen = time() . "_" . $_FILES['imagen']['name'];

    move_uploaded_file(
        $_FILES['imagen']['tmp_name'],
        "../uploads/" . $imagen
    );

    $sql = "UPDATE platos
    SET nombre=?, descripcion=?, precio=?, dia=?, imagen=?
    WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissi", $nombre, $descripcion, $precio, $dia, $imagen, $id);

} else {

    $sql = "UPDATE platos
    SET nombre=?, descripcion=?, precio=?, dia=?
    WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $nombre, $descripcion, $precio, $dia, $id);
}

$stmt->execute();

header("Location: ../views/admin.php");
exit();
?>