@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.minhasAula.title') }}
    </div>

    <div class="card-body">
        <p>
          @foreach($quadro as $quadro)
               <p> {{ $quadro->periodo }} - {{ App\Models\QuadroDeHorario::DIAS_RADIO[$quadro->dias] ?? '' }} - {{ $quadro->horario }} - {{ $quadro->ano_serie->ano_serie }} - {{ $quadro->materias->nome_da_materia }} </p>
               @endforeach
        </p>
    </div>
</div>



@endsection
