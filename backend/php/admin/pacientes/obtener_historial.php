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

$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$paciente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$paciente) {
    echo json_encode(["error" => "Paciente no encontrado"]);
    exit;
}

/* =========================
   HISTORIAL
========================= */
$stmt2 = $conn->prepare("
    SELECT IdHistorial, Foto, FechaSesion
    FROM historial_paciente
    WHERE IdPaciente = :id
    ORDER BY FechaSesion DESC, IdHistorial DESC
");

$stmt2->bindParam(":id", $id, PDO::PARAM_INT);
$stmt2->execute();

$historial = $stmt2->fetchAll(PDO::FETCH_ASSOC);

/* =========================
   AGRUPAR POR FECHA
========================= */
$agrupado = [];

foreach ($historial as $item) {

    // normalizar fecha (por si viene DATETIME)
    $fecha = date("Y-m-d", strtotime($item['FechaSesion']));

    if (!isset($agrupado[$fecha])) {
        $agrupado[$fecha] = [];
    }

    $agrupado[$fecha][] = [
        "Foto" => $item['Foto'],
        "FechaSesion" => $fecha
    ];
}

/* =========================
   RESPUESTA FINAL
========================= */
echo json_encode([
    "paciente" => $paciente['Nombres'] . " " . $paciente['Apellido_Pat'],
    "historial" => $agrupado
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
