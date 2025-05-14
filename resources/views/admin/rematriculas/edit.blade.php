@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.rematricula.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rematriculas.update", [$rematricula->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="ano">{{ trans('cruds.rematricula.fields.ano') }}</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', $rematricula->ano) }}" step="1" required>
                @if($errors->has('ano'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rematricula.fields.ano_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="escola_id">{{ trans('cruds.rematricula.fields.escola') }}</label>
                <select class="form-control select2 {{ $errors->has('escola') ? 'is-invalid' : '' }}" name="escola_id" id="escola_id" required>
                    @foreach($escolas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('escola_id') ? old('escola_id') : $rematricula->escola->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('escola'))
                    <div class="invalid-feedback">
                        {{ $errors->first('escola') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rematricula.fields.escola_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="turma_id">{{ trans('cruds.rematricula.fields.turma') }}</label>
                <select class="form-control select2 {{ $errors->has('turma') ? 'is-invalid' : '' }}" name="turma_id" id="turma_id" required>
                    @foreach($turmas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('turma_id') ? old('turma_id') : $rematricula->turma->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('turma'))
                    <div class="invalid-feedback">
                        {{ $errors->first('turma') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rematricula.fields.turma_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="alunos">{{ trans('cruds.rematricula.fields.alunos') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('alunos') ? 'is-invalid' : '' }}" name="alunos[]" id="alunos" multiple required>
                    @foreach($alunos as $id => $aluno)
                        <option value="{{ $id }}" {{ (in_array($id, old('alunos', [])) || $rematricula->alunos->contains($id)) ? 'selected' : '' }}>{{ $aluno }}</option>
                    @endforeach
                </select>
                @if($errors->has('alunos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alunos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rematricula.fields.alunos_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="turma_nova_id">{{ trans('cruds.rematricula.fields.turma_nova') }}</label>
                <select class="form-control select2 {{ $errors->has('turma_nova') ? 'is-invalid' : '' }}" name="turma_nova_id" id="turma_nova_id" required>
                    @foreach($turma_novas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('turma_nova_id') ? old('turma_nova_id') : $rematricula->turma_nova->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('turma_nova'))
                    <div class="invalid-feedback">
                        {{ $errors->first('turma_nova') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rematricula.fields.turma_nova_helper') }}</span>
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