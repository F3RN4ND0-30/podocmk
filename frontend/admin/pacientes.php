<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("../../backend/db/conexion.php");

// Traer pacientes activos
$stmt = $conn->prepare("SELECT * FROM pacientes WHERE Estado = 1");
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

                    <select>
                        <option>Acciones</option>
                        <option onclick="abrirEditar(<?php echo $p['IdPaciente']; ?>)">Editar</option>
                        <option onclick="abrirHistorial(<?php echo $p['IdPaciente']; ?>)">Historial</option>
                        <option onclick="desactivarPaciente(<?php echo $p['IdPaciente']; ?>)">Desactivar</option>
                    </select>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <div id="modalPaciente" class="modal">

        <div class="modal-contenido">

            <h3>Registrar Paciente</h3>

            <form action="../../backend/php/admin/pacientes/agregar_paciente.php" method="POST">

                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellido_pat" placeholder="Apellido Paterno" required>
                <input type="text" name="apellido_mat" placeholder="Apellido Materno" required>
                <input type="text" name="telefono" placeholder="Teléfono" required>

                <button type="submit">Guardar</button>
                <button type="button" onclick="cerrarModalPaciente()">Cancelar</button>
            </form>
        </div>
    </div>

    <script src="../../backend/js/admin/pacientes.js"></script>
</body>

</html>