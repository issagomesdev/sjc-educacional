@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.notum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nota.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.id') }}
                        </th>
                        <td>
                            {{ $notum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.disciplina') }}
                        </th>
                        <td>
                            {{ $notum->disciplina->nome_da_materia ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.escola') }}
                        </th>
                        <td>
                            {{ $notum->escola->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.turma') }}
                        </th>
                        <td>
                            {{ $notum->turma->ano_serie ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.alunos') }}
                        </th>
                        <td>
                            {{ $notum->alunos->nome_completo ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.unidade_1') }}
                        </th>
                        <td>
                            {{ $notum->unidade_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.unidade_2') }}
                        </th>
                        <td>
                            {{ $notum->unidade_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.unidade_1_rec') }}
                        </th>
                        <td>
                            {{ $notum->unidade_1_rec }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.unidade_2_rec') }}
                        </th>
                        <td>
                            {{ $notum->unidade_2_rec }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.unidade_3') }}
                        </th>
                        <td>
                            {{ $notum->unidade_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.unidade_4') }}
                        </th>
                        <td>
                            {{ $notum->unidade_4 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.unidade_3_rec') }}
                        </th>
                        <td>
                            {{ $notum->unidade_3_rec }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.unidade_4_rec') }}
                        </th>
                        <td>
                            {{ $notum->unidade_4_rec }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.media_anual') }}
                        </th>
                        <td>
                            {{ $notum->media_anual }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.nota_da_rec_final') }}
                        </th>
                        <td>
                            {{ $notum->nota_da_rec_final }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.media_apos_rec_final') }}
                        </th>
                        <td>
                            {{ $notum->media_apos_rec_final }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.conselho_de_classe') }}
                        </th>
                        <td>
                            {{ $notum->conselho_de_classe }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.media_final') }}
                        </th>
                        <td>
                            {{ $notum->media_final }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.team') }}
                        </th>
                        <td>
                            {{ $notum->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.assinatura') }}
                        </th>
                        <td>
                            {{ $notum->assinatura->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.created_at') }}
                        </th>
                        <td>
                            {{ $notum->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.notum.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $notum->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nota.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection