/* =========================
   MODALES
========================= */
function abrirModal() {
  document.getElementById("modalUsuario").classList.add("active");
}

function cerrarModal() {
  document.getElementById("modalUsuario").classList.remove("active");
}

function cerrarModalEdit() {
  document.getElementById("modalEditarUsuario").classList.remove("active");
}

/* =========================
   LISTAR USUARIOS
========================= */
function cargarUsuarios() {
  fetch("../../backend/php/admin/usuarios/listar.php")
    .then((res) => res.json())
    .then((data) => {
      let html = "";

      data.forEach((u) => {
        html += `
          <tr>
            <td>${u.Nombres} ${u.Apellido_Pat}</td>
            <td>${u.Usuario}</td>
            <td>
              <span class="${u.Estado == 1 ? "estado-activo" : "estado-inactivo"}">
                ${u.Estado == 1 ? "Activo" : "Inactivo"}
              </span>
            </td>
            <td>
              <button class="btn-accion btn-editar"
                onclick="editar(${u.IdUsuario}, '${u.Nombres}', '${u.Apellido_Pat}', '${u.Apellido_Mat}', '${u.Usuario}')">
                Editar
              </button>

              <button class="btn-accion btn-toggle"
                onclick="toggle(${u.IdUsuario})">
                Activar/Desactivar
              </button>
            </td>
          </tr>
        `;
      });

      document.getElementById("tablaUsuarios").innerHTML = html;
    })
    .catch((err) => console.error("Error listar usuarios:", err));
}

/* =========================
   CREAR USUARIO
========================= */
document
  .getElementById("formCrearUsuario")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    fetch("../../backend/php/admin/usuarios/crear.php", {
      method: "POST",
      body: new FormData(this),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.ok) {
          cerrarModal();
          this.reset();
          cargarUsuarios();
        } else {
          alert("Error al crear usuario");
        }
      })
      .catch((err) => console.error("Error crear:", err));
  });

/* =========================
   EDITAR USUARIO (ABRIR)
========================= */
function editar(id, nombres, ap_pat, ap_mat, usuario) {
  document.getElementById("edit_id").value = id;
  document.getElementById("edit_nombres").value = nombres;
  document.getElementById("edit_ap_pat").value = ap_pat;
  document.getElementById("edit_ap_mat").value = ap_mat;
  document.getElementById("edit_usuario").value = usuario;

  document.getElementById("modalEditarUsuario").classList.add("active");
}

/* =========================
   ACTUALIZAR USUARIO
========================= */
document
  .getElementById("formEditarUsuario")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    fetch("../../backend/php/admin/usuarios/editar.php", {
      method: "POST",
      body: new FormData(this),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.ok) {
          cerrarModalEdit();
          cargarUsuarios();
        } else {
          alert("Error al actualizar usuario");
        }
      })
      .catch((err) => console.error("Error editar:", err));
  });

/* =========================
   ACTIVAR / DESACTIVAR
========================= */
function toggle(id) {
  fetch("../../backend/php/admin/usuarios/toggle.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id }),
  })
    .then((res) => res.json())
    .then((data) => {
      console.log("Toggle response:", data);

      if (data.ok) {
        // opcional: podrías usar data.estado si quieres optimizar UI
        cargarUsuarios();
      } else {
        alert("Error al cambiar estado");
      }
    })
    .catch((err) => console.error("Error toggle:", err));
}

/* =========================
   INIT
========================= */
cargarUsuarios();
