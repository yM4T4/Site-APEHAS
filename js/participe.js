document.addEventListener('DOMContentLoaded', function() {
    
    // Animação de Scroll (Fade-in)

    // Seleciona todos os elementos que devem ser animados
    const sectionsToAnimate = document.querySelectorAll('.hidden-section');

    // Configura o "observador"
    const observer = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible-section');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1 
    });

    // Diz ao observador para "observar" cada uma das nossas seções
    sectionsToAnimate.forEach(section => {
        observer.observe(section);
    });

    
    // Atualiza o ano no rodapé
    const currentYearSpan = document.getElementById('currentYear');
    if (currentYearSpan) {
        currentYearSpan.textContent = new Date().getFullYear();
    }

});