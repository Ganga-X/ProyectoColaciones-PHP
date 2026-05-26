<?php
session_start();
require_once "../config/db.php";

$user_id = $_SESSION['id'];

/* ✅ TRAEMOS ESTADO TAMBIÉN */
$sql = "SELECT pedidos.*, platos.nombre AS plato, platos.imagen
FROM pedidos
JOIN platos ON pedidos.plato_id = platos.id
WHERE usuario_id = $user_id";

$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Mis Pedidos</title>

<style>
body { 
    font-family: Arial; 
    background: #f4f6f9;
    margin: 0;
}

/* HEADER */
.header {
    background: #2c3e50;
    color: white;
    padding: 15px;
    display: flex;
    justify-content: space-between;
}

/* CONTENEDOR */
.container {
    padding: 15px;
}

/* CARD */
.card {
    background: white;
    margin-bottom: 12px;
    padding: 12px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

/* IMAGEN */
.card img {
    width: 100%;
    border-radius: 8px;
    margin-bottom: 10px;
}

/* BADGE ESTADO */
.estado {
    padding: 6px 10px;
    border-radius: 8px;
    color: white;
    font-size: 12px;
    display: inline-block;
    margin-bottom: 10px;
}

.pendiente { background: #27ae60; }      /* 🟢 */
.preparacion { background: #f1c40f; }    /* 🟡 */
.entregado { background: #3498db; }      /* 🔵 */

/* BOTONES */
button {
    padding: 6px;
    margin-top: 5px;
    width: 100%;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.btn-delete {
    background: #e74c3c;
    color: white;
}

.btn-update {
    background: #3498db;
    color: white;
}

/* INPUTS */
input, select {
    width: 100%;
    padding: 6px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
</style>

</head>

<body>

<div class="header">
    <h3>Mis Pedidos</h3>
    <a href="usuario.php" style="color:white;">Volver</a>
</div>

<div class="container">

<!-- ✅ ALERTA -->
<?php if(isset($_GET['msg']) && $_GET['msg'] == 'eliminado'): ?>
<script>
    alert("✅ Pedido eliminado correctamente");
</script>
<?php endif; ?>

<?php while($row = $res->fetch_assoc()): ?>

<div class="card">

    <!-- ✅ IMAGEN -->
    <img src="../uploads/<?php echo $row['imagen']; ?>">

    <h3><?php echo $row['plato']; ?></h3>

    <!-- ✅ ESTADO CON COLOR -->
    <?php
    $estadoClass = "pendiente";

    if ($row['estado'] == "En preparación") {
        $estadoClass = "preparacion";
    } elseif ($row['estado'] == "Entregado") {
        $estadoClass = "entregado";
    }
    ?>
    
    <div class="estado <?php echo $estadoClass; ?>">
        <?php echo $row['estado']; ?>
    </div>

    <p><strong>Cantidad:</strong> <?php echo $row['cantidad']; ?></p>
    <p><strong>Hora:</strong> <?php echo $row['hora']; ?></p>

    <!-- ✅ ELIMINAR -->
    <form action="../controllers/deletePedido.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button class="btn-delete">Eliminar</button>
    </form>

    <!-- ✅ EDITAR -->
    <form action="../controllers/updatePedido.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <input type="number" name="cantidad" value="<?php echo $row['cantidad']; ?>">

        <select name="hora">
            <option <?php if($row['hora']=="12:00") echo "selected"; ?>>12:00</option>
            <option <?php if($row['hora']=="12:30") echo "selected"; ?>>12:30</option>
            <option <?php if($row['hora']=="13:00") echo "selected"; ?>>13:00</option>
            <option <?php if($row['hora']=="13:30") echo "selected"; ?>>13:30</option>
            <option <?php if($row['hora']=="14:00") echo "selected"; ?>>14:00</option>
            <option <?php if($row['hora']=="14:30") echo "selected"; ?>>14:30</option>
            <option <?php if($row['hora']=="15:00") echo "selected"; ?>>15:00</option>
        </select>

        <button class="btn-update">Actualizar</button>
    </form>

</div>

<?php endwhile; ?>

</div>

</body>
</html>
