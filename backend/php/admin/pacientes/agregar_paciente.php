<?php
include("../../../db/conexion.php");

$nombre = $_POST['nombre'];
$apellido_pat = $_POST['apellido_pat'];
$apellido_mat = $_POST['apellido_mat'];
$telefono = $_POST['telefono'];
$estado = 1;

$stmt = $conn->prepare("INSERT INTO pacientes 
(Nombres, Apellido_Pat, Apellido_Mat, Telefono, Estado)
VALUES (:nombre, :ap, :am, :tel, :estado)");

$stmt->bindParam(":nombre", $nombre);
$stmt->bindParam(":ap", $apellido_pat);
$stmt->bindParam(":am", $apellido_mat);
$stmt->bindParam(":tel", $telefono);
$stmt->bindParam(":estado", $estado);

$stmt->execute();

header("Location: ../../../../frontend/admin/pacientes.php");
exit();
