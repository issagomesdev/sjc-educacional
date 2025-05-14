@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.propostasDeAula.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.propostas-de-aulas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.id') }}
                        </th>
                        <td>
                            {{ $propostasDeAula->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.titulo') }}
                        </th>
                        <td>
                            {{ $propostasDeAula->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.resumo') }}
                        </th>
                        <td>
                            {!! $propostasDeAula->resumo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.autor') }}
                        </th>
                        <td>
                            {{ $propostasDeAula->autor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.publico_alvo') }}
                        </th>
                        <td>
                            {{ App\Models\PropostasDeAula::PUBLICO_ALVO_SELECT[$propostasDeAula->publico_alvo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.area_de_conhecimento') }}
                        </th>
                        <td>
                            {{ $propostasDeAula->area_de_conhecimento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.objetivo') }}
                        </th>
                        <td>
                            {!! $propostasDeAula->objetivo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.metodologia') }}
                        </th>
                        <td>
                            {{ $propostasDeAula->metodologia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.finalidade') }}
                        </th>
                        <td>
                            {{ $propostasDeAula->finalidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.aceito') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $propostasDeAula->aceito ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.situacao_do_projeto') }}
                        </th>
                        <td>
                            {{ App\Models\PropostasDeAula::SITUACAO_DO_PROJETO_SELECT[$propostasDeAula->situacao_do_projeto] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.team') }}
                        </th>
                        <td>
                            {{ $propostasDeAula->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.assinatura') }}
                        </th>
                        <td>
                            {{ $propostasDeAula->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.created_at') }}
                        </th>
                        <td>
                            {{ $propostasDeAula->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeAula.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $propostasDeAula->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.propostas-de-aulas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection