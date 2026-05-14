<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar-admin">
    <div class="nav-admin-contenedor">

        <div class="logo-admin">
            CMK Admin
        </div>

        <ul class="nav-admin-links">

            <li><a href="dashboard.php">Inicio</a></li>

            <li><a href="pacientes.php">Pacientes</a></li>

            <?php if ($_SESSION['id'] == '1'): ?>
                <li><a href="pacientes_inactivos.php">Acti-Pacientes</a></li>
            <?php endif; ?>

            <li><a href="productos.php">Productos</a></li>

            <?php if ($_SESSION['id'] == '1'): ?>
                <li><a href="productos_inactivos.php">Acti-Productos</a></li>
            <?php endif; ?>

            <?php if ($_SESSION['id'] == '1'): ?>
                <li><a href="usuarios.php">Usuarios</a></li>
            <?php endif; ?>

        </ul>

        <a href="../logout.php" class="btn-logout">Cerrar sesión</a>

    </div>
</nav>