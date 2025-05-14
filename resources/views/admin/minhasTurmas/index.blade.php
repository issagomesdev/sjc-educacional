@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.minhasTurma.title') }}
    </div>

    <div class="card-body">
        <p>

          @foreach($turma as $turma)
               <p> {{ $turma->ano_serie }} | <a href="{{ route('admin.meus-alunos.index') }}?id_turma={{$turma->id}}"> Listar alunos </a> </p>
               @endforeach

        </p>
    </div>
</div>



@endsection
