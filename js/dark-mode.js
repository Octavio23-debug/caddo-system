document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.getElementById("toggleDarkMode");
    const isDarkMode = localStorage.getItem("darkMode") === "true";

    // Aplicar el modo oscuro si estaba activado
    if (isDarkMode) {
        document.body.classList.add("dark-mode");
        toggleButton.textContent = "Modo Claro";
    }

    // Alternar modo oscuro al hacer clic en el botón
    toggleButton.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");
        const isDark = document.body.classList.contains("dark-mode");

        // Guardar en localStorage
        localStorage.setItem("darkMode", isDark);
        toggleButton.textContent = isDark ? "Modo Claro" : "Modo Oscuro";
    });
});
