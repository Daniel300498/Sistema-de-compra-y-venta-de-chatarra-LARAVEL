var _modalCiudad = $('#nuevaCiudad');
var csrf = $('input[name="_token"]').val();
var adminUrl=url_global;
$.ajaxSetup({
    headers: {'X-CSRF-Token': csrf}
});

function reset() {
    _modalCiudad.find('input').each(function () {
        $(this).val(null)
    })
};
_modalCiudad.on('shown.bs.modal', function () {
    $('#nombre_depto').val($('#depto_id').val());
    $('#nombre_ciudad').trigger('focus')
})

$(document).on('submit', '#storeCiudad', function(event) {
	event.preventDefault();
    var nombre=$('#nombre_ciudad').val();
    var nombre_depto=$('#nombre_depto').val();
    var nombre_provincia=$('#provincia_id').val();
    console.log({ciudad:nombre,provincia:nombre_provincia,depto:nombre_depto});
    $.ajax({
        method: 'POST',
        url: adminUrl + '/ciudad_store',
        data: {ciudad:nombre,provincia:nombre_provincia,depto:nombre_depto},
        dataType: 'JSON',
        success: function (data)
        { 
            reset()
            _modalCiudad.modal('hide')
            //$('#depto_id'),val(nombre_depto);
            $('#ciudad_id').empty();
            var html_select='<option value="">-- SELECCIONE --</option>';
            for(var i=0; i<data.length; ++i){
                html_select+='<option value="'+data[i].id +'"'+ (nombre==data[i].ciudad ? 'selected' : "") +'>(PROVINCIA) '+data[i].provincia+'- (CIUDAD) '+data[i].ciudad+'</option>'
            }
            $('#ciudad_id').html(html_select);
            $("#ciudad_id").trigger("chosen:updated");
            onSelectCiudadChange();
        },
        error: function (data) {
            console.log(data);
        }

    })
});