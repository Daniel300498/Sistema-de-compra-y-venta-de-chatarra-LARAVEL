var adminUrl=url_global;
var csrf = $('input[name="_token"]').val();

$.ajaxSetup({
   headers: {'X-CSRF-Token': csrf}
});

   var adminUrl=url_global;
   $( "#ci" ).autocomplete({
      source: function( request, response ) {
         var ruta=adminUrl+'/sugerencia_empleado';
         // Fetch data
         $.ajax({
         url: ruta,
         type: 'post',
         dataType: "json",
         data: {
            search: request.term
         },
         success: function( data ) {
            response( data );
         }
         });
      },
     select: function (event, ui) {
         $('#ci').val(ui.item.ci); // save selected id to input
         return false;
      }
      
   });