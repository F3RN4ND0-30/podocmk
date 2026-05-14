<?php
include("../../../db/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $ap_pat = $_POST['ap_pat'];
    $ap_mat = $_POST['ap_mat'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'] ?? ""; // puede venir vacío

    try {

        // CASO 1: SI SE CAMBIA CONTRASEÑA
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
        }
        // CASO 2: SIN CAMBIAR CONTRASEÑA
        else {

            $sql = "UPDATE usuarios SET 
                Nombres = :nombres,
                Apellido_Pat = :ap_pat,
                Apellido_Mat = :ap_mat,
                Usuario = :usuario
                WHERE IdUsuario = :id";

            $stmt = $conn->prepare($sql);
        }

        // BIND COMUNES
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nombres", $nombres);
        $stmt->bindParam(":ap_pat", $ap_pat);
        $stmt->bindParam(":ap_mat", $ap_mat);
        $stmt->bindParam(":usuario", $usuario);

        // EJECUTAR
        if ($stmt->execute()) {
            echo "ok";
        } else {
            echo "error";
        }
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}
