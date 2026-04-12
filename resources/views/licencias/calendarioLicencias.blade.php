@extends('layouts.app')
@section('titulo','Licencias')
@section('content')
<div class="pagetitle">
    <h1>Licencias</h1>
        <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="">Licencias</a></li>
        <li class="breadcrumb-item active">Ver Calendario</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Calendario De Licencias Aprobadas</h5>
            <div id='calendar'></div>
            </div>
        </div>
      </div>
    </div>
</section>
@endsection
@section('scripts')
<script src='https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/locale/es.js'></script>
<script>
  $(document).ready(function()  {
      var currentLangCode = 'es';
$('#calendar').fullCalendar({
    hiddenDays: [ 0, 6],
  monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
              monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
              dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
              dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
//               eventClick: function(calEvent, jsEvent, view) {

// $(this).css('background', 'red');

// },
lang: 'es',
  header: {
      left: 'prev,next today myCustomButton',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay,list'
  },
  editable: true,
              eventLimit: true,
              events:{
                  url:'{{url("apiLicencia")}}'
              }
});
});
</script>
@endsection