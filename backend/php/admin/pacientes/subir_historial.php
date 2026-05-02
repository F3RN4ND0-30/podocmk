<?php
include("../../../db/conexion.php");

$id = $_POST['id_paciente'];

$img = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

$fechaSesion = date("Y-m-d");

$carpeta = "../../../uploads/pacientes/";

$nombreFinal = time() . "_" . $img;

move_uploaded_file($tmp, $carpeta . $nombreFinal);

$stmt = $conn->prepare("INSERT INTO historial_paciente (IdPaciente, Foto, Fecha, FechaSesion)
VALUES (:id, :foto, NOW(), :fechaSesion)");

$stmt->bindParam(":id", $id);
$stmt->bindParam(":foto", $nombreFinal);
$stmt->bindParam(":fechaSesion", $fechaSesion);

$stmt->execute();

echo json_encode(["ok" => true]);
