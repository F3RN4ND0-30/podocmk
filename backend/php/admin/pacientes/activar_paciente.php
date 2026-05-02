<?php
include("../../../db/conexion.php");

$id = $_GET['id'];

$stmt = $conn->prepare("UPDATE pacientes SET Estado = 1 WHERE IdPaciente = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();

header("Location: ../../../../frontend/admin/pacientes_inactivos.php");
exit();
