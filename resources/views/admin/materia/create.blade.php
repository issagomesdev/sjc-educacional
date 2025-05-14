@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Adicionar Disciplina
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.materia.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nome_da_materia">{{ trans('cruds.materium.fields.nome_da_materia') }}</label>
                <input class="form-control {{ $errors->has('nome_da_materia') ? 'is-invalid' : '' }}" type="text" name="nome_da_materia" id="nome_da_materia" value="{{ old('nome_da_materia', '') }}" required>
                <span class="help-block">{{ trans('cruds.materium.fields.nome_da_materia_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.materium.fields.indique_o_nivel_de_ensino') }}</label>
                @foreach(App\Models\Materium::INDIQUE_O_NIVEL_DE_ENSINO_RADIO as $key => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="nivel_de_ensino_{{ $key }}" name="nivel_de_ensino" value="{{ $key }}" {{ old('nivel_de_ensino', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="nivel_de_ensino_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                <span class="help-block"> </span>
            </div>
            <div class="cont-group c">
            <div class="form-group">
                <label for="carga_horaria"> Carga Horária </label>
                <input class="form-control" type="number" step="0.01" name="carga_horaria" id="carga_horaria" value="{{ old('carga_horaria', '') }}" required>
                <span class="help-block"> </span>
            </div>
            <div class="form-group c">
                <label for="hora_falta"> Hora/Falta </label>
                <input class="form-control" type="number" step="0.01" name="hora_falta" id="hora_falta" value="{{ old('hora_falta', '') }}" required>
                <span class="help-block"> </span>
            </div>
            </div>
            <span class="info"> Neste primeiro campo deve ser informado a carga horária total da disciplina no <br>
                                ano letivo, e no outro campo um valor decimal equivalente a 1,00 (uma) hora falta. <br>
                                Ex: se as aulas são de 50 minutos, aqui deverá ser informado o valor 0,83. </span>
            <input type="hidden" class="assinatura_id" value="{{Auth::user()->id}}" for="assinatura_id" name="assinatura_id">
            <input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<style media="screen">

.cont-group {
    display: flex;
    margin-bottom: -0.5rem;
}

.form-group.c {
    margin-bottom: 1rem;
    padding-left: 10px;
}

.form-group {
    margin-bottom: 1rem;
    margin-top: 0.8rem;
}

</style>

@endsection
