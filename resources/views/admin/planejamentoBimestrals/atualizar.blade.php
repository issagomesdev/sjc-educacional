@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Proposta
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.planejamento-bimestrals.up') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label> Situação </label>
                <select class="form-control {{ $errors->has('situacao') ? 'is-invalid' : '' }}" name="situacao" id="situacao">
                    <option value disabled {{ old('situacao', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PlanejamentoBimestral::APROVAR_DESAPROVAR as $key => $label)
                        <option value="{{ $key }}" {{ old('situacao', $planejamentoBimestral->situacao) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" class="id" value="{{$id}}" for="id" name="id">
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Proximo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
        window.close();
    }
</script>

@endsection
