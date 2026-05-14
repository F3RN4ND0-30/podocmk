<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("../../backend/db/conexion.php");

// Traer productos activos
$stmt = $conn->prepare("SELECT * FROM productos WHERE Estado = 1");
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

                        <button onclick='abrirEditarProducto(
        <?php echo $p["IdProducto"]; ?>,
        <?php echo json_encode($p["Nombre"]); ?>,
        <?php echo $p["Stock"]; ?>,
        <?php echo json_encode($p["Descripcion"]); ?>,
        <?php echo json_encode($p["Imagen"]); ?>
    )'>
                            ✏️
                        </button>

                        <button onclick="desactivarProducto(<?php echo $p['IdProducto']; ?>)">
                            ❌
                        </button>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>
    </div>

    <div id="modalProducto" class="modal">

        <div class="modal-contenido">

            <h3>Agregar Producto</h3>

            <form action="../../backend/php/admin/productos/agregar_producto.php"
                method="POST"
                enctype="multipart/form-data">

                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="number" name="stock" placeholder="Stock" required>
                <textarea name="descripcion" placeholder="Descripción"></textarea>

                <input type="file" name="imagen" accept="image/*">

                <button type="submit">Guardar</button>
                <button type="button" onclick="cerrarModalProducto()">Cancelar</button>

            </form>

        </div>
    </div>

    <div id="modalEditarProducto" class="modal">

        <div class="modal-contenido">

            <h3>Editar Producto</h3>

            <form action="../../backend/php/admin/productos/editar_producto.php"
                method="POST"
                enctype="multipart/form-data">

                <input type="hidden" name="id_producto" id="edit_id_producto">

                <input type="text" name="nombre" id="edit_nombre_producto" placeholder="Nombre" required>

                <input type="number" name="stock" id="edit_stock_producto" placeholder="Stock" required>

                <textarea name="descripcion" id="edit_descripcion_producto" placeholder="Descripción"></textarea>

                <p>Imagen actual:</p>
                <img id="preview_img" style="width:100%; border-radius:10px; margin-bottom:10px;">

                <input type="file" name="imagen" accept="image/*">

                <button type="submit">Actualizar</button>
                <button type="button" onclick="cerrarModalEditarProducto()">Cancelar</button>

            </form>

        </div>

    </div>

    <script src="../../backend/js/admin/productos.js"></script>
</body>

</html>