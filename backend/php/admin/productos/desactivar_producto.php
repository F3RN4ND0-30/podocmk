<?php
include("../../../db/conexion.php");

$id = $_GET['id'];

$stmt = $conn->prepare("
    UPDATE productos 
    SET Estado = 0 
    WHERE IdProducto = :id
");

$stmt->bindParam(":id", $id);
$stmt->execute();

header("Location: ../../../../frontend/admin/productos.php");
exit();
