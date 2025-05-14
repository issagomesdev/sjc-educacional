@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Tipo de Profissional
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tipo-de-profissionals.update", [$tipoDeProfissional->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="titulo">{{ trans('cruds.tipoDeProfissional.fields.titulo') }}</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" value="{{ old('titulo', $tipoDeProfissional->titulo) }}">
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoDeProfissional.fields.titulo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sobre">{{ trans('cruds.tipoDeProfissional.fields.sobre') }}</label>
                <input class="form-control {{ $errors->has('sobre') ? 'is-invalid' : '' }}" type="text" name="sobre" id="sobre" value="{{ old('sobre', $tipoDeProfissional->sobre) }}">
                @if($errors->has('sobre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sobre') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoDeProfissional.fields.sobre_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.tipoDeProfissional.fields.educador') }}</label>
                @foreach(App\Models\TipoDeProfissional::EDUCADOR_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('educador') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="educador_{{ $key }}" name="educador" value="{{ $key }}" {{ old('educador', $tipoDeProfissional->educador) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="educador_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('educador'))
                    <div class="invalid-feedback">
                        {{ $errors->first('educador') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tipoDeProfissional.fields.educador_helper') }}</span>
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
