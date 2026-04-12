
var adminUrl=url_global;
var _modal = $('#formFeriado');
var btnSave = $('.btnSave');
var btnUpdate = $('.btnUpdate');
var csrf = $('input[name="_token"]').val();
var eliminar=$('#can_destroy').val();
var editar=$('#can_edit').val();
var editar_memo=$('#can_edit_memo').val();
var show=$('#can_show').val();
var empleado_id=$('#empleado_id').val();
var cadena_eliminar='';
var cadena_editar='';
var cadena_show='';
var cadena_editar_memo='';
var cadena='';
$.ajaxSetup({
    headers: {'X-CSRF-Token': csrf}
});

function getRecords() {
    $.getJSON(adminUrl + '/ver_memorandums',{empleado_id:empleado_id}, function (json) {
        
        var data = json.map(function (fila) {
            cadena='<div class="btn-group"><button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button><ul class="dropdown-menu">';
              
            if(show==1){
                cadena_show='<li><a class="dropdown-item bntShow" href="javascript:void(0);" onclick="ver(\''+fila.uuid+'\')" data-id="' + fila.id + '">Ver Memorandum</a></li>'
            }
            if(editar==1){
                if(fila.estado==1){
                    cadena_editar='<li><a class="dropdown-item bntEdit" href="javascript:void(0);" onclick="estado(2,'+fila.id+')" data-id="' + fila.id + '">Desaprobar Memorandum</a></li>';
                }
                if(fila.estado==2){
                    cadena_editar='<li><a class="dropdown-item bntEdit" href="javascript:void(0);" onclick="estado(1,'+fila.id+')"  data-id="' + fila.id + '">Aprobar Memorandum</a></li>';
                }
                if(fila.estado==0){
                    cadena_editar='<li><a class="dropdown-item bntEdit" href="javascript:void(0);" onclick="estado(2,'+fila.id+')" data-id="' + fila.id + '">Desaprobar Memorandum</a></li>';
                    cadena_editar=cadena_editar+'<li><a class="dropdown-item bntEdit" href="javascript:void(0);" onclick="estado(1,'+fila.id+')"  data-id="' + fila.id + '">Aprobar Memorandum</a></li>';
                      cadena_editar_memo='<li><a class="dropdown-item bntEditarMemo" href="javascript:void(0);" onclick="editarmemo(\''+fila.uuid+'\')" data-id="' + fila.id + '">Modificar Memorandum</a></li>';
                }
            }
            if(eliminar==1){
                cadena_eliminar='<li><a class="dropdown-item btnDelete" href="javascript:void(0);"  data-id="' + fila.id + '"</a>Eliminar Memorandum</li>';
            }
            cadena=cadena+cadena_show+cadena_editar+cadena_eliminar+cadena_editar_memo+'</ul></div>';
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
            ordering: false,
            pageLength: 30,
            paging: true,
            searching: true,
            info: false,
            data: data,
            columnDefs:[{targets:1, render:function(data){
                return moment(data).format('DD/MM/yyyy');
            }}],
            columns: [
                {  data: "memorandum_tipo_id",class:'text-center' ,render: function(data,type,row){
                    switch (data) {
                        case 1: return 'PROMOCION'; break;
                        case 2: return 'TRANSFERENCIA'; break;
                        case 3: return 'BAJA CON VACACION'; break;
                        case 4: return 'BAJA SIN VACACION'; break;
                        case 5: return 'ALTA DE USUARIO'; break;
                        case 6: return 'LLAMADA DE ATENCION'; break;
                        case 7: return 'LACTANCIA'; break;
                        case 8: return 'ROTACION'; break;
                    }
                } },
                {  data: "fecha_emision",class:'text-center'},
                {  data: "estado",class:'text-center' ,render: function(data,type,row){
                    switch (data) {
                        case 0: return '<h5><span class="badge bg-secondary">PENDIENTE</span></h5>'; break;
                        case 1: return '<h5><span class="badge bg-success">APROBADO</span></h5>'; break;
                        case 2: return '<h5><span class="badge bg-orange">DESAPROBADO</span></h5>'; break;
                    }
                } },
                {  data: "boton",class:'text-center' },
            ]
        } );
    });
};

getRecords();

function estado(tipo,id){
    var texto='';
    var mensaje='';
    if(tipo==1){
        texto='APROBAR';
        mensaje='APROBADO';
    }else{
        if(tipo==2){
            texto='DESAPROBAR';
            mensaje='DESAPROBADO';
        }
    }
    
    Swal.fire({
        title: 'Desea '+texto+' el Memorandum?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText:'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: 'get',
                url: adminUrl + '/memorandum_estado',
                data:{tipo:tipo,id:id},
                dataType: 'JSON',
                success: function (respuesta){ 
                    console.log(respuesta);
                    getRecords();
                    Swal.fire({
                        title: "Actualizado!",
                        text: "El memorandum fue "+mensaje+" correctamente!",
                        icon: "success"
                    });
                }
            })
         
        }
      });
 
}
function ver(id) 
{
    console.log(id);
    var ruta=adminUrl+'/memorandum_ficha/'+id;
    window.open(ruta,'_blank');
    
};
function editarmemo(id) 
{
    var ruta=adminUrl+'/memorandum/edit/'+id;
    location.href = ruta;
    
};

$('table').on('click', '.btnDelete', function () 
{
    var id = $(this).data('id');
    Swal.fire({
        
        title: 'Desea eliminar el Memorandum?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI',
        cancelButtonText:'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Porque elimina el memorandum?",
                input: "text",
                inputAttributes: {
                  autocapitalize: "true"
                },
                showCancelButton: true,
                confirmButtonText: "Continuar",
                showLoaderOnConfirm: true,
                preConfirm: async (observacion) => {
                    $.ajax({
                        method: 'get',
                        url: adminUrl + '/memorandum_destroy',
                        data:{observacion:observacion,id:id},
                        dataType: 'JSON',
                        success: function (){ 
                            
                        }
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
                if (result.isConfirmed) {
                    getRecords();
                    Swal.fire({
                        title: "Eliminado!",
                        text: "El memorandum fue eliminado correctamente.",
                        icon: "success"
                    });
                }
              });
        }
      });
});



