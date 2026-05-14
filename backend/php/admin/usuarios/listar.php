<?php
include("../../../db/conexion.php");

$stmt = $conn->prepare("SELECT * FROM usuarios");
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($usuarios);
