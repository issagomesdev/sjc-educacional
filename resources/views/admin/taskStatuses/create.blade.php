@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.taskStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.task-statuses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taskStatus.fields.name') }}</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" placeholder="Preencha com Aberto/Fechado/Em Andamento ou similares de acordo com necessidade." required>
                <span class="help-block"> </span>
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
