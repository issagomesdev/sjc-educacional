@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Ano Letivo
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.abrir-e-encerrar-ano-letivos.update", [$abrirEEncerrarAnoLetivo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="ano">Ano</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', $abrirEEncerrarAnoLetivo->ano) }}" step="1" required>
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
