@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.teamType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.team-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.teamType.fields.id') }}
                        </th>
                        <td>
                            {{ $teamType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teamType.fields.titulo') }}
                        </th>
                        <td>
                            {{ $teamType->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teamType.fields.sobre') }}
                        </th>
                        <td>
                            {{ $teamType->sobre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teamType.fields.assinatura') }}
                        </th>
                        <td>
                            {{ $teamType->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.teamType.fields.team') }}
                        </th>
                        <td>
                            {{ $teamType->team->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.team-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection