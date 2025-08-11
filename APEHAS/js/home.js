$(document).ready(function(){
    // Inicializa o Carrossel Principal
    $('#hero-carousel').carousel({
        interval: 5000, 
        pause: 'hover' 
    });

    // Inicializa o Carrossel de Depoimentos 
    $('#carouselDepoimentos').carousel({
        interval: 7000, 
        pause: 'hover'
    });

    // Adiciona o ano atual no rodapé
    document.getElementById('currentYear').textContent = new Date().getFullYear();

    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').not('[data-toggle="collapse"]').not('[data-toggle="tab"]').not('[data-toggle="pill"]').not('.carousel-control-prev').not('.carousel-control-next').click(function(event) {
        if (
            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 70 
                }, 1000, function() {
                    var $target = $(target);
                    $target.focus();
                    if ($target.is(":focus")) {
                        return false;
                    } else {
                        $target.attr('tabindex','-1');
                        $target.focus();
                    };
                });
            }
        }
    });

});