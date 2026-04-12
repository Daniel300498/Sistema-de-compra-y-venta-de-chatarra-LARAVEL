var _modal2 = $('#tipoPub');
var csrf = $('input[name="_token"]').val();
var adminUrl = url_global; // Asegúrate de que url_global esté definida y tenga la URL correcta

$.ajaxSetup({
    headers: {'X-CSRF-Token': csrf}
});

function reset() {
    _modal2.find('input').each(function () {
        $(this).val(null);
    });
}

_modal2.on('shown.bs.modal', function () {
    $('#descripcion2').trigger('focus');
});

$(document).on('submit', '#storeTipo', function(event) {
    event.preventDefault();
    var nombre = $('#descripcion2').val();
    $.ajax({
        method: 'POST',
        url: adminUrl + '/tipo',
        data: { descripcion: nombre },
        dataType: 'JSON',
        success: function(respuesta) {
            reset();
            _modal2.modal('hide');
            var html_select = '<option value="">Seleccionar..</option>';
            for (var i = 0; i < respuesta.length; ++i) {
                html_select += '<option value="' + respuesta[i].id + '"' + (nombre == respuesta[i].descripcion ? ' selected' : '') + '>' + respuesta[i].descripcion + '</option>';
            } 
            $('#tipo').html(html_select); 
            $("#tipo").trigger("chosen:updated");
        },
        error: function(data) {
            console.log(data);
        }
    });
});
