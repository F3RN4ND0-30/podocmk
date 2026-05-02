<?php
include("../../../db/conexion.php");

$id = $_POST['id_paciente'];

$img = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

$carpeta = "../../../uploads/";

$nombreFinal = time() . "_" . $img;

move_uploaded_file($tmp, $carpeta . $nombreFinal);

$stmt = $conn->prepare("INSERT INTO historial_paciente (IdPaciente, Foto, Fecha)
VALUES (:id, :foto, NOW())");

$stmt->bindParam(":id", $id);
$stmt->bindParam(":foto", $nombreFinal);

$stmt->execute();

echo json_encode(["ok" => true]);
