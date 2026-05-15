<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
}
?>

<link rel="stylesheet" href="../assets/css/styles.css">

<div class="header">
    <h2>Panel Admin</h2>
    ../controllers/logout.php">Salir</a>
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

        <input type="file" name="imagen">

        <button type="submit">Guardar</button>
    </form>

    <hr>

    <h3>Platos</h3>

    <div class="grid">

    <?php
    $result = $conn->query("SELECT * FROM platos");

    while($row = $result->fetch_assoc()):
    ?>

    <div class="card">
        <h4><?php echo $row['nombre']; ?></h4>
        <p><?php echo $row['descripcion']; ?></p>
        <p>$<?php echo $row['precio']; ?></p>

        <?php if($row['imagen']): ?>
            <img src="../uploads/<?php echo $row['imagen']; ?>">
        <?php endif; ?>
    </div>

    <?php endwhile; ?>

    </div>

</div>
``