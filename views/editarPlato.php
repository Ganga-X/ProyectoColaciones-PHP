<?php
session_start();
require_once "../config/db.php";

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM platos WHERE id=$id");
$plato = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Editar Plato</title>

<link rel="stylesheet" href="../assets/css/styles.css">

<style>
.container {
    padding: 20px;
}
.form-admin {
    max-width: 600px;
    margin: auto;
}
.form-admin input,
.form-admin select,
.form-admin button {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
}
</style>

</head>

<body>

<div class="container">

<h2>Editar Plato</h2>

<form action="../controllers/updatePlato.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $plato['id']; ?>">

<input type="text" name="nombre" value="<?php echo $plato['nombre']; ?>">

<input type="text" name="descripcion" value="<?php echo $plato['descripcion']; ?>">

<input type="number" name="precio" value="<?php echo $plato['precio']; ?>">

<select name="dia">
    <option><?php echo $plato['dia']; ?></option>
    <option>Lunes</option>
    <option>Martes</option>
    <option>Miercoles</option>
    <option>Jueves</option>
    <option>Viernes</option>
</select>

<p>Imagen actual:</p>
<img src="../uploads/<?php echo $plato['imagen']; ?>" width="150">

<input type="file" name="imagen">

<button>Actualizar</button>

</form>

</div>

</body>
</html>
