const checkbox = document.getElementById("checkbox");
function cambiarTema() {
  if (checkbox.checked) {
    document.body.classList.add("dark-theme"); 
  } else {
    document.body.classList.remove("dark-theme"); 
  }
}
checkbox.addEventListener("change", cambiarTema);

cambiarTema();

