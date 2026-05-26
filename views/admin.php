<?php
session_start();
require_once "../config/db.php";

if ($_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin</title>

<link rel="stylesheet" href="../assets/css/styles.css">
<script src="../assets/js/app.js" defer></script>

<style>

/* BODY */
body {
    height: 100vh;
    display: flex;
    flex-direction: column;
    margin: 0;
}

/* CONTENEDOR */
.container {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 30px;
}

/* FORM */
.form-admin {
    width: 100%;
    max-width: 650px;
}

/* INPUTS */
.form-admin input,
.form-admin select,
.form-admin button {
    width: 100%;
    padding: 22px;
    margin-bottom: 40px;
    border-radius: 12px;
    border: 1px solid #ccc;
    font-size: 18px;
}

/* TÍTULO */
.form-admin h3 {
    text-align: center;
    margin-bottom: 50px;
    font-size: 26px;
}

/* BOTÓN */
.form-admin button {
    background: #3498db;
    color: white;
    border: none;
    cursor: pointer;
}

.form-admin button:hover {
    background: #2980b9;
}

/* ✅ BOTÓN VER PEDIDOS */
.btn-ver {
    background: #e67e22;
    color: white;
    border-radius: 12px;
    padding: 18px;
    font-size: 18px;
    width: 100%;
    max-width: 650px;
    margin-bottom: 20px;
    border: none;
    cursor: pointer;
}

/* HR */
hr {
    width: 100%;
    max-width: 1000px;
    margin: 40px 0;
}

/* GRID */
.grid {
    width: 100%;
    max-width: 1000px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
    gap: 25px;
}

/* CARD */
.card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    text-align: center;
}

.card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

/* CONTENIDO */
.card-content {
    padding: 15px;
}

.card-content h4 {
    font-size: 18px;
}

/* BOTÓN EDITAR */
.btn-edit {
    margin-top: 15px;
    padding: 12px;
    background: #27ae60;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn-edit:hover {
    background: #219150;
}

</style>

</head>

<body>

<div class="header">
    <h3>Panel Admin</h3>
    <a href="../controllers/logout.php" style="color:white;">Salir</a>
</div>

<div class="container">

<!-- ✅ BOTÓN VER PEDIDOS (NUEVO Y FUNCIONANDO) -->
<a href="verPedidos.php">
    <button class="btn-ver">Ver Pedidos</button>
</a>

<!-- FORMULARIO -->
<form class="form-admin" action="../controllers/platoController.php" method="POST" enctype="multipart/form-data">

    <h3>Agregar Plato</h3>

    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="descripcion" placeholder="Descripción" required>
    <input type="number" name="precio" placeholder="Precio" required>

    <select name="dia">
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miercoles">Miércoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Viernes">Viernes</option>
    </select>

    <input type="file" name="imagen" accept="image/*" capture="environment">

    <button type="submit">Guardar</button>

</form>

<hr>

<!-- LISTA DE PLATOS -->
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

        <a href="editarPlato.php?id=<?php echo $row['id']; ?>">
            <button class="btn-edit">Editar</button>
        </a>

    </div>
</div>

<?php endwhile; ?>

</div>

<hr>

<!-- ✅ TU SECCIÓN DE PEDIDOS ORIGINAL (NO TOCADA) -->
<h2>Pedidos de Usuarios</h2>

<div class="grid">

<?php
$sql = "SELECT pedidos.*, usuarios.nombre AS usuario, platos.nombre AS plato
FROM pedidos
JOIN usuarios ON pedidos.usuario_id = usuarios.id
JOIN platos ON pedidos.plato_id = platos.id
ORDER BY pedidos.fecha DESC";

$resPedidos = $conn->query($sql);

while($pedido = $resPedidos->fetch_assoc()):
?>

<div class="card">

    <div class="card-content">
        <h4><?php echo $pedido['plato']; ?></h4>

        <p><strong>Cliente:</strong> <?php echo $pedido['usuario']; ?></p>
        <p><strong>Cantidad:</strong> <?php echo $pedido['cantidad']; ?></p>
        <p><strong>Hora:</strong> <?php echo $pedido['hora']; ?></p>
        <p><strong>Fecha:</strong> <?php echo $pedido['fecha']; ?></p>
    </div>

</div>

<?php endwhile; ?>

</div>

</div>

</body>
</html>
