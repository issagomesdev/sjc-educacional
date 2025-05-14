@extends('layouts.admin')
@section('content')

<div class="card">

<div class="card-body">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
    @foreach($taskTags as $taskTag)
    <label class="taskColor"
    style="width: 15px;
    height: 15px;
    margin-bottom: -4px;
    background: {{$taskTag->color}};
    border: inset;
    position: relative;">  </label>

    <label class="name" style="padding-right: 10px;"> {{ $taskTag->name }} </label> @endforeach
</div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.tasksCalendar.title') }}
    </div>

    <div class="card-body">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
        <div id="calendar"></div>

    </div>

</div>

<link rel="stylesheet" href="{{ url('css/panel.css') }}">

@endsection

@section('scripts')
@parent
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
buttonText: {
        prev: "<",
        next: ">",
        prevYear: ">>",
        nextYear: "<<",
        today: "Hoje",
        month: "Mês",
        week: "Semana",
        day: "Dia"
    },
                events : [
@foreach($events as $event)
@if($event->inicio)
                            {
                                title : '{{ $event->name }}',
                                color : '@foreach($event->tags as $tags) {{$tags->color}} @endforeach',
                                start : '{{ $event->inicio }}',
                                url : '{{ url('admin/tasks').'/'.$event->id.'' }}'
                            },


@endif
@endforeach
                ]
            })
        });
</script>

@stop
