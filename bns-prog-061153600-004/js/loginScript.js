const claveInput = document.getElementById("clave");
const claveCheckbox = document.getElementById("censurarClave");

claveCheckbox.addEventListener("change", function () {
    if (claveCheckbox.checked) claveInput.type = "text";
    else claveInput.type = "password";
});