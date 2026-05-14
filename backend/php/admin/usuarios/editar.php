<?php
header("Content-Type: application/json; charset=utf-8");

include("../../../db/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $ap_pat = $_POST['ap_pat'];
    $ap_mat = $_POST['ap_mat'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'] ?? "";

    try {

        if (!empty($password)) {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE usuarios SET 
                Nombres = :nombres,
                Apellido_Pat = :ap_pat,
                Apellido_Mat = :ap_mat,
                Usuario = :usuario,
                Pass = :pass
                WHERE IdUsuario = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":pass", $hash);
        } else {

            $sql = "UPDATE usuarios SET 
                Nombres = :nombres,
                Apellido_Pat = :ap_pat,
                Apellido_Mat = :ap_mat,
                Usuario = :usuario
                WHERE IdUsuario = :id";

            $stmt = $conn->prepare($sql);
        }

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombres", $nombres);
        $stmt->bindParam(":ap_pat", $ap_pat);
        $stmt->bindParam(":ap_mat", $ap_mat);
        $stmt->bindParam(":usuario", $usuario);

        if ($stmt->execute()) {
            echo json_encode([
                "ok" => true
            ]);
        } else {
            echo json_encode([
                "ok" => false
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            "ok" => false,
            "error" => $e->getMessage()
        ]);
    }
}
