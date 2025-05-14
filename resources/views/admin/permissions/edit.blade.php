@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.permission.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.permissions.update", [$permission->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="finalidade">{{ trans('cruds.permission.fields.finalidade') }}</label>
                <input class="form-control {{ $errors->has('finalidade') ? 'is-invalid' : '' }}" type="text" name="finalidade" id="finalidade" value="{{ old('finalidade', $permission->finalidade) }}">
                @if($errors->has('finalidade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('finalidade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.permission.fields.finalidade_helper') }}</span>
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