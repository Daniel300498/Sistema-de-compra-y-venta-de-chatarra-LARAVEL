var adminUrl=url_global;
  var btnSave = $('.btnSave');
  var btnUpdate = $('.btnUpdate');
  var csrf = $('input[name="_token"]').val();
  var editar=$('#can_edit').val();
  var editar_jefe=$('#can_edit_jefe').val();
  var editar_rrhh=$('#can_edit_rrhh').val();
  var destroy=$('#can_destroy').val();
  var show=$('#can_show').val();
  var upload=$('#can_upload').val();
  var empleado_id=$('#empleado_id').val();
  $.ajaxSetup({
      headers: {'X-CSRF-Token': csrf}
  });

  function getRecords() {
    $("#section_search").css('display', 'block');
      $.getJSON(adminUrl + '/ver_licencias', { busqueda_ci: document.getElementById('ci').value, busqueda_estado: document.getElementById('estado').value}, function (json) {
        
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
                  {  data: "empleado",class:'text-center' ,render: function(data,type,row){
                    return ''+data.nombres+' '+data.ap_paterno+' '+data.ap_materno;
                  } },
                  {  data: "empleado.ci",class:'text-center' },
                  {  data: "tipo.descripcion",class:'text-center'},
                  {  data: "numero_dias",class:'text-center'},
                  {  data: "motivo",class:'text-center'},
                  {  data: "estado.descripcion",class:'text-center',render: function(data,type,row){   
                        switch (data) {
                            case 'PENDIENTE': return '<h5><span class="badge bg-secondary">PENDIENTE</span></h5>'; break;
                            case 'ACEPTADO': return '<h5><span class="badge bg-success">ACEPTADO</span></h5>'; break;
                            case 'DENEGADO': return '<h5><span class="badge bg-danger">DENEGADO</span></h5>'; break;
                        }
                  }
                  } ,
                  {  data: "rrhh_estado.descripcion",class:'text-center',render: function(data,type,row){   
                        switch (data) {
                            case 'PENDIENTE': return '<h5><span class="badge bg-secondary">PENDIENTE</span></h5>'; break;
                            case 'ACEPTADO': return '<h5><span class="badge bg-success">ACEPTADO</span></h5>'; break;
                            case 'DENEGADO': return '<h5><span class="badge bg-danger">DENEGADO</span></h5>'; break;
                        }
                  }
                  } ,
                  {  data: null,class:'text-center' ,render: function(data,type,row){   
                          cadena='<div class="btn-group"><button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button><ul class="dropdown-menu">';

                          if(show==1){
                            cadena += '<li><a class="dropdown-item btnShow" href="javascript:void(0);" onclick="ver_licencia(\'' + row.uuid + '\')" data-id="' + row.id + '">Ver Solicitud</a></li>';

                          }
                          if(editar==1){
                            if(row.estado.descripcion == "PENDIENTE" && row.rrhh_estado.descripcion == "PENDIENTE"){
                          
                              cadena += '<li><a class="dropdown-item btnEdit" href="javascript:void(0);" onclick="edit(\'' + row.uuid + '\',' + row.empleado.id + ')" data-id="' + row.id + '">Modificar Licencia </a></li>';
                            }
                            cadena=cadena+'<li><a class="dropdown-item btnEdit" href="javascript:void(0);"  onclick="ficha(\'' + row.uuid + '\')" data-id="' + row.id + '"</a>Subir documento</li>';

                          }

                          if(editar_jefe==1){
                            if(row.estado.descripcion == "PENDIENTE"){
                              if(row.documento_respaldo!=null){
                              cadena=cadena+'<li><a class="dropdown-item bntEdit" href="javascript:void(0);" onclick="editar_estado_jefe('+row.id+', 1)" data-id="' + row.id + '">Aprobar/Rechazar Licencia Jefe</a></li>';       
                              }else{
                                cadena=cadena+'<li><a class="dropdown-item bntEdit" href="javascript:void(0);" onclick="editar_estado_jefe('+row.id+', 0)" data-id="' + row.id + '">Aprobar/Rechazar Licencia Jefe</a></li>';                                
                              } 
                            }
                            
                          }
                          if(editar_rrhh==1){
                            if(row.rrhh_estado.descripcion == "PENDIENTE" && row.estado.descripcion == "ACEPTADO"){
                              if(row.documento_respaldo!=null){
                              cadena=cadena+'<li><a class="dropdown-item bntEdit" href="javascript:void(0);" onclick="editar_estado_rrhh('+row.id+', 1)" data-id="' + row.id + '">Aprobar/Rechazar Licencia RRHH</a></li>';       
                              }else{
                                cadena=cadena+'<li><a class="dropdown-item bntEdit" href="javascript:void(0);" onclick="editar_estado_rrhh('+row.id+', 0)" data-id="' + row.id + '">Aprobar/Rechazar Licencia RRHH</a></li>';                                
                              } 
                            }
                          }

                          
                          if(destroy==1){
                            cadena=cadena+'<li><a class="dropdown-item btnDelete" href="javascript:void(0);"  onclick="eliminar('+row.id+')" data-id="' + row.id + '"</a>Eliminar Licencia</li>';
                          }
                         
                          cadena=cadena+'</ul></div>';
                          return cadena;           
                  } }
              ]
          } );
      });
  };


  function edit(id, empleado_id) 
  {
    console.log(id);
    var ruta=adminUrl+'/licencias/'+empleado_id+'/'+id+'/edit';
    window.location.assign(ruta);
  }

  

  function ficha(id) 
  {
    var ruta=adminUrl+'/licencia/'+id+'/ficha';
    window.location.assign(ruta);
  }

  function eliminar(id){
      Swal.fire({
          title: 'Desea continuar?',
          text: "Una vez elimine la licencias ya no se contara en planilla",
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
                  url: adminUrl + '/licencia/'+id+'/destroy',
                  dataType: 'JSON',
                  success: function (){ 
                      Swal.fire({
                          title: "Eliminado!",
                          text: "El registro fue eliminado correctamente.",
                          icon: "success"
                      });
                      getRecords();
                  }
              })
          }
        });
  }

  function ver_licencia(id) 
  {
    var ruta=adminUrl+'/licencia/'+id+'/show';
    window.open(ruta,'_blank');
  }


  function editar_estado_jefe(id, flag){
    var documento_licencia ='';
    
    if(flag == 1){
      documento_licencia = '<embed src="'+adminUrl+'/licencias/documento_respaldo'+id+'.pdf" type="application/pdf" width="450px" height="400px">';   
    }else{
      documento_licencia = '<h5>Este empleado no adjunto ningún comprobante</h5>'
    }
    Swal.fire({
        title: 'Acepta o Rechaza la solicitud de licencia',
        icon: 'warning',
        html: documento_licencia,  
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar',
        denyButtonText: `Rechazar`,
        cancelButtonText:'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
                  method: 'get',
                  url: adminUrl + '/licencias/'+id+'/update_estado',
                  data:{estado:'SI', encargado:'jefe'},
                  dataType: 'JSON',
                  success: function (respuesta){ 
                    switch(respuesta) {
                      case 0:
                        Swal.fire({
                                  title: "Solicitud Denegada",
                                  text: "El estado de la licencia fue correctamente actualizado",
                                  icon: "error"
                              });
                        break;
                      case 1:
                        Swal.fire({
                                  title: "Solicitud Aceptada",
                                  text: "El estado de la licencia fue correctamente actualizado",
                                  icon: "success"
                              });
                        break;
                      case 2:
                        Swal.fire({
                                  title: "Los dias disponibles no son suficientes",
                                  icon: "error"
                              });
                        break;
                      case 3:
                        Swal.fire({
                                  title: "Actualizado!",
                                  text: "'La fecha de aprobación no puede ser menor a la fecha de Registro de la Licencia'",
                                  icon: "error"
                              });
                        break;
                        // code block
                    }
                    
                    getRecords();
                  }
              })            
        }else if (result.isDenied) {
          Swal.fire({
                title: "Por que estas rechazando la licencia?",
                input: "text",
                showCancelButton: true,
                confirmButtonText: "Continuar",
                showLoaderOnConfirm: true,
                preConfirm: async (observacion) => {
                    $.ajax({
                        method: 'get',
                        url: adminUrl + '/licencias/'+id+'/update_estado',
                        data:{observacion:observacion, estado:'NO', encargado:'jefe'},
                        dataType: 'JSON',
                        success: function (respuesta){ 
                          switch(respuesta) {
                          case 0:
                            Swal.fire({
                                      title: "Solicitud Denegada",
                                      text: "El estado de la licencia fue correctamente actualizado",
                                      icon: "error"
                                  });
                            break;
                          case 1:
                            Swal.fire({
                                      title: "Solicitud Aceptada",
                                      text: "El estado de la licencia fue correctamente actualizado",
                                      icon: "success"
                                  });
                            break;
                          case 2:
                            Swal.fire({
                                      title: "Los dias disponibles no son suficientes",
                                      icon: "error"
                                  });
                            break;
                          case 3:
                            Swal.fire({
                                      title: "Actualizado!",
                                      text: "'La fecha de aprobación no puede ser menor a la fecha de Registro de la Licencia'",
                                      icon: "error"
                                  });
                            break;
                            // code block
                        }
                        
                        getRecords();
                        }
                    }) 
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }
      });
  }


  function editar_estado_rrhh(id, flag){
    var documento_licencia ='';
    
    if(flag == 1){
      documento_licencia = '<embed src="'+adminUrl+'/licencias/documento_respaldo'+id+'.pdf" type="application/pdf" width="450px" height="400px">';   
    }else{
      documento_licencia = '<h5>Este empleado no adjunto ningún comprobante</h5>'
    }
    Swal.fire({
        title: 'Acepta o Rechaza la solicitud de licencia',
        icon: 'warning',
        html: documento_licencia,  
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar',
        denyButtonText: `Rechazar`,
        cancelButtonText:'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
                  method: 'get',
                  url: adminUrl + '/licencias/'+id+'/update_estado',
                  data:{estado:'SI', encargado:'rrhh'},
                  dataType: 'JSON',
                  success: function (respuesta){ 
                    switch(respuesta) {
                      case 0:
                        Swal.fire({
                                  title: "Solicitud Denegada",
                                  text: "El estado de la licencia fue correctamente actualizado",
                                  icon: "error"
                              });
                        break;
                      case 1:
                        Swal.fire({
                                  title: "Solicitud Aceptada",
                                  text: "El estado de la licencia fue correctamente actualizado",
                                  icon: "success"
                              });
                        break;
                      case 2:
                        Swal.fire({
                                  title: "Los dias disponibles no son suficientes",
                                  icon: "error"
                              });
                        break;
                      case 3:
                        Swal.fire({
                                  title: "Actualizado!",
                                  text: "'La fecha de aprobación no puede ser menor a la fecha de Registro de la Licencia'",
                                  icon: "error"
                              });
                        break;
                        // code block
                    }
                    
                    getRecords();
                  }
              })            
        }else if (result.isDenied) {
          Swal.fire({
                title: "Por que estas rechazando la licencia?",
                input: "text",
                showCancelButton: true,
                confirmButtonText: "Continuar",
                showLoaderOnConfirm: true,
                preConfirm: async (observacion) => {
                    $.ajax({
                        method: 'get',
                        url: adminUrl + '/licencias/'+id+'/update_estado',
                        data:{observacion:observacion, estado:'NO', encargado:'rrhh'},
                        dataType: 'JSON',
                        success: function (respuesta){ 
                          switch(respuesta) {
                          case 0:
                            Swal.fire({
                                      title: "Solicitud Denegada",
                                      text: "El estado de la licencia fue correctamente actualizado",
                                      icon: "error"
                                  });
                            break;
                          case 1:
                            Swal.fire({
                                      title: "Solicitud Aceptada",
                                      text: "El estado de la licencia fue correctamente actualizado",
                                      icon: "success"
                                  });
                            break;
                          case 2:
                            Swal.fire({
                                      title: "Los dias disponibles no son suficientes",
                                      icon: "error"
                                  });
                            break;
                          case 3:
                            Swal.fire({
                                      title: "Actualizado!",
                                      text: "'La fecha de aprobación no puede ser menor a la fecha de Registro de la Licencia'",
                                      icon: "error"
                                  });
                            break;
                            // code block
                        }
                        
                        getRecords();
                        }
                    }) 
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }
      });
  }


