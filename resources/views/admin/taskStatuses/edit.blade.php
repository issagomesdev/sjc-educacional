@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Progresso
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.task-statuses.update", [$taskStatus->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taskStatus.fields.name') }}</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $taskStatus->name) }}" required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="name"> Cor </label>
                <input class="form-control" type="color" name="color" id="color" value="{{ old('color', $taskStatus->color) }}" required>
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
