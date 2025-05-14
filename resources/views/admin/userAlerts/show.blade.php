@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Comunicado
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-alerts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userAlert.fields.id') }}
                        </th>
                        <td>
                            {{ $userAlert->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAlert.fields.alert_text') }}
                        </th>
                        <td>
                            {{ $userAlert->alert_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAlert.fields.texto') }}
                        </th>
                        <td>
                            {!! $userAlert->texto !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAlert.fields.anexos') }}
                        </th>
                        <td>
                            @if($userAlert->anexos)
                                <a href="{{ $userAlert->anexos->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userAlert.fields.user') }}
                        </th>
                        <td>
                            @foreach($userAlert->users as $key => $user)
                                <span class="label label-info">{{ $user->name }},</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $userAlert->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $userAlert->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $userAlert->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $userAlert->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-alerts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
