@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.transferencium.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transferencia.update", [$transferencium->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="ano">{{ trans('cruds.transferencium.fields.ano') }}</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', $transferencium->ano) }}" step="1">
                @if($errors->has('ano'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transferencium.fields.ano_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="escola_anterior_id">{{ trans('cruds.transferencium.fields.escola_anterior') }}</label>
                <select class="form-control select2 {{ $errors->has('escola_anterior') ? 'is-invalid' : '' }}" name="escola_anterior_id" id="escola_anterior_id" required>
                    @foreach($escola_anteriors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('escola_anterior_id') ? old('escola_anterior_id') : $transferencium->escola_anterior->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('escola_anterior'))
                    <div class="invalid-feedback">
                        {{ $errors->first('escola_anterior') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transferencium.fields.escola_anterior_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="turma_anterior_id">{{ trans('cruds.transferencium.fields.turma_anterior') }}</label>
                <select class="form-control select2 {{ $errors->has('turma_anterior') ? 'is-invalid' : '' }}" name="turma_anterior_id" id="turma_anterior_id" required>
                    @foreach($turma_anteriors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('turma_anterior_id') ? old('turma_anterior_id') : $transferencium->turma_anterior->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('turma_anterior'))
                    <div class="invalid-feedback">
                        {{ $errors->first('turma_anterior') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transferencium.fields.turma_anterior_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="alunos">{{ trans('cruds.transferencium.fields.aluno') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('alunos') ? 'is-invalid' : '' }}" name="alunos[]" id="alunos" multiple required>
                    @foreach($alunos as $id => $aluno)
                        <option value="{{ $id }}" {{ (in_array($id, old('alunos', [])) || $transferencium->alunos->contains($id)) ? 'selected' : '' }}>{{ $aluno }}</option>
                    @endforeach
                </select>
                @if($errors->has('alunos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alunos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transferencium.fields.aluno_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="escola_id">{{ trans('cruds.transferencium.fields.escola') }}</label>
                <select class="form-control select2 {{ $errors->has('escola') ? 'is-invalid' : '' }}" name="escola_id" id="escola_id" required>
                    @foreach($escolas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('escola_id') ? old('escola_id') : $transferencium->escola->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('escola'))
                    <div class="invalid-feedback">
                        {{ $errors->first('escola') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transferencium.fields.escola_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="turma_de_destino_id">{{ trans('cruds.transferencium.fields.turma_de_destino') }}</label>
                <select class="form-control select2 {{ $errors->has('turma_de_destino') ? 'is-invalid' : '' }}" name="turma_de_destino_id" id="turma_de_destino_id">
                    @foreach($turma_de_destinos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('turma_de_destino_id') ? old('turma_de_destino_id') : $transferencium->turma_de_destino->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('turma_de_destino'))
                    <div class="invalid-feedback">
                        {{ $errors->first('turma_de_destino') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.transferencium.fields.turma_de_destino_helper') }}</span>
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