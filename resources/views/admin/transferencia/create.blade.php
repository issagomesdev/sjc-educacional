@extends('layouts.admin')
@section('content')

@if($tipo_de_transferencia == 3)
<div class="card">
    <div class="card-header">
        Transferência de Turma
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transferencia.turma.up") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="aluno_id">Aluno</label>
                <select class="form-control select2" name="aluno_id" id="aluno_id" required>
                  <option value=""> Selecione por favor</option>
                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>{{ $aluno->nome_completo }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="turma_id">Turma de destino</label>
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

            <input type="hidden" class="escola_id" value="{{ $escola }}" for="escola_id" name="escola_id">
            <input type="hidden" class="ano" value="{{ $ano }}" for="ano" name="ano">
            <input type="hidden" class="tipo_de_transferencia" value="{{ $tipo_de_transferencia }}" for="tipo_de_transferencia" name="tipo_de_transferencia">
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

@endif

@if($tipo_de_transferencia == 2)
<div class="card">
    <div class="card-header">
        Transferência Externa
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transferencia.externa.up") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="aluno_id">Aluno</label>
                <select class="form-control select2" name="aluno_id" id="aluno_id" required>
                  <option value=""> Selecione por favor</option>
                    @foreach($alunos2 as $aluno)
                        <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>{{ $aluno->nome_completo }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>
            <input type="hidden" class="escola_id" value="{{ $escola }}" for="escola_id" name="escola_id">
            <input type="hidden" class="ano" value="{{ $ano }}" for="ano" name="ano">
            <input type="hidden" class="tipo_de_transferencia" value="{{ $tipo_de_transferencia }}" for="tipo_de_transferencia" name="tipo_de_transferencia">
            <input type="hidden" class="assinatura_id" value="{{Auth::user()->id}}" for="assinatura_id" name="assinatura_id">
            <input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endif

@if($tipo_de_transferencia == 1)
<div class="card">
    <div class="card-header">
        Transferência Interna
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transferencia.interna.up") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="aluno_id">Aluno</label>
                <select class="form-control select2" name="aluno_id" id="aluno_id" required>
                  <option value=""> Selecione por favor</option>
                    @foreach($alunos2 as $aluno)
                        <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>{{ $aluno->nome_completo }}</option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="escola_id"> Escola de Destino </label>
                <select class="form-control select2" name="escola_id" id="escola_id" required>
                  <option value=""> Selecione por favor</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ old('escola_id') == $team->id ? 'selected' : '' }}> {{ $team->name }} </option>
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>

            <input type="hidden" class="ano" value="{{ $ano }}" for="ano" name="ano">
            <input type="hidden" class="tipo_de_transferencia" value="{{ $tipo_de_transferencia }}" for="tipo_de_transferencia" name="tipo_de_transferencia">
            <input type="hidden" class="assinatura_id" value="{{Auth::user()->id}}" for="assinatura_id" name="assinatura_id">
            <input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endif

@endsection
