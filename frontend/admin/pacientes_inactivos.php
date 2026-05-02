<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("../../backend/db/conexion.php");

// Traer pacientes activos
$stmt = $conn->prepare("SELECT * FROM pacientes WHERE Estado = 0");
$stmt->execute();

$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pacientes - CMK</title>
    <link rel="stylesheet" href="../../backend/css/admin/pacientes.css">
    <link rel="stylesheet" href="../../backend/css/navbar/navbar.css">
</head>

<body>

    <?php include("../navbar/navbar.php"); ?>

    <div class="pacientes-container">

        <h2>Gestión de Pacientes</h2>

        <div class="grid-pacientes">

            <button class="btn-agregar" onclick="abrirModalPaciente()">
                + Agregar paciente
            </button>

            <?php foreach ($pacientes as $p): ?>

                <div class="card-paciente">

                    <img src="../img/paciente-default.jpg" alt="Paciente">

                    <h3>
                        <?php echo $p['Nombres'] . " " . $p['Apellido_Pat']; ?>
                    </h3>

                    <p><?php echo $p['Telefono']; ?></p>

                    <div class="acciones">

                        <button onclick="activarPaciente(<?php echo $p['IdPaciente']; ?>)">
                            ✅ Activar
                        </button>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <script src="../../backend/js/admin/pacientes.js"></script>
</body>

</html>