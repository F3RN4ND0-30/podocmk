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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes - CMK</title>
    <link rel="stylesheet" href="../../backend/css/admin/pacientes.css">
    <link rel="stylesheet" href="../../backend/css/navbar/navbar.css">

    <link rel="icon" href="../../backend/img/icono.png" type="image/png">
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

                    <img src="../../backend/img/paciente_default.png" alt="Paciente">

                    <h3>
                        <?php echo $p['Nombres'] . " " . $p['Apellido_Pat']; ?>
                    </h3>

                    <p><?php echo $p['Telefono']; ?></p>

                    <div class="acciones">

                        <button onclick="abrirEditar(
                            <?php echo $p['IdPaciente']; ?>,
                            '<?php echo $p['Nombres']; ?>',
                            '<?php echo $p['Apellido_Pat']; ?>',
                            '<?php echo $p['Apellido_Mat']; ?>',
                            '<?php echo $p['Telefono']; ?>'
                        )">
                            ✏️ Editar
                        </button>

                        <button onclick="abrirHistorial(<?php echo $p['IdPaciente']; ?>)">
                            📄 Historial
                        </button>

                        <button onclick="desactivarPaciente(<?php echo $p['IdPaciente']; ?>)">
                            ❌ Desactivar
                        </button>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <div id="modalPaciente" class="modal">

        <div class="modal-contenido">

            <h3>Registrar Paciente</h3>

            <form id="formPaciente" action="../../backend/php/admin/pacientes/agregar_paciente.php" method="POST">

                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellido_pat" placeholder="Apellido Paterno" required>
                <input type="text" name="apellido_mat" placeholder="Apellido Materno" required>
                <input type="text" name="telefono" placeholder="Teléfono" required>

                <button type="submit">Guardar</button>
                <button type="button" onclick="cerrarModalPaciente()">Cancelar</button>
            </form>
        </div>
    </div>

    <div id="modalEditarPaciente" class="modal">

        <div class="modal-contenido">

            <h3>Editar Paciente</h3>

            <form action="../../backend/php/admin/pacientes/editar_paciente.php" method="POST">

                <input type="hidden" name="id_paciente" id="edit_id">

                <input type="text" name="nombre" id="edit_nombre" required>
                <input type="text" name="apellido_pat" id="edit_apellido_pat" required>
                <input type="text" name="apellido_mat" id="edit_apellido_mat" required>
                <input type="text" name="telefono" id="edit_telefono" required>

                <button type="submit">Actualizar</button>
                <button type="button" onclick="cerrarModalEditar()">Cancelar</button>

            </form>
        </div>
    </div>

    <div id="modalHistorial" class="modal">

        <div class="modal-contenido modal-historial">

            <h3 id="tituloPaciente">Historial</h3>

            <button onclick="document.getElementById('inputFoto').click()">
                + Subir foto / Tomar foto
            </button>

            <input
                type="file"
                id="inputFoto"
                accept="image/*"
                capture="environment"
                style="display:none">

            <div id="contenidoHistorial">
                <!-- Aquí se cargan las sesiones -->
            </div>

            <button onclick="cerrarHistorial()">Cerrar</button>

        </div>
    </div>

    <script src="../../backend/js/admin/pacientes.js"></script>
    <script>
        document.addEventListener("input", function(e) {
            if (e.target.tagName === "INPUT" || e.target.tagName === "TEXTAREA") {
                e.target.value = e.target.value.toUpperCase();
            }
        });
    </script>
</body>

</html>