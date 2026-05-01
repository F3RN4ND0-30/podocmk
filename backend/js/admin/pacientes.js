function abrirModalPaciente() {
  document.getElementById("modalPaciente").style.display = "flex";
}

function cerrarModalPaciente() {
  document.getElementById("modalPaciente").style.display = "none";
}

// cerrar al hacer click fuera del modal
window.onclick = function (event) {
  let modal = document.getElementById("modalPaciente");
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
