<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'usuario') {
    header("Location: login.php");
}

$dia = isset($_GET['dia']) ? $_GET['dia'] : 'Lunes';
?>

<link rel="stylesheet" href="../assets/css/styles.css">

<div class="header">
    <h2>Bienvenido <?php echo $_SESSION['nombre']; ?></h2>
    ../controllers/logout.php">Salir</a>
</div>

<div class="container">

    <h3>Menú del día: <?php echo $dia; ?></h3>

    <div>
        ?dia=Lunes">Lunes</a>
        ?dia=Martes">Martes</a>
        ?dia=Miercoles">Miércoles</a>
        ?dia=Jueves">Jueves</a>
        ?dia=Viernes">Viernes</a>
    </div>

    <hr>

    <div class="grid">

    <?php
    $sql = "SELECT * FROM platos WHERE dia='$dia' AND disponible=1";
    $result = $conn->query($sql);

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
