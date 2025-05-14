@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Horário
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.quadro-de-horarios.update", [$quadroDeHorario->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="turmas">{{ trans('cruds.quadroDeHorario.fields.ano_serie') }}</label>
                <select class="form-control select2" name="turma_id" id="turma_id" required>
                    @foreach($turma as $tur)
                    @if($tur->escola->id == $quadroDeHorario->escola->id)
                        <option value="{{ $tur->id }}" {{ (old('turma_id') ? old('turma_id') : $quadroDeHorario->turma->id ?? '') == $tur->id ? 'selected' : '' }}> {{ $tur->serie }} {{ $tur->identificacao }} - {{ $tur->nivel_da_turma }} </option>
                    @endif
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label>{{ trans('cruds.quadroDeHorario.fields.periodo') }}</label>
                @foreach(App\Models\QuadroDeHorario::PERIODO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('periodo') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="periodo_{{ $key }}" name="periodo" value="{{ $key }}" {{ old('periodo', $quadroDeHorario->periodo) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="periodo_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('periodo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('periodo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quadroDeHorario.fields.periodo_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.quadroDeHorario.fields.dias') }}</label>
                @foreach(App\Models\QuadroDeHorario::DIAS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('dias') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="dias_{{ $key }}" name="dias" value="{{ $key }}" {{ old('dias', $quadroDeHorario->dias) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="dias_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('dias'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dias') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quadroDeHorario.fields.dias_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario">{{ trans('cruds.quadroDeHorario.fields.horario') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario') ? 'is-invalid' : '' }}" type="text" name="horario" id="horario" value="{{ old('horario', $quadroDeHorario->horario) }}" required>
                @if($errors->has('horario'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quadroDeHorario.fields.horario_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="materias_id">{{ trans('cruds.quadroDeHorario.fields.materias') }}</label>
                <select class="form-control select2 {{ $errors->has('materias') ? 'is-invalid' : '' }}" name="materias_id" id="materias_id" required>
                    @foreach($materias as $id => $entry)
                        <option value="{{ $id }}" {{ (old('materias_id') ? old('materias_id') : $quadroDeHorario->materias->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('materias'))
                    <div class="invalid-feedback">
                        {{ $errors->first('materias') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quadroDeHorario.fields.materias_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="professor_id">{{ trans('cruds.quadroDeHorario.fields.professor') }}</label>
                <select class="form-control select2 {{ $errors->has('professor') ? 'is-invalid' : '' }}" name="professor_id" id="professor_id" required>
                    @foreach($professors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('professor_id') ? old('professor_id') : $quadroDeHorario->professor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('professor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('professor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quadroDeHorario.fields.professor_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
