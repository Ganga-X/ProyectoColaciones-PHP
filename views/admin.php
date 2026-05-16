<?php
session_start();
require_once "../config/db.php";

if ($_SESSION['rol'] != 'admin') {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin</title>

<link rel="stylesheet" href="../assets/css/styles.css">
<script src="../assets/js/app.js" defer></script>

</head>

<body>

<div class="header">
    <h3>Panel Admin</h3>
    <a href="../controllers/logout.php" style="color:white;">Salir</a>
</div>

<div class="container">

<h3>Agregar Plato</h3>

<form action="../controllers/platoController.php" method="POST" enctype="multipart/form-data">

<input type="text" name="nombre" placeholder="Nombre" required>
<input type="text" name="descripcion" placeholder="Descripción" required>
<input type="number" name="precio" placeholder="Precio" required>

<select name="dia">
<option>Lunes</option>
<option>Martes</option>
<option>Miercoles</option>
<option>Jueves</option>
<option>Viernes</option>
</select>

<input type="file" name="imagen" accept="image/*" capture="environment">

<button>Guardar</button>

</form>

<hr>

<div class="grid">

<?php
$res = $conn->query("SELECT * FROM platos");

while($row = $res->fetch_assoc()):
?>

<div class="card">
<img src="../uploads/<?php echo $row['imagen']; ?>">
<div class="card-content">
<h4><?php echo $row['nombre']; ?></h4>
<p><?php echo $row['descripcion']; ?></p>
<p>$<?php echo $row['precio']; ?></p>
</div>
</div>

<?php endwhile; ?>

</div>

</div>

</body>
</html>