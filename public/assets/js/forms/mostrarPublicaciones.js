document.addEventListener('DOMContentLoaded', function () {
    // Mostrar modal con la noticia completa
    $('.ver-noticia').click(function () {
        var titulo = $(this).data('titulo');
        var descripcion = $(this).data('descripcion');
        var fecha_caducidad = $(this).data('fecha_caducidad');
        var pdf = $(this).data('pdf');

        $('#modalTitulo').text(titulo);
        $('#modalDescripcion').text(descripcion);
        $('#modalFecha_caducidad').text(fecha_caducidad);
        if (pdf) {
            $('#modalPdf').html('<a href="' + pdf + '" target="_blank">Ver PDF</a>');
            $('#modalPdfLink').attr('href', pdf);
            $('#modalPdfLink').show();
        } else {
            $('#modalPdf').empty();
            $('#modalPdfLink').hide();
        }

        $('#modalNoticia').modal('show');
    });

    // Mostrar más noticias
    $('.ver-mas').click(function () {
        var tipo = $(this).data('tipo');
        $('.' + tipo + '.d-none').slice(0, 3).removeClass('d-none');

        if ($('.' + tipo + '.d-none').length === 0) {
            $(this).fadeOut();
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var newsModal = new bootstrap.Modal(document.getElementById('newsModal'));
    newsModal.show();
}); 