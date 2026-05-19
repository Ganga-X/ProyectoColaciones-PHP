<?php
session_start();

/* destruir toda la sesión */
session_unset();
session_destroy();

/* redirigir al index principal */
header("Location: ../index.php");
exit();
?>