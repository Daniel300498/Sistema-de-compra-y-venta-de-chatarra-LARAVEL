
  var adminUrl=url_global;
  var btnSave = $('.btnSave');
  var btnUpdate = $('.btnUpdate');
  var csrf = $('input[name="_token"]').val();
  var editar=$('#can_edit').val();
  var destroy=$('#can_destroy').val();
  var show=$('#can_show').val();
  var id_postnatal=$('#id_postnatal').val();
  var empleado_id=$('#empleado_id').val();
  $.ajaxSetup({
      headers: {'X-CSRF-Token': csrf}
  });

  function getRecords() {
      $("#section_search").css('display', 'block');
      $.getJSON(adminUrl + '/ver_lactancias', { busqueda_ci: document.getElementById('ci').value, busqueda_nombre: document.getElementById('nombre').value}, function (json) {
          
          var data = json.map(function (fila) {
              cadena='<a href="{{route("complementarios.create",'+fila.id+')}}" class="btn btn-warning" title="Ver / Registrar un Documento Complementario"><i class="bi-paperclip"></i></a>';
          return $.extend({ boton: cadena}, fila);
              });

        console.log(data);
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
              columnDefs:[{targets:[2,3,4], render:function(data){
                if(data == null){
                  return "N/A";
                }else{
                  return moment(data).format('MM/yyyy');
                }
                
              }}],
              columns: [
                  {  data: "empleado",class:'text-center' ,render: function(data,type,row){
                    return ''+data.nombres+' '+data.ap_paterno+' '+data.ap_materno;
                  } },
                  {  data: "empleado.ci",class:'text-center' },
                  {  data: "fecha_inicio_prenatal",class:'text-center'},
                  {  data: "fecha_inicio_postnatal",class:'text-center'},
                  {  data: "fecha_fin_postnatal",class:'text-center'},
                  {  data: "meses_lactancia_postnatal",class:'text-center',render: function(data,type,row){
                    if(data == null){
                        return '-';
                    }else{
                        return data;
                    }
                  } },

                  {  data: null,class:'text-center' ,render: function(data,type,row){   
                          cadena='<div class="btn-group"><button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Opciones</button><ul class="dropdown-menu">';

                          if(show==1){
                            if(row.documento_prenatal!=null){
                              cadena=cadena+'<li><a class="dropdown-item bntShow" target="_blank" href="'+adminUrl+'/documentos_lactancia/'+row.documento_prenatal+'"  data-id="' + row.id + '">Ver Documento Prenatal</a></li>'
                            }
                            if(row.documento_certificado_nacimiento!=null){
                              cadena=cadena+'<li><a class="dropdown-item bntShow" target="_blank" href="'+adminUrl+'/documentos_lactancia/'+row.documento_certificado_nacimiento+'" data-id="' + row.id + '">Ver Certificado de Nacimiento</a></li>'
                            }
                            if(row.documento_caja_postnatal!=null){
                              cadena=cadena+'<li><a class="dropdown-item bntShow" target="_blank" href="'+adminUrl+'/documentos_lactancia/'+row.documento_caja_postnatal+'" data-id="' + row.id + '">Ver Documento de la Caja</a></li>'
                            }
                          }
 
                          if(editar==1){
                            cadena = cadena + '<li><a class="dropdown-item btnEdit" href="javascript:void(0);" onclick="edit(\'' + row.uuid + '\')" data-id="' + row.id + '">Actualizar Lactancia - Adjuntar documentos</a></li>';

                            if(id_postnatal==row.inicio_lactancia && row.bono_lactancia_postnatal==null){
                              cadena=cadena+'<li><a class="dropdown-item btnEdit" href="javascript:void(0);"  onclick="bono_estado('+row.id+')" data-id="' + row.id + '"</a>Bono por Nacimiento</li>';
                            }
                           }
                          
                          if(destroy==1){
                            cadena=cadena+'<li><a class="dropdown-item btnDelete" href="javascript:void(0);"  onclick="eliminar(\'' + row.uuid + '\')" data-id="' + row.id + '"</a>Eliminar Lactancia</li>';
                          }
                          cadena=cadena+'</ul></div>';
                          return cadena;           
                  } }
              ]
          } );
      });
  };




  function bono_estado(id){
      Swal.fire({
          title: 'Se le asignará el bono al empleado?',
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
                  url: adminUrl + '/bono_lactancia_estado',
                  data:{id:id,estado:'SI'},
                  dataType: 'JSON',
                  success: function (respuesta){ 
                    Swal.fire({
                                  title: "Actualizado!",
                                  text: "El estado del Bono de Lactancia fue actualizado",
                                  icon: "success"
                              });
                    getRecords();
                  }

              })         
          }else if (result.isDenied) {
            $.ajax({
                  method: 'get',
                  url: adminUrl + '/bono_lactancia_estado',
                  data:{id:id,estado:'NO'},
                  dataType: 'JSON',
                  success: function (respuesta){ 
                    Swal.fire({
                                  title: "Actualizado!",
                                  text: "El estado del Bono de Lactancia fue actualizado",
                                  icon: "success"
                              });
                    getRecords();
                  }

              })
          }
        });
  
  }




  function edit(id) 
  {
    var ruta=adminUrl+'/lactancia/'+id+'/edit';
    window.location.assign(ruta);
  }

  function eliminar(id){
      Swal.fire({
          title: 'Desea continuar?',
          text: "Una vez elimine la lactancia ya no se contará cada mes",
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
                  url: adminUrl + '/lactancia/'+id+'/destroy',
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

  function ver_carta(id) 
  {
    var ruta=adminUrl+'/lactancia/'+id+'/show_carta';
    window.open(ruta,'_blank');
  }

  function update_bono(id, monto){
    Swal.fire({
        title: 'Quieres actualizar el Bono de Lactancia?',
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
                        url: adminUrl + '/update_bono',
                        data:{id:id,monto:monto},
                        dataType: 'JSON',
                        success: function (respuesta){ 
                                    Swal.fire({
                                        title: "Actualizado!",
                                        text: "El bono lactancia fue correctamente actualizado",
                                        icon: "success"
                                    });
                                    location.reload();
                        }
                    }) 
                },
                allowOutsideClick: () => !Swal.isLoading()
              })
        }
      });
}





/*--------------------------------Lactancia Create------------------------- */
window.onload = (event) => {
    var sel = document.getElementById("tipo_id");
    if(sel!==null){
       var str= sel.options[sel.selectedIndex].text;

      if(str == "PRENATAL"){
        $("#postnatalDocumentacion").css('display', 'none');
            $("#prenatalDocumentacion").css('display', 'block');
      }else{
              if(str=="POSTNATAL"){
                $("#prenatalDocumentacion").css('display', 'none');
                $("#postnatalDocumentacion").css('display', 'block');
              }
            }
    }
    
    };
    
    function changeType() {
      var sel = document.getElementById("tipo_id");
      var str= sel.options[sel.selectedIndex].text;
      if(str=="PRENATAL"){
        $("#postnatalDocumentacion").css('display', 'none');
        $("#prenatalDocumentacion").css('display', 'block');
        document.getElementById('texto').innerText = "Debes subir el documento medico que avale el embarazo y la fecha, desde esta fecha se contará la Lactancia Prenatal"
      }else{
        if(str=="POSTNATAL"){
          $("#prenatalDocumentacion").css('display', 'none');
          $("#postnatalDocumentacion").css('display', 'block');
          document.getElementById('texto').innerText = "Debe subir el documento de Nacimiento de su hijo/a de manera obligatoria y un comprobante de la Caja de Salud. La lactancia postnatal contará desde el nacimiento del niño/a hasta que este cumpla un año. \nEl documento de la Caja de Salud puede ser subido después, consultar el manual para saber el limite de tiempo."
        }
      }
    }

    function changeBeneficiaria(beneficiaria){
      //console.log(beneficiaria);
      //onsole.log(beneficiaria[0]);
 

      if(document.getElementById("beneficiaria").value != ""){
        for (let i = 0; i < beneficiaria.length; i++) {
        if(beneficiaria[i].id == document.getElementById("beneficiaria").value){
          console.log(beneficiaria[i]);
          document.getElementById("nombres").value = beneficiaria[i].nombres;
          document.getElementById("ap_paterno").value = beneficiaria[i].ap_paterno;
          document.getElementById("ap_materno").value = beneficiaria[i].ap_materno;
          document.getElementById("ci").value = beneficiaria[i].ci;
          document.getElementById("ci_complemento").value = beneficiaria[i].complemento;
         
          document.getElementById("ci_lugar").value = beneficiaria[i].ci_lugar;
          document.getElementById("nombres").disabled = true;
          document.getElementById("ap_paterno").disabled =true;
          document.getElementById("ap_materno").disabled = true;
          document.getElementById("ci").disabled = true;
          document.getElementById("ci_complemento").disabled = true;
          document.getElementById("ci_lugar").disabled = true;
        }       
      }
      }else{
        document.getElementById("nombres").value = "";
          document.getElementById("ap_paterno").value = "";
          document.getElementById("ap_materno").value = "";
          document.getElementById("ci").value = "";
          document.getElementById("ci_complemento").value = "";
          document.getElementById("ci_lugar").value = "";
          
          document.getElementById("nombres").disabled = false;
          document.getElementById("ap_paterno").disabled = false;
          document.getElementById("ap_materno").disabled = false;
          document.getElementById("ci").disabled = false;
          document.getElementById("ci_complemento").disabled = false;
          document.getElementById("ci_lugar").disabled = false;
      }
    }