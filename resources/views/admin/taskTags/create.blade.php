@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Criar Categoria
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.task-tags.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name"> Titulo </label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" placeholder="Preencha com um titulo ou assunto relacionado ao evento para fácil associação." required>
            </div>

            <div class="form-group">
                <label class="required" for="name"> Cor </label>
                <input class="form-control" type="color" name="color" id="color" value="#ffffff" required>
            </div>

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
