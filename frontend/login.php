<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CMK</title>
    <link rel="stylesheet" href="../backend/css/login/login.css">
</head>

<body>

    <?php if (isset($_GET['error'])): ?>
        <p style="color:red;">
            <?php
            if ($_GET['error'] == 1) echo "Contraseña incorrecta";
            if ($_GET['error'] == 2) echo "Usuario no existe o está inactivo";
            ?>
        </p>
    <?php endif; ?>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        <form action="../backend/php/login/login.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
            <a href="../index.php" class="btn-volver">volver al inicio</a>
        </form>
    </div>

</body>

</html>