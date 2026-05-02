<?php
include("../../../db/conexion.php");

$id = $_GET['id'];

// obtener paciente
$stmt = $conn->prepare("SELECT Nombres, Apellido_Pat FROM pacientes WHERE IdPaciente = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$paciente = $stmt->fetch(PDO::FETCH_ASSOC);

// obtener historial
$stmt2 = $conn->prepare("SELECT * FROM historial_paciente WHERE IdPaciente = :id");
$stmt2->bindParam(":id", $id);
$stmt2->execute();
$historial = $stmt2->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "paciente" => $paciente['Nombres'] . " " . $paciente['Apellido_Pat'],
    "historial" => $historial
]);
