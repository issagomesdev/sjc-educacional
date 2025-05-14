@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Tipo de Acesso
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.type.fields.id') }}
                        </th>
                        <td>
                            {{ $type->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.type.fields.titulo') }}
                        </th>
                        <td>
                            {{ $type->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.type.fields.sobre') }}
                        </th>
                        <td>
                            {{ $type->sobre }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#tipo_de_acesso_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tipo_de_acesso_users">
            @includeIf('admin.types.relationships.tipoDeAcessoUsers', ['users' => $type->tipoDeAcessoUsers])
        </div>
    </div>
</div>

@endsection
