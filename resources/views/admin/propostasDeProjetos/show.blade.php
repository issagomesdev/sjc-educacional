@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.propostasDeProjeto.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.propostas-de-projetos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.id') }}
                        </th>
                        <td>
                            {{ $propostasDeProjeto->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.titulo') }}
                        </th>
                        <td>
                            {{ $propostasDeProjeto->titulo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.resumo') }}
                        </th>
                        <td>
                            {!! $propostasDeProjeto->resumo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.autor') }}
                        </th>
                        <td>
                            {{ $propostasDeProjeto->autor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.publico_alvo') }}
                        </th>
                        <td>
                            {{ App\Models\PropostasDeProjeto::PUBLICO_ALVO_SELECT[$propostasDeProjeto->publico_alvo] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.area_de_conhecimento') }}
                        </th>
                        <td>
                            {{ $propostasDeProjeto->area_de_conhecimento }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.objetivo') }}
                        </th>
                        <td>
                            {!! $propostasDeProjeto->objetivo !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.metodologia') }}
                        </th>
                        <td>
                            {{ $propostasDeProjeto->metodologia }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.finalidade') }}
                        </th>
                        <td>
                            {{ $propostasDeProjeto->finalidade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.aceito') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $propostasDeProjeto->aceito ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.situacao_do_projeto') }}
                        </th>
                        <td>
                            {{ App\Models\PropostasDeProjeto::SITUACAO_DO_PROJETO_SELECT[$propostasDeProjeto->situacao_do_projeto] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.team') }}
                        </th>
                        <td>
                            {{ $propostasDeProjeto->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.assinatura') }}
                        </th>
                        <td>
                            {{ $propostasDeProjeto->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.created_at') }}
                        </th>
                        <td>
                            {{ $propostasDeProjeto->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.propostasDeProjeto.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $propostasDeProjeto->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.propostas-de-projetos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection