<?php
session_start();

if (isset($_SESSION['rol'])) {

    if ($_SESSION['rol'] == 'admin') {
        header("Location: views/admin.php");
    } else {
        header("Location: views/usuario.php");
    }

} else {
    header("Location: views/login.php");
}
?>