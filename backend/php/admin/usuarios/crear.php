<?php
include("../../../db/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombres = $_POST['nombres'];
    $ap_pat = $_POST['ap_pat'];
    $ap_mat = $_POST['ap_mat'];
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $hash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios 
    (Nombres, Apellido_Pat, Apellido_Mat, Usuario, Pass, Estado)
    VALUES (:nombres, :ap_pat, :ap_mat, :usuario, :pass, 1)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":nombres", $nombres);
    $stmt->bindParam(":ap_pat", $ap_pat);
    $stmt->bindParam(":ap_mat", $ap_mat);
    $stmt->bindParam(":usuario", $usuario);
    $stmt->bindParam(":pass", $hash);

    if ($stmt->execute()) {
        header("Location: ../../frontend/admin/usuarios.php?ok=1");
    } else {
        echo "Error al crear usuario";
    }
}
