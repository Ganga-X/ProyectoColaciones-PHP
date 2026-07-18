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

/* ===========================
   BODY
=========================== */

body{
    height:100vh;
    display:flex;
    flex-direction:column;
    margin:0;
    background:#f4f6f9;
    font-family:Arial, Helvetica, sans-serif;
}


/* ===========================
   HEADER
=========================== */

.header{

    background:#2c3e50;
    color:white;

    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:15px 20px;

    position:sticky;
    top:0;
    z-index:1000;
}

.header-left{

    display:flex;
    align-items:center;
    gap:15px;
}

.header-right{

    display:flex;
    align-items:center;
}


/* ===========================
   BOTÓN HAMBURGUESA
=========================== */

.menu-btn{

    background:none;
    border:none;

    color:white;

    font-size:28px;

    cursor:pointer;

    padding:0;

    margin:0;
}

.menu-btn:hover{

    opacity:.8;
}


/* ===========================
   SIDEBAR
=========================== */

.sidebar{

    position:fixed;

    top:0;
    left:-280px;

    width:280px;
    height:100%;

    background:#34495e;

    transition:.3s;

    z-index:2000;

    box-shadow:4px 0 10px rgba(0,0,0,.25);

    overflow-y:auto;
}

.sidebar.active{

    left:0;
}


/* ===========================
   CABECERA SIDEBAR
=========================== */

.sidebar-header{

    padding:20px;

    background:#2c3e50;

    color:white;

    font-size:22px;

    font-weight:bold;
}


/* ===========================
   MENÚ
=========================== */

.sidebar ul{

    list-style:none;

    padding:0;

    margin:0;
}

.sidebar ul li{

    border-bottom:1px solid rgba(255,255,255,.08);
}

.sidebar ul li a{

    display:block;

    color:white;

    text-decoration:none;

    padding:16px 22px;

    transition:.25s;
}

.sidebar ul li a:hover{

    background:#3d566e;
}


/* ===========================
   SUBMENÚ
=========================== */

.submenu{

    background:#415b76;

    display:none;
}

.submenu a{

    padding-left:45px !important;

    font-size:15px;
}

.submenu.active{

    display:block;
}


/* ===========================
   OVERLAY
=========================== */

.overlay{

    position:fixed;

    inset:0;

    background:rgba(0,0,0,.45);

    display:none;

    z-index:1500;
}

.overlay.active{

    display:block;
}


/* ===========================
   CONTENEDOR
=========================== */

.container{

    flex:1;

    display:flex;

    flex-direction:column;

    justify-content:center;

    align-items:center;

    padding:30px;
}


/* ===========================
   FORMULARIO
=========================== */

.form-admin{

    width:100%;

    max-width:650px;
}


/* ===========================
   INPUTS
=========================== */

.form-admin input,
.form-admin select,
.form-admin button{

    width:100%;

    padding:22px;

    margin-bottom:40px;

    border-radius:12px;

    border:1px solid #ccc;

    font-size:18px;
}


/* ===========================
   TÍTULO
=========================== */

.form-admin h3{

    text-align:center;

    margin-bottom:50px;

    font-size:26px;
}


/* ===========================
   BOTONES
=========================== */

.form-admin button{

    background:#3498db;

    color:white;

    border:none;

    cursor:pointer;
}

.form-admin button:hover{

    background:#2980b9;
}

</style>

<script>

function toggleMenu() {

    var menu = document.getElementById("menuHamburguesa");

    if(menu.style.left == "0px"){
        menu.style.left = "-260px";
    }else{
        menu.style.left = "0px";
    }

}

function toggleSubmenu(){

    var sub = document.getElementById("submenuMovimientos");

    if(sub.style.display == "block"){
        sub.style.display = "none";
    }else{
        sub.style.display = "block";
    }

}

</script>

</head>

<body>

<!-- ========================= -->
<!-- MENÚ HAMBURGUESA -->
<!-- ========================= -->

<div id="menuHamburguesa" class="menu-lateral">

    <h2>Menú</h2>

    <button class="menu-btn" onclick="toggleSubmenu()">
        Movimientos ▼
    </button>

    <div id="submenuMovimientos" class="submenu">

        <a href="movimientos.php">
            <button class="submenu-btn">
                Ver Movimientos
            </button>
        </a>

        <a href="ventas.php">
            <button class="submenu-btn">
                Ver Ventas
            </button>
        </a>

    </div>

</div>

<!-- ========================= -->
<!-- HEADER -->
<!-- ========================= -->

<div class="header">

    <div style="display:flex; align-items:center; gap:15px;">

        <button class="hamburguesa" onclick="toggleMenu()">
            ☰
        </button>

        <h3 style="margin:0;">
            Panel Admin
        </h3>

    </div>

    <a href="../controllers/logout.php"
       style="color:white;text-decoration:none;font-weight:bold;">
        Salir
    </a>

</div>

<div class="container">

<!-- BOTÓN VER PEDIDOS -->

<a href="verPedidos.php">

    <button class="btn-ver">
        Ver Pedidos
    </button>

</a>

<!-- ========================= -->
<!-- FORMULARIO -->
<!-- ========================= -->

<form class="form-admin"
action="../controllers/platoController.php"
method="POST"
enctype="multipart/form-data">

    <h3>Agregar Plato</h3>

    <input
        type="text"
        name="nombre"
        placeholder="Nombre"
        required
    >

    <input
        type="text"
        name="descripcion"
        placeholder="Descripción"
        required
    >

    <input
        type="number"
        name="precio"
        placeholder="Precio"
        required
    >

    <select name="dia">

        <option value="Lunes">
            Lunes
        </option>

        <option value="Martes">
            Martes
        </option>

        <option value="Miercoles">
            Miércoles
        </option>

        <option value="Jueves">
            Jueves
        </option>

        <option value="Viernes">
            Viernes
        </option>

    </select>

    <input
        type="file"
        name="imagen"
        accept="image/*"
        capture="environment"
    >

    <button type="submit">
        Guardar
    </button>

</form>

<hr>

<!-- ========================= -->
<!-- LISTADO DE PLATOS -->
<!-- ========================= -->

<div class="grid">

<?php

$res = $conn->query("SELECT * FROM platos");

while($row = $res->fetch_assoc()):

?>

<div class="card">

    <img src="../uploads/<?php echo $row['imagen']; ?>">

    <div class="card-content">

        <h4>
            <?php echo $row['nombre']; ?>
        </h4>

        <p>
            <?php echo $row['descripcion']; ?>
        </p>

        <p>
            $<?php echo $row['precio']; ?>
        </p>

        <a href="editarPlato.php?id=<?php echo $row['id']; ?>">

            <button class="btn-edit">
                Editar
            </button>

        </a>

    </div>

</div>

<?php endwhile; ?>

</div>

<hr>

<!-- ========================= -->
<!-- PEDIDOS DE USUARIOS -->
<!-- ========================= -->

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

        <h4>
            <?php echo $pedido['plato']; ?>
        </h4>

        <p>
            <strong>Cliente:</strong>
            <?php echo $pedido['usuario']; ?>
        </p>

        <p>
            <strong>Cantidad:</strong>
            <?php echo $pedido['cantidad']; ?>
        </p>

        <p>
            <strong>Hora:</strong>
            <?php echo $pedido['hora']; ?>
        </p>

        <p>
            <strong>Fecha:</strong>
            <?php echo $pedido['fecha']; ?>
        </p>

    </div>

</div>

<?php endwhile; ?>

</div>

</div>

</body>
</html>