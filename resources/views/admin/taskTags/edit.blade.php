@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Categoria
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.task-tags.update", [$taskTag->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name"> Titulo </label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $taskTag->name) }}" placeholder="Preencha com um titulo ou assunto relacionado ao evento para fácil associação." required>
                <span class="help-block"> </span>
            </div>

            <div class="form-group">
                <label class="required" for="name"> Cor </label>
                <input class="form-control" type="color" name="color" id="color" value="{{ old('color', $taskTag->color) }}" required>
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
