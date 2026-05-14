<?php
session_start();

// Protección: solo usuarios logueados
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$nombre = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - CMK</title>
    <link rel="stylesheet" href="../../backend/css/admin/dashboard.css">
    <link rel="stylesheet" href="../../backend/css/navbar/navbar.css">

    <link rel="icon" href="../../backend/img/icono.png" type="image/png">
</head>

<body>

    <?php include("../navbar/navbar.php"); ?>

    <div class="dashboard-container">

        <h1>Bienvenida, <?php echo $nombre; ?> 👋</h1>

        <p class="subtitulo">
            ¿Qué haremos el día de hoy?
        </p>

        <div class="gif-container">
            <img src="../../backend/img/chicharrita.png" alt="Pie animado">
        </div>

    </div>

</body>

</html>