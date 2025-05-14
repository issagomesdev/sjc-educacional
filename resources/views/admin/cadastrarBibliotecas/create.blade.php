@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cadastrarBiblioteca.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cadastrar-bibliotecas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nome_da_biblioteca">{{ trans('cruds.cadastrarBiblioteca.fields.nome_da_biblioteca') }}</label>
                <input class="form-control {{ $errors->has('nome_da_biblioteca') ? 'is-invalid' : '' }}" type="text" name="nome_da_biblioteca" id="nome_da_biblioteca" value="{{ old('nome_da_biblioteca', '') }}" required>
                @if($errors->has('nome_da_biblioteca'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome_da_biblioteca') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.nome_da_biblioteca_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastrarBiblioteca.fields.localizacao') }}</label>
                @foreach(App\Models\CadastrarBiblioteca::LOCALIZACAO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('localizacao') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="localizacao_{{ $key }}" name="localizacao" value="{{ $key }}" {{ old('localizacao', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="localizacao_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('localizacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('localizacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.localizacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.cadastrarBiblioteca.fields.estado') }}</label>
                <select class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" name="estado" id="estado">
                    <option value disabled {{ old('estado', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CadastrarBiblioteca::ESTADO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('estado', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('estado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.estado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cidade">{{ trans('cruds.cadastrarBiblioteca.fields.cidade') }}</label>
                <input class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" type="text" name="cidade" id="cidade" value="{{ old('cidade', '') }}">
                @if($errors->has('cidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.cidade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bairro">{{ trans('cruds.cadastrarBiblioteca.fields.bairro') }}</label>
                <input class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" type="text" name="bairro" id="bairro" value="{{ old('bairro', '') }}">
                @if($errors->has('bairro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bairro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.bairro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endereco">{{ trans('cruds.cadastrarBiblioteca.fields.endereco') }}</label>
                <input class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" type="text" name="endereco" id="endereco" value="{{ old('endereco', '') }}">
                @if($errors->has('endereco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('endereco') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.endereco_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('domingo') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="domingo" value="0">
                    <input class="form-check-input" type="checkbox" name="domingo" id="domingo" value="1" {{ old('domingo', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="domingo">{{ trans('cruds.cadastrarBiblioteca.fields.domingo') }}</label>
                </div>
                @if($errors->has('domingo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('domingo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.domingo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_1">{{ trans('cruds.cadastrarBiblioteca.fields.horario_1') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_1') ? 'is-invalid' : '' }}" type="text" name="horario_1" id="horario_1" value="{{ old('horario_1') }}">
                @if($errors->has('horario_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_1_2">{{ trans('cruds.cadastrarBiblioteca.fields.horario_1_2') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_1_2') ? 'is-invalid' : '' }}" type="text" name="horario_1_2" id="horario_1_2" value="{{ old('horario_1_2') }}">
                @if($errors->has('horario_1_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_1_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_1_2_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('segunda') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="segunda" value="0">
                    <input class="form-check-input" type="checkbox" name="segunda" id="segunda" value="1" {{ old('segunda', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="segunda">{{ trans('cruds.cadastrarBiblioteca.fields.segunda') }}</label>
                </div>
                @if($errors->has('segunda'))
                    <div class="invalid-feedback">
                        {{ $errors->first('segunda') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.segunda_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_2">{{ trans('cruds.cadastrarBiblioteca.fields.horario_2') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_2') ? 'is-invalid' : '' }}" type="text" name="horario_2" id="horario_2" value="{{ old('horario_2') }}">
                @if($errors->has('horario_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_2_2">{{ trans('cruds.cadastrarBiblioteca.fields.horario_2_2') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_2_2') ? 'is-invalid' : '' }}" type="text" name="horario_2_2" id="horario_2_2" value="{{ old('horario_2_2') }}">
                @if($errors->has('horario_2_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_2_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_2_2_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('terca_feira') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="terca_feira" value="0">
                    <input class="form-check-input" type="checkbox" name="terca_feira" id="terca_feira" value="1" {{ old('terca_feira', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="terca_feira">{{ trans('cruds.cadastrarBiblioteca.fields.terca_feira') }}</label>
                </div>
                @if($errors->has('terca_feira'))
                    <div class="invalid-feedback">
                        {{ $errors->first('terca_feira') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.terca_feira_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_3">{{ trans('cruds.cadastrarBiblioteca.fields.horario_3') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_3') ? 'is-invalid' : '' }}" type="text" name="horario_3" id="horario_3" value="{{ old('horario_3') }}">
                @if($errors->has('horario_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_3_2">{{ trans('cruds.cadastrarBiblioteca.fields.horario_3_2') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_3_2') ? 'is-invalid' : '' }}" type="text" name="horario_3_2" id="horario_3_2" value="{{ old('horario_3_2') }}">
                @if($errors->has('horario_3_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_3_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_3_2_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('quarta_feira') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="quarta_feira" value="0">
                    <input class="form-check-input" type="checkbox" name="quarta_feira" id="quarta_feira" value="1" {{ old('quarta_feira', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="quarta_feira">{{ trans('cruds.cadastrarBiblioteca.fields.quarta_feira') }}</label>
                </div>
                @if($errors->has('quarta_feira'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quarta_feira') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.quarta_feira_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_4">{{ trans('cruds.cadastrarBiblioteca.fields.horario_4') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_4') ? 'is-invalid' : '' }}" type="text" name="horario_4" id="horario_4" value="{{ old('horario_4') }}">
                @if($errors->has('horario_4'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_4') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_4_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_4_2">{{ trans('cruds.cadastrarBiblioteca.fields.horario_4_2') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_4_2') ? 'is-invalid' : '' }}" type="text" name="horario_4_2" id="horario_4_2" value="{{ old('horario_4_2') }}">
                @if($errors->has('horario_4_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_4_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_4_2_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('quinta_feira') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="quinta_feira" value="0">
                    <input class="form-check-input" type="checkbox" name="quinta_feira" id="quinta_feira" value="1" {{ old('quinta_feira', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="quinta_feira">{{ trans('cruds.cadastrarBiblioteca.fields.quinta_feira') }}</label>
                </div>
                @if($errors->has('quinta_feira'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quinta_feira') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.quinta_feira_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_5">{{ trans('cruds.cadastrarBiblioteca.fields.horario_5') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_5') ? 'is-invalid' : '' }}" type="text" name="horario_5" id="horario_5" value="{{ old('horario_5') }}">
                @if($errors->has('horario_5'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_5') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_5_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_5_2">{{ trans('cruds.cadastrarBiblioteca.fields.horario_5_2') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_5_2') ? 'is-invalid' : '' }}" type="text" name="horario_5_2" id="horario_5_2" value="{{ old('horario_5_2') }}">
                @if($errors->has('horario_5_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_5_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_5_2_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('sexta_feira') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="sexta_feira" value="0">
                    <input class="form-check-input" type="checkbox" name="sexta_feira" id="sexta_feira" value="1" {{ old('sexta_feira', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="sexta_feira">{{ trans('cruds.cadastrarBiblioteca.fields.sexta_feira') }}</label>
                </div>
                @if($errors->has('sexta_feira'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sexta_feira') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.sexta_feira_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_6">{{ trans('cruds.cadastrarBiblioteca.fields.horario_6') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_6') ? 'is-invalid' : '' }}" type="text" name="horario_6" id="horario_6" value="{{ old('horario_6') }}">
                @if($errors->has('horario_6'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_6') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_6_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_6_2">{{ trans('cruds.cadastrarBiblioteca.fields.horario_6_2') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_6_2') ? 'is-invalid' : '' }}" type="text" name="horario_6_2" id="horario_6_2" value="{{ old('horario_6_2') }}">
                @if($errors->has('horario_6_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_6_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_6_2_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('sabado') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="sabado" value="0">
                    <input class="form-check-input" type="checkbox" name="sabado" id="sabado" value="1" {{ old('sabado', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="sabado">{{ trans('cruds.cadastrarBiblioteca.fields.sabado') }}</label>
                </div>
                @if($errors->has('sabado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sabado') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.sabado_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_7">{{ trans('cruds.cadastrarBiblioteca.fields.horario_7') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_7') ? 'is-invalid' : '' }}" type="text" name="horario_7" id="horario_7" value="{{ old('horario_7') }}">
                @if($errors->has('horario_7'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_7') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_7_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="horario_7_2">{{ trans('cruds.cadastrarBiblioteca.fields.horario_7_2') }}</label>
                <input class="form-control timepicker {{ $errors->has('horario_7_2') ? 'is-invalid' : '' }}" type="text" name="horario_7_2" id="horario_7_2" value="{{ old('horario_7_2') }}">
                @if($errors->has('horario_7_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('horario_7_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cadastrarBiblioteca.fields.horario_7_2_helper') }}</span>
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
