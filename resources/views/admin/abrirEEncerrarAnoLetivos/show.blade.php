@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.abrirEEncerrarAnoLetivo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.abrir-e-encerrar-ano-letivos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.abrirEEncerrarAnoLetivo.fields.id') }}
                        </th>
                        <td>
                            {{ $abrirEEncerrarAnoLetivo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.abrirEEncerrarAnoLetivo.fields.ano') }}
                        </th>
                        <td>
                            {{ $abrirEEncerrarAnoLetivo->ano }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.abrirEEncerrarAnoLetivo.fields.abrir_encerrar') }}
                        </th>
                        <td>
                            {{ App\Models\AbrirEEncerrarAnoLetivo::ABRIR_ENCERRAR_SELECT[$abrirEEncerrarAnoLetivo->abrir_encerrar] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.abrirEEncerrarAnoLetivo.fields.instituicao') }}
                        </th>
                        <td>
                            {{ $abrirEEncerrarAnoLetivo->instituicao->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.abrirEEncerrarAnoLetivo.fields.assinatura') }}
                        </th>
                        <td>
                            {{ $abrirEEncerrarAnoLetivo->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.abrirEEncerrarAnoLetivo.fields.team') }}
                        </th>
                        <td>
                            {{ $abrirEEncerrarAnoLetivo->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.abrirEEncerrarAnoLetivo.fields.created_at') }}
                        </th>
                        <td>
                            {{ $abrirEEncerrarAnoLetivo->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.abrirEEncerrarAnoLetivo.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $abrirEEncerrarAnoLetivo->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.abrir-e-encerrar-ano-letivos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection