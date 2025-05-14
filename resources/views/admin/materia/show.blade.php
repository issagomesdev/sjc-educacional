@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Visualizar Disciplina
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.materia.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.materium.fields.id') }}
                        </th>
                        <td>
                            {{ $materium->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.materium.fields.nome_da_materia') }}
                        </th>
                        <td>
                            {{ $materium->nome_da_materia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nivel de Ensino
                        </th>
                        <td>
                            {{ $materium->nivel_de_ensino ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Carga Horária
                        </th>
                        <td>
                            {{ $materium->carga_horaria ?? '' }}h
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Hora/Falta
                        </th>
                        <td>
                            {{ $materium->hora_falta ?? '' }}h
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Por:
                        </th>
                        <td>
                            {{ $materium->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            De:
                        </th>
                        <td>
                            {{ $materium->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $materium->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $materium->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.materia.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
