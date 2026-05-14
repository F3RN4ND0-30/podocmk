<?php
include("../../backend/db/conexion.php");

// Traer productos activos
$stmt = $conn->prepare("SELECT * FROM productos WHERE Estado = 1");
$stmt->execute();

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - CMK</title>
    <link rel="stylesheet" href="../../backend/css/productos/catalogo.css">
    <link rel="stylesheet" href="../../backend/css/navbar/navbar.css">
    <link rel="icon" href="../../backend/img/icono.png" type="image/png">
</head>

<body>

    <nav class="navbar">
        <div class="nav-contenedor">
            <h2 class="logo">CMK</h2>

            <div class="nav-derecha">
                <ul class="nav-links">
                    <li><a href="../../index.php">Inicio</a></li>
                    <li><a href="#">Catálogo</a></li>
                </ul>

                <a href="../../frontend/login.php" class="btn-admin">Administración</a>
            </div>
        </div>
    </nav>

    <div class="catalogo-container">

        <h1>Nuestro Catálogo</h1>

        <div class="grid-catalogo">

            <?php foreach ($productos as $p): ?>

                <div class="card-producto">

                    <img src="../../backend/uploads/productos/<?php echo $p['Imagen']; ?>" alt="producto">

                    <div class="contenido">

                        <h3><?php echo $p['Nombre']; ?></h3>

                        <p>
                            <?php echo $p['Descripcion']; ?>
                        </p>

                        <?php if ($p['Stock'] > 0): ?>

                            <span class="stock disponible">
                                Disponible
                            </span>

                        <?php else: ?>

                            <span class="stock agotado">
                                Agotado
                            </span>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</body>

</html>