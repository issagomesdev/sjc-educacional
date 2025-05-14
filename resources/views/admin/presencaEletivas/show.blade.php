@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.presencaEletiva.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.presenca-eletivas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.id') }}
                        </th>
                        <td>
                            {{ $presencaEletiva->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.data') }}
                        </th>
                        <td>
                            {{ $presencaEletiva->data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.disciplina') }}
                        </th>
                        <td>
                            {{ $presencaEletiva->disciplina->nome_da_materia ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.bimestre') }}
                        </th>
                        <td>
                            {{ App\Models\PresencaEletiva::BIMESTRE_SELECT[$presencaEletiva->bimestre] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.escola') }}
                        </th>
                        <td>
                            {{ $presencaEletiva->escola->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.turmas') }}
                        </th>
                        <td>
                            {{ $presencaEletiva->turmas->ano_serie ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.alunos') }}
                        </th>
                        <td>
                            {{ $presencaEletiva->alunos->nome_completo ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.selecione_falta') }}
                        </th>
                        <td>
                            {{ App\Models\PresencaEletiva::SELECIONE_FALTA_RADIO[$presencaEletiva->selecione_falta] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.selecionar_motivo') }}
                        </th>
                        <td>
                            {{ App\Models\PresencaEletiva::SELECIONAR_MOTIVO_SELECT[$presencaEletiva->selecionar_motivo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.team') }}
                        </th>
                        <td>
                            {{ $presencaEletiva->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.assinatura') }}
                        </th>
                        <td>
                            {{ $presencaEletiva->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.created_at') }}
                        </th>
                        <td>
                            {{ $presencaEletiva->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.presencaEletiva.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $presencaEletiva->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.presenca-eletivas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
