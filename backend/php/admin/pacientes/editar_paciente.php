<?php
include("../../../db/conexion.php");

$id = $_POST['id_paciente'];
$nombre = $_POST['nombre'];
$apellido_pat = $_POST['apellido_pat'];
$apellido_mat = $_POST['apellido_mat'];
$telefono = $_POST['telefono'];

$stmt = $conn->prepare("UPDATE pacientes SET 
    Nombres = :nombre,
    Apellido_Pat = :ap,
    Apellido_Mat = :am,
    Telefono = :tel
WHERE IdPaciente = :id");

$stmt->bindParam(":nombre", $nombre);
$stmt->bindParam(":ap", $apellido_pat);
$stmt->bindParam(":am", $apellido_mat);
$stmt->bindParam(":tel", $telefono);
$stmt->bindParam(":id", $id);

$stmt->execute();

header("Location: ../../../../frontend/admin/pacientes.php");
exit();
