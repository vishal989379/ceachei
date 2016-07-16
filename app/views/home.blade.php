@extends('layouts.layout')
@section('head')
@stop
@section('sidebar')
    @parent
@stop
@section('title')
  Panel de Control
@stop
@section('content')
<script type="text/javascript">
$(function () {
 /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#horario').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title'
      },
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Día'
      },
      //Random default events
      events: [
      @foreach($recaudaciones as $rec)
      {
        id: {{ $rec->id }},
        title: 'Efectivo: {{ $rec->efectivo }}',
        start: '{{ $rec->fecha }}'
      },
      @endforeach
      ],
      lang:'es',
      defaultView:'month',
      editable: false,
      allDaySlot: false,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#horario').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      },
      eventClick: function(calEvent, jsEvent, view) {

          $('#modal-horario').modal()
          var id = calEvent.id_horario;
          $.ajax({
                type: "GET",
                url: "{{ URL::to('/') }}/admin/horarios/horario-info/"+id,
                data: { id : id },
                success:function(data){
                  $('#horario-clase').text(data.titulo);
                  $('#horario-nombre-alumno').text(data.alumno);
                  $('#horario-nombre-instructor').text(data.instructor);
                  $('#horario-fecha-desde').text(data.fecha_desde);
                  $('#horario-fecha-hasta').text(data.fecha_hasta);
                  $('#elimina-horario').attr('data-horarioid', id);
                },
                error:function (response){
                  error = eval(response);
                  alert('error'+error)
                }
              });
      }
    });
});
</script>
  @if(Entrust::hasRole('administracion'))
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-2">
      </div>
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-body no-padding">
            <!-- THE CALENDAR -->
            <div id="horario"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /. box -->
      </div>
      <div class="col-md-2">
      </div>
    </div>
  </div>
  @endif
</div>
@stop
