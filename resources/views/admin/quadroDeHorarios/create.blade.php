@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Adicionar Horário
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.quadro-de-horarios.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ano_serie_id">{{ trans('cruds.quadroDeHorario.fields.ano_serie') }}</label>
                <select class="form-control select2" name="turma_id" id="turma_id" required>
                  <option value=""> Selecione por favor </option>
                    @foreach($turma as $tur)
                        <option value="{{ $tur->id }}" {{ old('turma_id') == $tur->id ? 'selected' : '' }}> {{ $tur->serie }} {{ $tur->identificacao }} - {{ $tur->nivel_da_turma }} </option>
                    @endforeach
                </select>
                @if($errors->has('ano_serie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano_serie') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quadroDeHorario.fields.ano_serie_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.quadroDeHorario.fields.periodo') }}</label>
                @foreach(App\Models\QuadroDeHorario::PERIODO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('periodo') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="periodo_{{ $key }}" name="periodo" value="{{ $key }}" {{ old('periodo', '') === (string) $key ? 'checked' : '' }} required>
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
                <label>Dia</label>
                @foreach(App\Models\QuadroDeHorario::DIAS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('dias') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="dias_{{ $key }}" name="dias" value="{{ $key }}" {{ old('dias', '') === (string) $key ? 'checked' : '' }} required>
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
                <input class="form-control timepicker" type="text" name="horario" id="horario" value="{{ old('horario') }}" required>
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
                        <option value="{{ $id }}" {{ old('materias_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                        <option value="{{ $id }}" {{ old('professor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('professor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('professor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.quadroDeHorario.fields.professor_helper') }}</span>
            </div>
            <input type="hidden" class="escola_id" value="{{ $escola }}" for="escola_id" name="escola_id">
            <input type="hidden" class="ano_id" value="{{ $ano }}" for="ano_id" name="ano_id">
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

@endsection
