// js/Cursos.js

document.addEventListener('DOMContentLoaded', function() {
    // Código JavaScript para a página "Cursos" pode ser adicionado aqui no futuro.
    
    // Atualiza o ano no rodapé
    const currentYearSpan = document.getElementById('currentYear');
    if (currentYearSpan) {
        currentYearSpan.textContent = new Date().getFullYear();
    }
});