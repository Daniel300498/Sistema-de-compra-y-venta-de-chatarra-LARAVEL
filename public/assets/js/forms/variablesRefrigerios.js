
var adminUrl=url_global;
var btnSave = $('.btnSave');
var btnUpdate = $('.btnUpdate');
var csrf = $('input[name="_token"]').val();
var editar=$('#can_edit').val();
var empleado_id=$('#empleado_id').val();
$.ajaxSetup({
    headers: {'X-CSRF-Token': csrf}
});

function getRecords() {
    $.getJSON(adminUrl + '/pago_variables', function (json) {
        
        var data = json.map(function (fila) {
            cadena='';
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
            columns: [
                { 
                    data: null, // No viene de la base de datos
                    class: 'text-center',
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // meta.row es el índice de la fila (empieza en 0)
                    }
                },
                {  data: "descripcion",class:'text-center' },
                {  data: "valor",class:'text-center'},
                {  
                    data: null,
                    class: 'text-center',
                    render: function (data, type, row) {   
                        let cadena = '<div class="btn-group">' +
                                     '<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button>' +
                                     '<ul class="dropdown-menu">';
                
                        if (editar == 1) {
                            cadena += '<li><a class="dropdown-item btnEdit" href="javascript:void(0);" ' +
                                      'onclick="update_monto(\'' + row.uuid + '\', \'' + row.descripcion.replace(/'/g, "\\'") + '\', ' + row.valor + ')" ' +
                                      'data-id="' + row.id + '">Editar monto</a></li>';
                        }
                
                        cadena += '</ul></div>';
                        return cadena;           
                    } 
                }
                
                
            ]
        } );
    });
};


getRecords();


function update_monto(id, descripcion,monto){
  Swal.fire({
      title: 'Quieres actualizar el monto de '+descripcion+'?',
      text: 'El actual monto es: '+monto+' Bs',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'SI',
      cancelButtonText:'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
          Swal.fire({
              title: "Ingresa el nuevo monto que se manejará",
              input: "number",
              showCancelButton: true,
              confirmButtonText: "Continuar",
              showLoaderOnConfirm: true,
              preConfirm: async (monto) => {
                  $.ajax({
                      method: 'get',
                      url: adminUrl + '/update_variables',
                      data:{id:id,monto:monto},
                      dataType: 'JSON',
                      success: function (respuesta){ 
                                  Swal.fire({
                                      title: "Actualizado!",
                                      text: "El monto del pago fue correctamente actualizado",
                                      icon: "success"
                                  });
                                  getRecords();
                      }
                  }) 
              },
              allowOutsideClick: () => !Swal.isLoading()
            })
      }
    });
}




