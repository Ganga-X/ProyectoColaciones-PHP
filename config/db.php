<?php

$conn = new mysqli("localhost", "root", "", "colaciones", 3307);

/* verificar conexión */
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>
