<?php
include("../../../db/conexion.php");

$id = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$stock = $_POST['stock'];
$descripcion = $_POST['descripcion'];

/* =========================
   SI SUBE NUEVA IMAGEN
========================= */
if (!empty($_FILES['imagen']['name'])) {

    $img = $_FILES['imagen']['name'];
    $tmp = $_FILES['imagen']['tmp_name'];

    $nombreFinal = time() . "_" . $img;

    move_uploaded_file($tmp, "../../../img/productos/" . $nombreFinal);

    $stmt = $conn->prepare("
        UPDATE productos 
        SET Nombre = :n,
            Stock = :s,
            Descripcion = :d,
            Imagen = :i
        WHERE IdProducto = :id
    ");

    $stmt->bindParam(":i", $nombreFinal);
} else {

    $stmt = $conn->prepare("
        UPDATE productos 
        SET Nombre = :n,
            Stock = :s,
            Descripcion = :d
        WHERE IdProducto = :id
    ");
}

$stmt->bindParam(":n", $nombre);
$stmt->bindParam(":s", $stock);
$stmt->bindParam(":d", $descripcion);
$stmt->bindParam(":id", $id);

$stmt->execute();

header("Location: ../../../../frontend/admin/productos.php");
exit();
