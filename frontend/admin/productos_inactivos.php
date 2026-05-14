<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("../../backend/db/conexion.php");

// Traer productos activos
$stmt = $conn->prepare("SELECT * FROM productos WHERE Estado = 0");
$stmt->execute();

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - CMK</title>
    <link rel="stylesheet" href="../../backend/css/admin/productos.css">
    <link rel="stylesheet" href="../../backend/css/navbar/navbar.css">
    
    <link rel="icon" href="../../backend/img/icono.png" type="image/png">
</head>

<body>
    <?php include("../navbar/navbar.php"); ?>

    <div class="productos-container">

        <h2>Gestión de Productos</h2>

        <div class="grid-productos">

            <div class="card-agregar" onclick="abrirModalProducto()">
                <span>＋</span>
                <p>Agregar producto</p>
            </div>

            <?php foreach ($productos as $p): ?>

                <div class="card-producto">

                    <img src="../../backend/uploads/productos/<?php echo $p['Imagen']; ?>" alt="producto">

                    <h3><?php echo $p['Nombre']; ?></h3>

                    <p><?php echo $p['Descripcion']; ?></p>

                    <p><b>Stock:</b> <?php echo $p['Stock']; ?></p>

                    <div class="acciones">

                        <button style="background: #2ecc71;" onclick="activarProducto(<?php echo $p['IdProducto']; ?>)">
                            🔁 Activar
                        </button>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>
    </div>

    <script src="../../backend/js/admin/productos.js"></script>
</body>

</html>