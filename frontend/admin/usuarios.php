<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("../../backend/db/conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - CMK</title>
    <link rel="stylesheet" href="../../backend/css/admin/usuarios.css">
    <link rel="stylesheet" href="../../backend/css/navbar/navbar.css">

    <link rel="icon" href="../../backend/img/icono.png" type="image/png">
</head>

<body>

    <?php include("../navbar/navbar.php"); ?>

    <div class="usuarios-container">

        <h2>Gestor de Usuarios</h2>

        <button class="btn-nuevo-usuario" onclick="abrirModal()">+ Nuevo Usuario</button>

        <!-- TABLA -->
        <table class="tabla-usuarios">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody id="tablaUsuarios">
                <!-- JS -->
            </tbody>
        </table>

    </div>

    <div class="modal" id="modalUsuario">
        <div class="modal-contenido">

            <h3>Nuevo Usuario</h3>

            <form id="formCrearUsuario">
                <input name="nombres" placeholder="Nombres" required>
                <input name="ap_pat" placeholder="Apellido Paterno" required>
                <input name="ap_mat" placeholder="Apellido Materno" required>
                <input name="usuario" placeholder="Usuario" required>
                <input name="password" type="password" placeholder="Contraseña" required>

                <button type="submit">Guardar</button>
                <button type="button" onclick="cerrarModal()">Cancelar</button>
            </form>

        </div>
    </div>

    <div class="modal" id="modalEditarUsuario">
        <div class="modal-contenido">

            <h3>Editar Usuario</h3>

            <form id="formEditarUsuario">
                <input type="hidden" name="id" id="edit_id">

                <input name="nombres" id="edit_nombres" placeholder="Nombres">
                <input name="ap_pat" id="edit_ap_pat" placeholder="Apellido Paterno">
                <input name="ap_mat" id="edit_ap_mat" placeholder="Apellido Materno">
                <input name="usuario" id="edit_usuario" placeholder="Usuario">
                <input type="password" name="password" placeholder="Nueva contraseña (dejar vacío si no cambia)">

                <button type="submit">Actualizar</button>
                <button type="button" onclick="cerrarModalEdit()">Cancelar</button>
            </form>

        </div>
    </div>

    <script src="../../backend/js/admin/usuarios.js"></script>
</body>

</html>