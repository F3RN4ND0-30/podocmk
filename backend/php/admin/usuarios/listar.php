<?php
header("Content-Type: application/json; charset=utf-8");

// ðŸš« evitar cachÃ© en navegador y hosting
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

include("../../../db/conexion.php");

$stmt = $conn->prepare("SELECT * FROM usuarios");
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($usuarios);
