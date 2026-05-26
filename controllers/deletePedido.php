<?php
require_once "../config/db.php";

$id = $_POST['id'];

$conn->query("DELETE FROM pedidos WHERE id=$id");

header("Location: ../views/misPedidos.php");