@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Dispensar Turma
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.dispensas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="ano">{{ trans('cruds.dispensa.fields.ano') }}</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', '') }}" step="1" required>
                @if($errors->has('ano'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dispensa.fields.ano_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.dispensa.fields.tipo_de_dispensa') }}</label>
                @foreach(App\Models\Dispensa::TIPO_DE_DISPENSA_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('tipo_de_dispensa') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="tipo_de_dispensa_{{ $key }}" name="tipo_de_dispensa" value="{{ $key }}" {{ old('tipo_de_dispensa', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="tipo_de_dispensa_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('tipo_de_dispensa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo_de_dispensa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dispensa.fields.tipo_de_dispensa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="disciplinas">{{ trans('cruds.dispensa.fields.disciplinas') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('disciplinas') ? 'is-invalid' : '' }}" name="disciplinas[]" id="disciplinas" multiple required>
                    @foreach($disciplinas as $id => $disciplina)
                        <option value="{{ $id }}" {{ in_array($id, old('disciplinas', [])) ? 'selected' : '' }}>{{ $disciplina }}</option>
                    @endforeach
                </select>
                @if($errors->has('disciplinas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disciplinas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dispensa.fields.disciplinas_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="motivo">{{ trans('cruds.dispensa.fields.motivo') }}</label>
                <input class="form-control {{ $errors->has('motivo') ? 'is-invalid' : '' }}" type="text" name="motivo" id="motivo" value="{{ old('motivo', '') }}" required>
                @if($errors->has('motivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('motivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dispensa.fields.motivo_helper') }}</span>
            </div>
            @if($auth[0] == 2)
            <div class="form-group">
                <label for="escola_id">{{ trans('cruds.dispensa.fields.escola') }}</label>
                <select class="form-control select2 {{ $errors->has('escola') ? 'is-invalid' : '' }}" name="escola_id" id="escola_id" required>
                    @foreach($escolas as $id => $entry)
                        <option value="{{ $id }}" {{ old('escola_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('escola'))
                    <div class="invalid-feedback">
                        {{ $errors->first('escola') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dispensa.fields.escola_helper') }}</span>
            </div>
            @else
            <input type="hidden" class="escola_id" value="{{Auth::user()->team_id}}" for="escola_id" name="escola_id">
            @endif
            <div class="form-group">
                <label for="turma_id">{{ trans('cruds.dispensa.fields.turma') }}</label>
                <select class="form-control select2 {{ $errors->has('turma') ? 'is-invalid' : '' }}" name="turma_id" id="turma_id" required>
                  <option value="">Selecione por favor</option>
                    @foreach($turmas as $tur)
                        <option value="{{ $tur->id }}" {{ old('turma_id') == $tur->id ? 'selected' : '' }}>{{ $tur->serie }} {{ $tur->identificacao }}</option>
                    @endforeach
                </select>
                @if($errors->has('turma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('turma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dispensa.fields.turma_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alunos">{{ trans('cruds.dispensa.fields.alunos') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('alunos') ? 'is-invalid' : '' }}" name="alunos[]" id="alunos" multiple required>
                    @foreach($alunos as $id => $aluno)
                        <option value="{{ $id }}" {{ in_array($id, old('alunos', [])) ? 'selected' : '' }}>{{ $aluno }}</option>
                    @endforeach
                </select>
                @if($errors->has('alunos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alunos') }}
                    </div>
                @endif
                <span class="help-block"> selecione todos os alunos da turma ou especifique de acordo com a situação.</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('bimestre_1') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="bimestre_1" value="0">
                    <input class="form-check-input" type="checkbox" name="bimestre_1" id="bimestre_1" value="1" {{ old('bimestre_1', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="bimestre_1">{{ trans('cruds.dispensa.fields.bimestre_1') }}</label>
                </div>
                <span class="help-block">{{ trans('cruds.dispensa.fields.bimestre_1_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('bimestre_2') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="bimestre_2" value="0">
                    <input class="form-check-input" type="checkbox" name="bimestre_2" id="bimestre_2" value="1" {{ old('bimestre_2', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="bimestre_2">{{ trans('cruds.dispensa.fields.bimestre_2') }}</label>
                </div>
                <span class="help-block">{{ trans('cruds.dispensa.fields.bimestre_2_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('bimestre_3') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="bimestre_3" value="0">
                    <input class="form-check-input" type="checkbox" name="bimestre_3" id="bimestre_3" value="1" {{ old('bimestre_3', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="bimestre_3">{{ trans('cruds.dispensa.fields.bimestre_3') }}</label>
                </div>
                <span class="help-block">{{ trans('cruds.dispensa.fields.bimestre_3_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('bimestre_4') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="bimestre_4" value="0">
                    <input class="form-check-input" type="checkbox" name="bimestre_4" id="bimestre_4" value="1" {{ old('bimestre_4', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="bimestre_4">{{ trans('cruds.dispensa.fields.bimestre_4') }}</label>
                </div>
                <span class="help-block">{{ trans('cruds.dispensa.fields.bimestre_4_helper') }}</span>
            </div>
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
