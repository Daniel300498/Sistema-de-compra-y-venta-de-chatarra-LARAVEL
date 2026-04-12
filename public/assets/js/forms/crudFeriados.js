
var adminUrl=url_global;
var _modal = $('#formFeriado');
var btnSave = $('.btnSave');
var btnUpdate = $('.btnUpdate');
var csrf = $('input[name="_token"]').val();
var eliminar=$('#can_destroy').val();
var editar=$('#can_edit').val();
var cadena_eliminar='';
var cadena_editar='';
var cadena='';
$.ajaxSetup({
    headers: {'X-CSRF-Token': csrf}
});

function getRecords() {
    $.getJSON(adminUrl + '/obtener_feriados', function (json) {
        var data = json.map(function (fila) {
            cadena='<div class="btn-group"><button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button><ul class="dropdown-menu">';
            if(eliminar==1){
                cadena_eliminar='<li><a class="dropdown-item btnDelete" data-id="' + fila.id + '" href="#">Eliminar Feriado</a></li>';
            }
            if(editar==1){
                cadena_editar='<li><a class="dropdown-item btnEdit" data-id="' + fila.id + '" href="#">Modificar Feriado</a></li>';
            }
            cadena=cadena+cadena_editar+cadena_eliminar+'</ul></div>';
        return $.extend({ boton: cadena}, fila);
    });
    $('#datos').DataTable( {
            destroy:true,
            
            "language": {
                "processing": "Procesando...",
                "lengthMenu": 'Filtrar <select>'+
                    '<option value="10">10</option>'+
                    '<option value="20">20</option>'+
                    '<option value="30">30</option>'+
                    '<option value="40">40</option>'+
                    '<option value="50">50</option>'+
                    '<option value="-1">Todos</option>'+
                    '</select> Registros',
                "paginate": {
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
                },
                "info": "Pagina _PAGE_ de _PAGES_",
                "search": "Busqueda Gral.:",
                "emptyTable": "No existen datos registrados.",
                "infoEmpty": "",
            },
            ordering: true,
            pageLength: 30,
            paging: true,
            searching: true,
            info: false,
            data: data,
            columns: [
                {  data: "fecha",class:'text-center'},
                {  data: "nombre" },
                {  data: "anual",class:'text-center' ,render: function(data,type,row){
                    switch (data) {
                        case 1: return '<h5><span class="badge bg-secondary">GENERAL</span></h5>'; break;
                        case 0: return '<h5><span class="badge bg-orange">ANUAL</span></h5>'; break;
                    }
                } },
                {  data: "boton",class:'text-center' },
            ]
        } );
    });
};

getRecords();

function reset() 
{
    _modal.find('input').each(function () 
    {
        $(this).val(null)
    })
};


function getInputs() 
{
    var id = $('input[name="id"]').val();
    var nombre = $('input[name="nombre"]').val();
    var fecha = $('input[name="fecha"]').val();
    var anual = $('select[name="anual"]').val();
    return {id: id, nombre: nombre,fecha:fecha,anual:anual};
};

_modal.on('shown.bs.modal', function () {
    $('#nombre').trigger('focus')
  })

function create() 
{ 
    _modal.find('.modal-title').text('Nuevo Feriado');
    reset();
    _modal.modal('show')
    btnSave.show()
    btnUpdate.hide()
};


$(document).on('submit', '#storeferiado', function(event) {
	event.preventDefault();
    var id = $('#id').val();
    Swal.fire({
        title: "Desea Continuar?",
        text: "Agregara un nuevo dia feriado!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, guardar!",
        cancelButtonText:'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'POST',
                url: adminUrl + '/feriados/store',
                data: getInputs(),
                dataType: 'JSON',
                success: function ()
                { 
                    reset()
                    _modal.modal('hide')
                    getRecords();
                    if(id!=''){
                        swal('Actualizado!', '', 'success')
                        Swal.fire({
                            title: "Actualizado!",
                            text: "El registro fue actualizado correctamente!",
                            icon: "success"
                        });
                    }
                    else{
                        Swal.fire({
                            title: "Registrado!",
                            text: "El registro fue registrado correctamente!",
                            icon: "success"
                        });
                    }
                },
                error: function (data) {
                    var e=data.responseText;
                    
                    if(e!=null){
                        Swal.fire({
                            title: "Error de Registro!",
                            text: e,
                            icon: "error"
                        });

                    }else{
                        Swal.fire({
                            title: "Error!",
                            text: "El registro NO fue registrado, consulte con el administrador del sistema!",
                            icon: "error"
                        });
                    }
                }
            })
         
        }
      });
  
});


$('table').on('click', '.btnEdit', function ()
{ 
    _modal.find('.modal-title').text('Modificar Feriado')
    _modal.modal('show')

    btnSave.hide()
    btnUpdate.show()

    var id = $(this).data('id');
    var fecha = $(this).parent().parent().find('td').eq(0).text()
    var nombre = $(this).parent().parent().find('td').eq(1).text()
    var tipo = $(this).parent().parent().find('td').eq(2).text()
    $('input[name="id"]').val(id);
    $('input[name="fecha"]').val(fecha);
    $('input[name="nombre"]').val(nombre);
    if(tipo=='Anual')
    {
        $('select[name="anual"]').val(0);
    }
    else
    {
        $('select[name="anual"]').val(1);
    }
});


$('table').on('click', '.btnDelete', function () 
{
    var id = $(this).data('id');
    Swal.fire({
        
        title: 'Desea continuar?',
        text: "Considere que las vacaciones y licencias verifican los dias feriados",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText:'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'DELETE',
                url: adminUrl + '/feriados/'+id+'/destroy',
                dataType: 'JSON',
                success: function (){ 
                    getRecords();
                    Swal.fire({
                        title: "Eliminado!",
                        text: "El registro fue eliminado correctamente.",
                        icon: "success"
                    });
                }
            })
         
        }
      });
});

