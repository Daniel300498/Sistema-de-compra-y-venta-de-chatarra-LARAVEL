var adminUrl=url_global;
var btnSave = $('.btnSave');
var btnUpdate = $('.btnUpdate');
var csrf = $('input[name="_token"]').val();
var editar=$('#can_edit').val();
var show=$('#can_show').val();
var empleado_id=$('#empleado_id').val();
$.ajaxSetup({
    headers: {'X-CSRF-Token': csrf}
});

function getRecords() {
       $("#section_search").css('display', 'block');
    $.getJSON(adminUrl + '/ver_lactancias_firmas', { busqueda_ci: document.getElementById('ci').value, busqueda_nombre: document.getElementById('nombre').value}, function (json) {
        
        var data = json.map(function (fila) {
            cadena='<a href="{{route("complementarios.create",'+fila.id+')}}" class="btn btn-warning" title="Ver / Registrar un Documento Complementario"><i class="bi-paperclip"></i></a>';
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
            columnDefs:[{targets:2, render:function(data){
                return moment(data).format('DD/MM/yyyy');
            }}],
            columns: [
                {  data: "empleado",class:'text-center' ,render: function(data,type,row){
                  return ''+data.nombres+' '+data.ap_paterno+' '+data.ap_materno;
                } },
                {  data: "empleado.ci",class:'text-center' },
                {  data: "fecha_inicio_prenatal",class:'text-center' },
                {  data: "mensual.0",class:'text-center' ,render: function(data,type,row){
                    if(editar==1){
                        switch (data.estado) {
                            case 'N/A': return '<button class="badge bg-secondary" onclick="estado(5,'+row.id+')">PENDIENTE</button>'; break;
                            case 'SI': return '<h5><span class="badge bg-success">SI</span></h5>'; break;
                            case 'NO': return '<h5><span class="badge bg-danger">NO</span></h5>'; break;
                        }
                    }
                } },

                {  data: "mensual.1",class:'text-center' ,render: function(data,type,row){
                    if(editar==1){
                        switch (data.estado) {
                            case 'N/A': return '<button class="badge bg-secondary" onclick="estado(6,'+row.id+')">PENDIENTE</button>'; break;
                            case 'SI': return '<h5><span class="badge bg-success">SI</span></h5>'; break;
                            case 'NO': return '<h5><span class="badge bg-danger">NO</span></h5>'; break;
                        }
                    }
                } },
                {  data: "mensual.2",class:'text-center' ,render: function(data,type,row){
                    if(editar==1){
                        switch (data.estado) {
                            case 'N/A': return '<button class="badge bg-secondary" onclick="estado(7,'+row.id+')">PENDIENTE</button>'; break;
                            case 'SI': return '<h5><span class="badge bg-success">SI</span></h5>'; break;
                            case 'NO': return '<h5><span class="badge bg-danger">NO</span></h5>'; break;
                        }
                    }
                } },
                {  data: "mensual.3",class:'text-center' ,render: function(data,type,row){
                    if(editar==1){
                        switch (data.estado) {
                            case 'N/A': return '<button class="badge bg-secondary" onclick="estado(8,'+row.id+')">PENDIENTE</button>'; break;
                            case 'SI': return '<h5><span class="badge bg-success">SI</span></h5>'; break;
                            case 'NO': return '<h5><span class="badge bg-danger">NO</span></h5>'; break;
                        }
                    }
                } },
                {  data: "mensual.4",class:'text-center' ,render: function(data,type,row){
                    if(editar==1){
                        switch (data.estado) {
                            case 'N/A': return '<button class="badge bg-secondary" onclick="estado(9,'+row.id+')">PENDIENTE</button>'; break;
                            case 'SI': return '<h5><span class="badge bg-success">SI</span></h5>'; break;
                            case 'NO': return '<h5><span class="badge bg-danger">NO</span></h5>'; break;
                        }
                    }
                } },
                {  data: "uuid",class:'text-center' ,render: function(data,type,row){
                    if(editar==1){
                        return '<a onclick="documento(\'' + data + '\')" data-id="' + data + '" class="btn btn-warning" title="Ver / Registrar un Documento Complementario"><i class="bi-paperclip"></i></a>';
                    }
                } },
            ]
        } );
    });
};




function estado(mes,id){
    var mensaje_mes='';
    switch(mes) {
        case 5: mensaje_mes='quinto'; break;
        case 6: mensaje_mes='sexto'; break;
        case 7: mensaje_mes='septimo'; break;
        case 8: mensaje_mes='octavo'; break;
        case 9: mensaje_mes='noveno'; break;
    }
    Swal.fire({
        title: 'El empleado tiene la firma del '+mensaje_mes+' mes?',
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'SI',
        denyButtonText: `NO`,
        cancelButtonText:'Cancelar'

      }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Escribe el código de la lactancia de este mes",
                input: "text",
                inputAttributes: {
                  autocapitalize: "true"
                },
                showCancelButton: true,
                confirmButtonText: "Continuar",
                showLoaderOnConfirm: true,
                preConfirm: async (codigo) => {
                  
                    $.ajax({
                        method: 'get',
                        url: adminUrl + '/estado_firma',
                        data:{id:id,mes:mes,estado:'SI',codigo:codigo},
                        dataType: 'JSON',
                        success: function (respuesta){ 
                            console.log(respuesta);
                            if(respuesta == 1){
                                getRecords();
                                    Swal.fire({
                                        title: "Actualizado!",
                                        text: "La firma del mes fue correctamente actualizada",
                                        icon: "success"
                                    });
                            }else{
                                if(respuesta == 2){
                                    getRecords();
                                        Swal.fire({
                                            title: "Error!",
                                            text: "No puedes editar la firma de un mes que no sea el actual",
                                            icon: "error"
                                        });
                                }
                            }
                        }
                    }) 
                },
                allowOutsideClick: () => !Swal.isLoading()
              })
        }else if (result.isDenied) {
            $.ajax({
                method: 'get',
                url: adminUrl + '/estado_firma',
                data:{id:id,mes:mes,estado:'NO'},
                dataType: 'JSON',
                success: function (respuesta){ 
                    console.log(respuesta);
                    if(respuesta == 1){
                        getRecords();
                            Swal.fire({
                                title: "Actualizado!",
                                text: "La firma del mes fue correctamente actualizada",
                                icon: "success"
                            });
                    }else{
                        if(respuesta == 2){
                            getRecords();
                                Swal.fire({
                                    title: "Error!",
                                    text: "No puedes editar la firma de un mes que no sea el actual",
                                    icon: "error"
                                });
                        }
                    }
                }
            })
        }
      });
 
}

function documento(id) 
{
    var ruta=adminUrl+'/lactancia_firma/'+id;
    window.location.assign(ruta);
};
