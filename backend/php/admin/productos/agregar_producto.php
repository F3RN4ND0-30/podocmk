<?php
include("../../../db/conexion.php");

$nombre = $_POST['nombre'];
$stock = $_POST['stock'];
$descripcion = $_POST['descripcion'];

$img = $_FILES['imagen']['name'];
$tmp = $_FILES['imagen']['tmp_name'];

$nombreFinal = time() . "_" . $img;

move_uploaded_file($tmp, "../../../uploads/productos/" . $nombreFinal);

$stmt = $conn->prepare("
INSERT INTO productos (Nombre, Stock, Descripcion, Imagen, Estado)
VALUES (:n, :s, :d, :i, 1)
");

$stmt->bindParam(":n", $nombre);
$stmt->bindParam(":s", $stock);
$stmt->bindParam(":d", $descripcion);
$stmt->bindParam(":i", $nombreFinal);

$stmt->execute();

header("Location: ../../../../frontend/admin/productos.php");
exit();
