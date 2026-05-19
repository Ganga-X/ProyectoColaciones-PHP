<?php
session_start();
require_once "../config/db.php";

if ($_SESSION['rol'] != 'usuario') {
    header("Location: login.php");
}

$dia = $_GET['dia'] ?? 'Lunes';
?>

<!DOCTYPE html>
<html>
<head>
<title>Usuario</title>

<link rel="stylesheet" href="../assets/css/styles.css">
<script src="../assets/js/app.js" defer></script>

</head>

<body>

<div class="header">
<h3><?php echo $_SESSION['nombre']; ?></h3>
<a href="../controllers/logout.php" style="color:white;">Salir</a>
</div>

<div class="container">

<h3>Menú del día: <?php echo $dia; ?></h3>

<div>
<a href="?dia=Lunes">Lunes</a> |
<a href="?dia=Martes">Martes</a> |
<a href="?dia=Miercoles">Miércoles</a>
</div>

<hr>

<div class="grid">

<?php
$res = $conn->query("SELECT * FROM platos WHERE dia='$dia'");

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