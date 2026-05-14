let pacienteActualId = null;

/* =========================
   MODAL AGREGAR PACIENTE
========================= */
function abrirModalPaciente() {
  document.getElementById("modalPaciente").style.display = "flex";
  document.getElementById("formPaciente").reset();
}

function cerrarModalPaciente() {
  document.getElementById("modalPaciente").style.display = "none";
  document.getElementById("formPaciente").reset();
}

/* cerrar al hacer click fuera */
window.onclick = function (event) {
  let modalAgregar = document.getElementById("modalPaciente");
  let modalEditar = document.getElementById("modalEditarPaciente");
  let modalHistorial = document.getElementById("modalHistorial");

  if (event.target == modalAgregar) {
    modalAgregar.style.display = "none";
  }

  if (event.target == modalEditar) {
    modalEditar.style.display = "none";
  }

  if (event.target == modalHistorial) {
    modalHistorial.style.display = "none";
  }
};

/* =========================
   EDITAR PACIENTE
========================= */
function abrirEditar(id, nombre, ap, am, tel) {
  document.getElementById("modalEditarPaciente").style.display = "flex";

  document.getElementById("edit_id").value = id;
  document.getElementById("edit_nombre").value = nombre;
  document.getElementById("edit_apellido_pat").value = ap;
  document.getElementById("edit_apellido_mat").value = am;
  document.getElementById("edit_telefono").value = tel;
}

function cerrarModalEditar() {
  document.getElementById("modalEditarPaciente").style.display = "none";
}

/* =========================
   DESACTIVAR / ACTIVAR
========================= */
function desactivarPaciente(id) {
  if (confirm("¿Seguro que quieres desactivar este paciente?")) {
    window.location.href =
      "../../backend/php/admin/pacientes/desactivar_paciente.php?id=" + id;
  }
}

function activarPaciente(id) {
  if (confirm("¿Activar este paciente?")) {
    window.location.href =
      "../../backend/php/admin/pacientes/activar_paciente.php?id=" + id;
  }
}

/* =========================
   HISTORIAL PACIENTE
========================= */
function abrirHistorial(id) {
  pacienteActualId = id;

  fetch("../../backend/php/admin/pacientes/obtener_historial.php?id=" + id)
    .then((res) => res.json())
    .then((data) => {
      document.getElementById("modalHistorial").style.display = "flex";

      document.getElementById("tituloPaciente").innerText =
        "Paciente: " + data.paciente;

      let html = "";

      // validar si hay datos
      if (!data.historial || Object.keys(data.historial).length === 0) {
        html = "<p>No hay sesiones registradas</p>";
      } else {
        Object.keys(data.historial).forEach((fecha) => {
          html += `<h4>📅 ${fecha}</h4>`;

          data.historial[fecha].forEach((item, index) => {
            html += `
              <div class="sesion">
                <p>Foto ${index + 1}</p>
                <img src="../../backend/uploads/pacientes/${item.Foto}?v=${Date.now()}" />
              </div>
            `;
          });
        });
      }

      document.getElementById("contenidoHistorial").innerHTML = html;
    });
}

function cerrarHistorial() {
  document.getElementById("modalHistorial").style.display = "none";
}

/* =========================
   SUBIR FOTO (CÁMARA / GALERÍA)
========================= */
document.addEventListener("DOMContentLoaded", function () {
  const inputFoto = document.getElementById("inputFoto");

  if (inputFoto) {
    inputFoto.addEventListener("change", function () {
      let file = this.files[0];

      if (!file) return;

      let formData = new FormData();
      formData.append("foto", file);
      formData.append("id_paciente", pacienteActualId);

      fetch("../../backend/php/admin/pacientes/subir_historial.php", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then(() => {
          alert("Foto subida correctamente");
          abrirHistorial(pacienteActualId); // recarga historial
        });
    });
  }
});
