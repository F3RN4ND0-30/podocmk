<?php
include("../../../db/conexion.php");

header('Content-Type: application/json');

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["error" => "ID no válido"]);
    exit;
}

/* =========================
   PACIENTE
========================= */
$stmt = $conn->prepare("
    SELECT Nombres, Apellido_Pat 
    FROM pacientes 
    WHERE IdPaciente = :id
");

$stmt->bindParam(":id", $id);
$stmt->execute();

$paciente = $stmt->fetch(PDO::FETCH_ASSOC);

/* =========================
   HISTORIAL (POR FECHA)
========================= */
$stmt2 = $conn->prepare("
    SELECT Foto, FechaSesion 
    FROM historial_paciente 
    WHERE IdPaciente = :id
    ORDER BY FechaSesion DESC, IdHistorial ASC
");

$stmt2->bindParam(":id", $id);
$stmt2->execute();

$historial = $stmt2->fetchAll(PDO::FETCH_ASSOC);

/* =========================
   AGRUPAR POR DÍA
========================= */
$agrupado = [];

foreach ($historial as $item) {

    $fecha = $item['FechaSesion'];

    if (!isset($agrupado[$fecha])) {
        $agrupado[$fecha] = [];
    }

    $agrupado[$fecha][] = $item;
}

/* =========================
   RESPUESTA FINAL
========================= */
echo json_encode([
    "paciente" => $paciente['Nombres'] . " " . $paciente['Apellido_Pat'],
    "historial" => $agrupado
]);
