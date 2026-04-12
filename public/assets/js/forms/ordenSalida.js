//----------------------------------------- OrdenSalida Index ------------------------------------------------------
var adminUrl=url_global;
  var btnSave = $('.btnSave');
  var btnUpdate = $('.btnUpdate');
  var csrf = $('input[name="_token"]').val();

  var editar=$('#can_edit').val();
  var show=$('#can_show').val();
  var destroy=$('#can_delete').val();
  var editar_jefe=$('#can_edit_jefe').val();
  var editar_rrhh=$('#can_edit_rrhh').val();
  var editar_jefe_rrhh=$('#can_edit_jefe_rrhh').val();

  var empleado_id=$('#empleado_id').val();
  $.ajaxSetup({
      headers: {'X-CSRF-Token': csrf}
  });

  function getRecords() {
      $("#section_search").css('display', 'block');

      $.getJSON(adminUrl + '/ver_ordenes_salida', { busqueda_ci: document.getElementById('ci').value, busqueda_estado: document.getElementById('estado').value}, function (json) {
        
          
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
              columnDefs:[{targets:5, render:function(data){
                return moment(data).format('DD/MM/yyyy');
              }}],
              columns: [
                  {  data: "empleado",class:'text-center' ,render: function(data,type,row){
                    return ''+data.nombres+' '+data.ap_paterno+' '+data.ap_materno;
                  } },
                  {  data: "empleado.ci",class:'text-center' },
                  {  data: "tipo.descripcion",class:'text-center' },
                  {  data: "hora_salida",class:'text-center' },
                  {  data: "hora_retorno",class:'text-center' },
                  {  data: "fecha_orden_salida",class:'text-center' },
                  {  data: "motivo",class:'text-center' },    
                  {  data: "jefe_estado.descripcion",class:'text-center' ,render: function(data,type,row){                 
                          switch (data) {
                              case 'PENDIENTE': return '<h5><span class="badge bg-secondary">PENDIENTE</span></h5>'; break;
                              case 'ACEPTADO': return '<h5><span class="badge bg-success">ACEPTADO</span></h5>'; break;
                              case 'ANULADO': return '<h5><span class="badge bg-danger">ANULADO</span></h5>'; break;
                          }
                  } },
                  {  data: null,class:'text-center' ,render: function(data,type,row){   
                            switch (row.rrhh_estado.descripcion) {
                              case 'PENDIENTE': return '<h5><span class="badge bg-secondary">PENDIENTE</span></h5>'; break;
                              case 'ACEPTADO': return '<h5><span class="badge bg-success">ACEPTADO</span></h5>'; break;
                              case 'ANULADO': return '<h5><span class="badge bg-danger">ANULADO</span></h5>'; break;
                            }                            
                  } },
                  {  data: null,class:'text-center' ,render: function(data,type,row){   
                          cadena='<div class="btn-group"><button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button><ul class="dropdown-menu">';
                          if(show==1){
                            cadena=cadena+'<li><a class="dropdown-item bntShow" href="javascript:void(0);" onclick="ver(\'' + row.uuid + '\')"  data-id="' + row.id + '">Ver Orden de Salida</a></li>'
                          }
                          if(editar_jefe==1){
                            if(row.jefe_estado.descripcion == "PENDIENTE"){
                              cadena=cadena+'<li><a class="dropdown-item bntEdit" href="javascript:void(0);" onclick="estado_jefe('+row.id+')" data-id="' + row.id + '">Aprobar/Anular Orden de Salida Jefe</a></li>';       
                            }
                          }
                          if(editar_rrhh==1){
                            if((row.rrhh_estado.descripcion == "PENDIENTE" && row.jefe_estado.descripcion == "ACEPTADO") || editar_jefe_rrhh == 1 ){
                              cadena=cadena+'<li><a class="dropdown-item bntEdit" href="javascript:void(0);" onclick="estado_rrhh('+row.id+')" data-id="' + row.id + '">Aprobar/Anular Orden de Salida RRHH</a></li>';
                            }
                          }
                          if(row.jefe_estado.descripcion == "PENDIENTE"){
                            if(editar==1){
                              cadena=cadena+'<li><a class="dropdown-item btnEdit" href="javascript:void(0);"  onclick="edit(\'' + row.uuid + '\')" data-id="' + row.id + '"</a>Editar Orden de Salida</li>';
                            }
                          }else{
                              if(row.jefe_estado.descripcion == "ACEPTADO"){
                                    if(editar_rrhh==1){
                                cadena=cadena+'<li><a class="dropdown-item btnEdit" href="javascript:void(0);"  onclick="edit(\'' + row.uuid + '\')" data-id="' + row.id + '"</a>Editar Orden de Salida</li>';
                           
                              }
                              }
                            
                          }
                          if(destroy==1){
                            cadena=cadena+'<li><a class="dropdown-item btnDelete" href="javascript:void(0);"  onclick="eliminar(\'' + row.uuid + '\')" data-id="' + row.id + '"</a>Eliminar Orden de Salida</li>';
                          }     
                          cadena=cadena+'</ul></div>';
                          return cadena;        
                  } }
              ]
          } );
      });
  };

  function estado_rrhh(id){
      Swal.fire({
          title: 'Acepta o Anula la Orden de Salida',
          icon: 'warning',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
          denyButtonText: `Anular`,
          cancelButtonText:'Cancelar'

        }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  method: 'get',
                  url: adminUrl + '/orden_salida_estado',
                  data:{id:id,encargado:'rrhh',estado:'SI'},
                  dataType: 'JSON',
                  success: function (respuesta){ 
                    Swal.fire({
                                  title: "Actualizado!",
                                  text: "El estado de la Orden de Salida fue correctamente actualizado",
                                  icon: "success"
                              });
                    getRecords();
                  }

              })         
          }else if (result.isDenied) {
            Swal.fire({
                title: "Tienes alguna observacion de esta Orden de Salida?",
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
                  url: adminUrl + '/orden_salida_estado',
                  data:{id:id,encargado:'rrhh',estado:'NO',observacion:observacion},
                  dataType: 'JSON',
                  success: function (respuesta){ 
                    Swal.fire({
                                  title: "Actualizado!",
                                  text: "El estado de la Orden de Salida fue correctamente actualizado",
                                  icon: "success"
                              });
                    getRecords();
                  }

              })
                },
                allowOutsideClick: () => !Swal.isLoading()
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire({
                                  title: "Actualizado!",
                                  text: "El estado de la Orden de Salida fue correctamente actualizado",
                                  icon: "success"
                              });
                    getRecords();
                }
              });
            }
          }
        );
  
  }




  function estado_jefe(id){
      Swal.fire({
          title: 'Acepta o Anula la Orden de Salida',
          icon: 'warning',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Aceptar',
          denyButtonText: `Anular`,
          cancelButtonText:'Cancelar'

        }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  method: 'get',
                  url: adminUrl + '/orden_salida_estado',
                  data:{id:id,encargado:'jefe',estado:'SI'},
                  dataType: 'JSON',
                  success: function (respuesta){ 
                    Swal.fire({
                                  title: "Actualizado!",
                                  text: "El estado de la Orden de Salida fue correctamente actualizado",
                                  icon: "success"
                              });
                    getRecords();
                  }

              })         
          }else if (result.isDenied) {
              Swal.fire({
                  title: "Por que se esta anulando esta Orden de Salida",
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
                      url: adminUrl + '/orden_salida_estado',
                      data:{id:id,encargado:'jefe',estado:'NO', observacion:observacion},
                      dataType: 'JSON',
                      success: function (respuesta){ 
                        Swal.fire({
                                      title: "Actualizado!",
                                      text: "El estado de la Orden de Salida fue correctamente actualizado",
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

              
  function edit(id) 
  {
    var ruta=adminUrl+'/orden_salida/'+id+'/edit';
    window.location.assign(ruta);
  }

  function ver(id) 
  {
      var ruta=adminUrl+'/orden_salida/'+id+'/show';
      window.open(ruta,'_blank');
  }


  function eliminar(id){
      Swal.fire({
          title: 'Desea continuar?',
          text: "Una vez elimine la orden de salida no se contará en la planilla mensual",
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
                  url: adminUrl + '/orden_salida/'+id+'/destroy',
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

  }









//----------------------------------------- OrdenSalida Consulta ----------------------------------------

function crearOrden(id){
    var ruta=adminUrl+'/orden_salida/'+id+'/create';
    window.location.assign(ruta);
}



/*------------------------------------Create - Update Script --------------------------------- */
window.onload = (event) => {
  var sel_tipo = document.getElementById("tipo_id");
  if(sel_tipo!==null){
      var str_tipo= sel_tipo.options[sel_tipo.selectedIndex].text;
      if(str_tipo=="SALIDA OFICIAL"){
          $("#div_tipo_horario").css('display', 'block');  
      }else{
          $("#div_horario").css('display', 'block');
          $("#div_tipo_horario").css('display', 'none'); 
      }
    
      var sel_horario = document.getElementById("horario");
      var str_horario= sel_horario.options[sel_horario.selectedIndex].text;
      if(str_horario=="OTROS"){
          $("#div_horario").css('display', 'block');
      }else{
          $("#div_horario").css('display', 'none'); 
          
      }
  }


};

function changeTypeSalida(){
  var sel = document.getElementById("tipo_id");
  var str= sel.options[sel.selectedIndex].text;
  if(str=="SALIDA OFICIAL"){
      document.getElementById('horario').getElementsByTagName('option')['tipo_nulo'].selected = 'selected';
      $("#div_tipo_horario").css('display', 'block');
      document.getElementById('horario_salida').value = '';
      document.getElementById('horario_retorno').value = '';  
  }else{
      $('option:contains("OTROS")').prop('selected', true);
      $("#div_horario").css('display', 'block');
      $("#div_tipo_horario").css('display', 'none'); 
      document.getElementById('horario_salida').value = '';
      document.getElementById('horario_retorno').value = '';  
  }
}
function changeTypeHorario(){
  var sel = document.getElementById("horario");
  var str= sel.options[sel.selectedIndex].text;
  if(str=="OTROS"){
      $("#div_horario").css('display', 'block');
      document.getElementById('horario_salida').value = '';
      document.getElementById('horario_retorno').value = '';
  }else{
      $("#div_horario").css('display', 'none'); 
      if(str=="DIA COMPLETO"){
          document.getElementById('horario_salida').value = '08:30';
          document.getElementById('horario_retorno').value = '18:30';
      }else{
          if(str=="MEDIO DIA (TARDE)"){
          document.getElementById('horario_salida').value = '14:30';
          document.getElementById('horario_retorno').value = '18:30';
          }else{
              document.getElementById('horario_salida').value = '08:30';
              document.getElementById('horario_retorno').value = '12:30';   
          }
      }
  }

}