@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Enturmar Aluno
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.enturmacao.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="aluno_id">{{ trans('cruds.matricula.fields.aluno') }}</label>
                <select class="form-control select2 {{ $errors->has('aluno') ? 'is-invalid' : '' }}" name="aluno_id" id="aluno_id" required>
                    @foreach($alunos as $id => $entry)
                        <option value="{{ $id }}" {{ old('aluno_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('aluno'))
                    <div class="invalid-feedback">
                        {{ $errors->first('aluno') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.matricula.fields.aluno_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="turma_id">{{ trans('cruds.matricula.fields.turma') }}</label>
                <select class="form-control select2" name="turma_id" id="turma_id" required>
                  <option value="">Selecione por favor</option>
                    @foreach($turmas as $tur)
                    @foreach($vagas as $va)
                    @if($va->turma_id == $tur->id)
                    @if($va->total_de_vadas > count($va->vagas))
                        <option value="{{ $tur->id }}" {{ old('turma_id') == $tur->id ? 'selected' : '' }}>{{ $tur->serie }}
                          {{ $tur->identificacao }} - {{ $tur->nivel_da_turma }} | {{$va->total_de_vadas}}/{{ $va->vagas->count(); }} ({{ $tur->turno}})
                     </option>
                     @endif

                     @if($va->total_de_vadas <= count($va->vagas))
                         <option disabled="disabled" value="{{ $tur->id }}" {{ old('turma_id') == $tur->id ? 'selected' : '' }}>{{ $tur->serie }}
                           {{ $tur->identificacao }} - {{ $tur->nivel_da_turma }} | {{$va->total_de_vadas}}/{{ $va->vagas->count(); }} ({{ $tur->turno}})
                      </option>
                      @endif

                     @endif
                    @endforeach
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>
            <input type="hidden" class="ano" value="{{ $ano }}" for="ano_id" name="ano_id">
            <input type="hidden" class="escola_id" value="{{ $escola }}" for="escola_id" name="escola_id">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style media="screen">

li.tur {
    list-style: none;
    margin-left: -35px;
}

</style>

@endsection
