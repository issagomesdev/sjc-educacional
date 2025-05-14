@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Cadastrar Turma
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.turmas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tipo_de_turma_id">{{ trans('cruds.turma.fields.tipo_de_turma') }}</label>
                <select class="form-control selectd" name="tipo_de_turma_id" id="tipo_de_turma_id" required>
                <option value="">Selecione por favor</option>
                <option value="Regular" {{ old('tipo_de_turma') == 'Regular' ? 'selected' : '' }}>Regular</option>
                <option value="Diversificada" {{ old('tipo_de_turma') == 'Diversificada' ? 'selected' : '' }}>Diversificada</option>
                </select>
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.turma.fields.turno') }}</label>
                @foreach(App\Models\Turma::TURNO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('turno') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="turno_{{ $key }}" name="turno" value="{{ $key }}" {{ old('turno', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="turno_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('turno'))
                    <div class="invalid-feedback">
                        {{ $errors->first('turno') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.turma.fields.turno_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.turma.fields.nivel_da_turma') }}</label>
                @foreach(App\Models\Turma::NIVEL_DA_TURMA_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('nivel_da_turma') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="nivel_da_turma_{{ $key }}" name="nivel_da_turma" value="{{ $key }}" {{ old('nivel_da_turma', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="nivel_da_turma_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('nivel_da_turma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nivel_da_turma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.turma.fields.nivel_da_turma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="serie">Série</label>
                <select class="form-control select2" name="serie" id="serie" required>
                    <option value=""> Selecione por favor </option>
                    <option value="Creche I" {{ old('serie') == 'Creche I' ? 'selected' : '' }}> Creche - 0 a 1 ano e 6 meses </option>
                    <option value="Creche II" {{ old('serie') == 'Creche II' ? 'selected' : '' }}> Creche - 1 ano e 7 meses a 3 anos e 11 meses </option>
                    <option value="Pré-escolar" {{ old('serie') == 'Pré-escolar' ? 'selected' : '' }}> Pré-escolar - 4 a 5 anos </option>
                    <option value="1º ano" {{ old('serie') == '1º ano' ? 'selected' : '' }}> 1º ano - Fundamental I </option>
                    <option value="2º ano" {{ old('serie') == '2º ano' ? 'selected' : '' }}> 2º ano - Fundamental I </option>
                    <option value="3º ano" {{ old('serie') == '3º ano' ? 'selected' : '' }}> 3º ano - Fundamental I </option>
                    <option value="4º ano" {{ old('serie') == '4º ano' ? 'selected' : '' }}> 4º ano - Fundamental I </option>
                    <option value="5º ano" {{ old('serie') == '5º ano' ? 'selected' : '' }}> 5º ano - Fundamental I </option>
                    <option value="6º ano" {{ old('serie') == '6º ano' ? 'selected' : '' }}> 6º ano - Fundamental II </option>
                    <option value="7º ano" {{ old('serie')  ==  '7º ano' ? 'selected' : '' }}> 7º ano - Fundamental II </option>
                    <option value="8º ano" {{ old('serie') == '8º ano' ? 'selected' : '' }}> 8º ano - Fundamental II </option>
                    <option value="9º ano" {{ old('serie') == '9º ano' ? 'selected' : '' }}> 9º ano - Fundamental II </option>
                    <option value="1º ano(EJA)" {{ old('serie') == '1º ano(EJA)' ? 'selected' : '' }}> 1º ano - EJA </option>
                    <option value="2º ano(EJA)" {{ old('serie') == '2º ano(EJA)' ? 'selected' : '' }}> 2º ano - EJA </option>
                    <option value="3º ano(EJA)" {{ old('serie') == '3º ano(EJA)' ? 'selected' : '' }}> 3º ano - EJA </option>
                </select>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label for="identificacao">Identifique a turma por meio de uma letra correspondente a sua ordem na escola. (Ex:. a, b ou c)</label>
                <input class="form-control" type="text" name="identificacao" id="identificacao" value="{{ old('identificacao', '') }}" required>
                <span class="help-block"> </span>
            </div>
            @if($auth[0] == 2)
            <div class="form-group">
                <label for="escola_id">{{ trans('cruds.turma.fields.escola') }}</label>
                <select class="form-control select2 {{ $errors->has('escola') ? 'is-invalid' : '' }}" name="escola_id" id="escola_id" required>
                    @foreach($escolas as $id => $entry)
                        <option value="{{ $id }}" {{ old('escola_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>
            @else
            <input type="hidden" class="escola_id" value="{{Auth::user()->team_id}}" for="escola_id" name="escola_id">
            @endif
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
