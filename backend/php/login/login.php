<?php
session_start();
include("../../db/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try {

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE Usuario = :usuario AND Estado = 1");
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            // Verifica contraseña con hash
            if (password_verify($password, $user['Pass'])) {

                $_SESSION['usuario'] = $user['Usuario'];
                $_SESSION['nombre'] = $user['Nombres'];

                header("Location: ../../../frontend/admin/dashboard.php");
                exit();
            } else {
                header("Location: ../../../frontend/login.php?error=1");
                exit();
            }
        } else {
            header("Location: ../../../frontend/login.php?error=2");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
