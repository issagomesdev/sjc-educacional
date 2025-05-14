@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Rematricular Alunos
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rematriculas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="turma_id">{{ trans('cruds.rematricula.fields.turma') }}</label>
                <select class="form-control select2 {{ $errors->has('turma') ? 'is-invalid' : '' }}" name="turma_id" id="turma_id" required>
                  <option value=""> Selecione por favor</option>
                    @foreach($turmas as $turma)
                        <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>{{ $turma->serie }} {{ $turma->identificacao }} - {{ $turma->nivel_da_turma }}</option>
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
                        <option value="{{ $id }}" {{ in_array($id, old('alunos', [])) ? 'selected' : '' }}>{{ $aluno }}</option>
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
                  <option value=""> Selecione por favor</option>
                  @foreach($turmas as $turma)
                      <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>{{ $turma->serie }} {{ $turma->identificacao }} - {{ $turma->nivel_da_turma }}</option>
                  @endforeach
                </select>
                @if($errors->has('turma_nova'))
                    <div class="invalid-feedback">
                        {{ $errors->first('turma_nova') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rematricula.fields.turma_nova_helper') }}</span>
            </div>
            <input type="hidden" class="escola_id" value="{{ $escola }}" for="escola_id" name="escola_id">
            <input type="hidden" class="ano" value="{{ $ano }}" for="ano" name="ano">
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
