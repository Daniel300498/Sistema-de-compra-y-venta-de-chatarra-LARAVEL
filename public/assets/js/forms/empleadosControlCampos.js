$(document).ready(function () {
    calcularEdad();
    onSelectCiudadChange();
    onSelectDeptoChange();
    obtenerProvincias();
    tipoCargo();
    libretaMilitar();
    onSelectAreaChange();
    $('#ciudad_id').on('change', onSelectCiudadChange);
    $('#area_id').on('change', onSelectAreaChange);
    $('#tipo_cargo').on('change', onSelectAreaChange, tipoCargo);
    $('#fecha_nacimiento').on('change', calcularEdad);
    $("#foto").change(function () { //Cuando el input ccambie (se cargue un nuevo archivo) se va a ejecutar de nuevo el cambio de imagen y se verá reflejado.
        readURL(this);
    });
});

function calcularEdad() {
    var fecha = $('#fecha_nacimiento').val();
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();
    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    $("#campo_edad").val(edad);
}

function libretaMilitar() {
    var sexo = $('#sexo').val();
    if (sexo != 1) {
        $("#nro_libreta_militar").prop('disabled', false);
    }
    else {
        $("#nro_libreta_militar").prop('disabled', true);
    }
}
function onSelectDeptoChange(){
    var depto = $('#depto_id').val();
    var ruta = $('#depto_id').data('ruta');
    var tipo=1;
    if(depto!=''){
        $.get(ruta, { depto: depto,tipo:tipo }, function (data) {
            var valor=$('#ciudad_id').data('old');
            $('#ciudad_id').empty();
            var html_select='<option value="">-- SELECCIONE --</option>';
            for(var i=0; i<data.length; ++i){
                html_select+='<option value="'+data[i].id +'"'+ (valor==data[i].id ? 'selected' : "") +'>(PROVINCIA) '+data[i].provincia+'- (CIUDAD) '+data[i].ciudad+'</option>'
            }
            $('#ciudad_id').html(html_select);
            $("#ciudad_id").trigger("chosen:updated");
        });
    }
}

function obtenerProvincias(){
    var depto = $('#depto_id').val();
    var ruta = $('#depto_id').data('ruta');
    var tipo=2;
    if(depto!=''){
        $.get(ruta, { depto: depto,tipo:tipo }, function (data) {
            var valor=$('#provincia_id').data('old');
            $('#provincia_id').empty();
            var html_select='<option value="">-- SELECCIONE --</option>';
            for(var i=0; i<data.length; ++i){
                html_select+='<option value="'+data[i].provincia +'"'+ (valor==data[i].provincia ? 'selected' : "")+'>' +data[i].provincia+'</option>'
            }
            $('#provincia_id').html(html_select);
            $("#provincia_id").trigger("chosen:updated");
        });
    }
}

function onSelectCiudadChange() {
    var ciudad = $('#ciudad_id').val() != '' ? $('#ciudad_id').val() : $('#ciudad_id').data('old');
    var ruta = $('#ciudad_id').data('ruta');
    if(ciudad!=''){
        $.get(ruta, { id: ciudad }, function (respuesta) {
            $('#provincia').empty();
            $('#provincia').val(respuesta);
        });
    }
};

function onSelectAreaChange() {
    var area = $('#area_id').val() != '' ? $('#area_id').val() : $('#area_id').data('old');
    var tipo = $('#tipo_cargo').val();
    var ruta = $('#area_id').data('ruta');
    var valor= $('#cargo_id').data('old');
    $.get(ruta, { area_id: area,tipo_cargo:tipo }, function (data) {
        $('#cargo_id').empty();
        var html_select='<option value="">-- SELECCIONE --</option>';
        var nroItemP='';
        for(var i=0; i<data.length; ++i){
            nroItemP=data[i].nro_item;
            if(nroItemP==null){
                nroItemP='';
            }
            html_select+='<option value="'+data[i].id +'"'+ (valor==data[i].id ? 'selected' : "") +'><strong>( '+data[i].denominacion_cargo_nombre+' )</strong>-->'+nroItemP+'-'+data[i].nombre+'</option>'
        }
        $('#cargo_id').html(html_select);
    });

    if(tipo=='ITEM'){
        $('#nro_item').prop('disabled', false);
        $("#nro_item").attr("required", true);
    }else{
        $("#nro_item").attr("required", false);
        $('#nro_item').prop('disabled', true);
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const tipoCargoSelect = document.getElementById('tipo_cargo');
    const nroContratoInput = document.getElementById('nro_contrato');
    
    function toggleNroContrato() {
        const selectedValue = tipoCargoSelect.value;
        if (selectedValue.toUpperCase() === 'ITEM' || selectedValue === '') {
            $("#div_discapacidad").css('display', 'block');
            nroContratoInput.disabled = true;
        } else {
            nroContratoInput.disabled = false;
            $("#div_discapacidad").css('display', 'none');
        }
    }
    
    tipoCargoSelect.addEventListener('change', toggleNroContrato);
    toggleNroContrato(); 
});

function tipoCargo() {
    var tc = $('#tipo_cargo').val();
    if (tc == 'CONSULTOR INDIVIDUAL DE LINEA' || tc =='CONSULTOR POR PROGRAMA') {
        $("#nit").prop('disabled', false);
        $('#seguro_salud_id').prop('disabled',true);
    }
    else {
        $("#nit").prop('disabled', true);
        $("#seguro_salud_id").prop('disabled', false);

    }
        $('#nit').val('');
        $('#seguro_salud_id').val('');
}
$("#ciudad_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

$("#area_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

$("#cargo_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

$("#formacion_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

$("#profesion_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

$("#institucion_formacion_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve'
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

$("#provincia_id").select2({
    placeholder: '--SELECCIONE--',
    width: 'resolve',
    dropdownParent: $('#nuevaCiudad'),
    
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

//SOLO LETRAS EN LOS CAMPOS DEL FORMULARIO EMPLEADO
function soloLetras(e) {
    var letra = e.keyCode;
    console.log(letra);
    if ((letra > 64 && letra < 91) || (letra > 96 && letra < 123) || (letra === 8) || (letra === 32) || (letra === 9) || (letra === 164) || (letra === 192)) {
        return true;
    } else {
        return false;
    }

}

function readURL(input) {
    if (input.files && input.files[0]) { //Revisamos que el input tenga contenido
        var reader = new FileReader(); //Leemos el contenido

        reader.onload = function (e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
            $('#imagen').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
