/* =========================
   MODAL AGREGAR PRODUCTO
========================= */
function abrirModalProducto() {
  document.getElementById("modalProducto").style.display = "flex";
}

function cerrarModalProducto() {
  document.getElementById("modalProducto").style.display = "none";
}

/* =========================
   MODAL EDITAR PRODUCTO
========================= */
function abrirEditarProducto(id, nombre, stock, descripcion, imagen) {
  const modal = document.getElementById("modalEditarProducto");
  modal.style.display = "flex";

  document.getElementById("edit_id_producto").value = id;
  document.getElementById("edit_nombre_producto").value = nombre;
  document.getElementById("edit_stock_producto").value = stock;
  document.getElementById("edit_descripcion_producto").value = descripcion;

  // imagen actual
  document.getElementById("preview_img").src =
    "../../backend/uploads/productos/" + imagen;
}

function cerrarModalEditarProducto() {
  document.getElementById("modalEditarProducto").style.display = "none";
}

/* =========================
   CERRAR MODALES AL HACER CLICK FUERA
========================= */
window.addEventListener("click", function (event) {
  const modalProducto = document.getElementById("modalProducto");
  const modalEditarProducto = document.getElementById("modalEditarProducto");

  if (event.target === modalProducto) {
    modalProducto.style.display = "none";
  }

  if (event.target === modalEditarProducto) {
    modalEditarProducto.style.display = "none";
  }
});

/* =========================
   DESACTIVAR PRODUCTO
========================= */
function desactivarProducto(id) {
  if (confirm("¿Seguro que quieres desactivar este producto?")) {
    window.location.href =
      "../../backend/php/admin/productos/desactivar_producto.php?id=" + id;
  }
}

/* =========================
   ACTIVAR PRODUCTO
========================= */
function activarProducto(id) {
  if (confirm("¿Activar este producto nuevamente?")) {
    window.location.href =
      "../../backend/php/admin/productos/activar_producto.php?id=" + id;
  }
}

/* =========================
   DEBUG (opcional)
========================= */
console.log("productos.js cargado correctamente");
