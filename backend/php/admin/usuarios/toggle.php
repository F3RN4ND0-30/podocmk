<?php
include("../../../db/conexion.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];

// obtener estado actual
$stmt = $conn->prepare("SELECT Estado FROM usuarios WHERE IdUsuario = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$nuevoEstado = ($user['Estado'] == 1) ? 0 : 1;

$update = $conn->prepare("UPDATE usuarios SET Estado = :estado WHERE IdUsuario = :id");
$update->bindParam(":estado", $nuevoEstado);
$update->bindParam(":id", $id);

if ($update->execute()) {
    echo json_encode(["ok" => true, "estado" => $nuevoEstado]);
}
