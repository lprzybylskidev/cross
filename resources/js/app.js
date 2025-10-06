import "./bootstrap";
import "@tabler/core/dist/js/tabler.js";

document.addEventListener("DOMContentLoaded", () => {
    const tiggers = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tiggers.forEach((el) => new window.bootstrap.Tooltip(el));
});
