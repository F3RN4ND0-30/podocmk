<?php
include("conexion.php");

try {
    // Si llega aquí, la conexión funciona
    echo "✅ Conexión exitosa a la base de datos";
} catch (Exception $e) {
    echo "❌ Error en la conexión: " . $e->getMessage();
}
