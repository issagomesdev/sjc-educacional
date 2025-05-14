@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.deslocar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.deslocars.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="ano">{{ trans('cruds.deslocar.fields.ano') }}</label>
                <input class="form-control {{ $errors->has('ano') ? 'is-invalid' : '' }}" type="number" name="ano" id="ano" value="{{ old('ano', '') }}" step="1" required>
                @if($errors->has('ano'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ano') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deslocar.fields.ano_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="profissional_id">{{ trans('cruds.deslocar.fields.profissional') }}</label>
                <select class="form-control select2 {{ $errors->has('profissional') ? 'is-invalid' : '' }}" name="profissional_id" id="profissional_id" required>
                    @foreach($profissionals as $id => $entry)
                        <option value="{{ $id }}" {{ old('profissional_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('profissional'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profissional') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deslocar.fields.profissional_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="institucao_2_id">{{ trans('cruds.deslocar.fields.institucao_2') }}</label>
                <select class="form-control select2 {{ $errors->has('institucao_2') ? 'is-invalid' : '' }}" name="institucao_2_id" id="institucao_2_id" required>
                    @foreach($institucao_2s as $id => $entry)
                        <option value="{{ $id }}" {{ old('institucao_2_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('institucao_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('institucao_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.deslocar.fields.institucao_2_helper') }}</span>
            </div>
            <input type="hidden" class="instituicao" value="{{ $instituicao }}" for="instituicao" name="instituicao">
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
