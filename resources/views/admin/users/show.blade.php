@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table id="example" class="table table-striped table-hover table-bordered">
              <thead>
                  <tr>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 100%;" aria-sort="none"> </th>
                    <th class="sorting sorting_desc" tabindex="0" aria-controls="export" rowspan="1" colspan="1" aria-label=" " style="width: 100%;" aria-sort="none"> </th>
                  </tr>
                <tbody>
                  <tr>
                      <th style="background-color: white;">
                        @if($user->foto_de_perfil)
                            <a href="{{ $user->foto_de_perfil->getUrl() }}" target="_blank" style="display: inline-block">
                                <img src="{{ $user->foto_de_perfil->getUrl() }}" style=" width: 200px; height: auto;">
                            </a>
                            @else
                            <a href="{{ url('null/nullphoto.png') }}" target="_blank" style="display: inline-block">
                                <img src="{{ url('null/nullphoto.png') }}" style=" width: 200px; height: auto;">
                            </a>
                        @endif
                   </th>
                    <td style="background-color: white;"> </td>
                    </tr>
                  <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.tipo_de_acesso') }}
                        </th>
                        <td>
                            @foreach($user->tipo_de_acessos as $key => $tipo_de_acesso)
                                <span class="label label-info">{{ $tipo_de_acesso->titulo }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.situacao') }}
                        </th>
                        <td>
                            {{ App\Models\User::SITUACAO_SELECT[$user->situacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Instituição
                        </th>
                        <td>
                            {{ $user->team->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Criado em
                        </th>
                        <td>
                            {{ $user->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Atualizado em
                        </th>
                        <td>
                            {{ $user->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#e_mail_do_usuario_secretaria" role="tab" data-toggle="tab">
                {{ trans('cruds.secretarium.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assinatura_documentos" role="tab" data-toggle="tab">
                {{ trans('cruds.documento.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#e_mail_de_usuario_direcaos" role="tab" data-toggle="tab">
                {{ trans('cruds.direcao.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#email_do_usuario_educadores" role="tab" data-toggle="tab">
                {{ trans('cruds.educadore.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assinatura_cadastrar_bibliotecas" role="tab" data-toggle="tab">
                {{ trans('cruds.cadastrarBiblioteca.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#email_do_aluno_cadastros" role="tab" data-toggle="tab">
                {{ trans('cruds.cadastro.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#assinatura_permissions" role="tab" data-toggle="tab">
                {{ trans('cruds.permission.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#e_mail_de_usuario_usuarios_especiais" role="tab" data-toggle="tab">
                {{ trans('cruds.usuariosEspeciai.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="e_mail_do_usuario_secretaria">
            @includeIf('admin.users.relationships.eMailDoUsuarioSecretaria', ['secretaria' => $user->eMailDoUsuarioSecretaria])
        </div>
        <div class="tab-pane" role="tabpanel" id="assinatura_documentos">
            @includeIf('admin.users.relationships.assinaturaDocumentos', ['documentos' => $user->assinaturaDocumentos])
        </div>
        <div class="tab-pane" role="tabpanel" id="e_mail_de_usuario_direcaos">
            @includeIf('admin.users.relationships.eMailDeUsuarioDirecaos', ['direcaos' => $user->eMailDeUsuarioDirecaos])
        </div>
        <div class="tab-pane" role="tabpanel" id="email_do_usuario_educadores">
            @includeIf('admin.users.relationships.emailDoUsuarioEducadores', ['educadores' => $user->emailDoUsuarioEducadores])
        </div>
        <div class="tab-pane" role="tabpanel" id="assinatura_cadastrar_bibliotecas">
            @includeIf('admin.users.relationships.assinaturaCadastrarBibliotecas', ['cadastrarBibliotecas' => $user->assinaturaCadastrarBibliotecas])
        </div>
        <div class="tab-pane" role="tabpanel" id="email_do_aluno_cadastros">
            @includeIf('admin.users.relationships.emailDoAlunoCadastros', ['cadastros' => $user->emailDoAlunoCadastros])
        </div>
        <div class="tab-pane" role="tabpanel" id="assinatura_permissions">
            @includeIf('admin.users.relationships.assinaturaPermissions', ['permissions' => $user->assinaturaPermissions])
        </div>
        <div class="tab-pane" role="tabpanel" id="e_mail_de_usuario_usuarios_especiais">
            @includeIf('admin.users.relationships.eMailDeUsuarioUsuariosEspeciais', ['usuariosEspeciais' => $user->eMailDeUsuarioUsuariosEspeciais])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script>

    $(document).ready( function() {
$('#example').dataTable( {

"lengthMenu": [[ -1, 10, 25, 50], ["All", 10, 25, 50]],
dom: 'B',
order: [],
buttons: [

        {
            extend: 'copy',
            text: 'Copiar'
        },

        {
            extend: 'excel',
            text: 'Excel'
        },

        {
            extend: 'csv',
            text: 'CSV'
        },

        {
            extend: 'pdf',
            text: 'PDF'
        },

        {
            extend: 'print',
            text: 'Imprimir',
            autoPrint: true
        }
    ],
} );
} );

$(document).ready(function() {
var oTable = $('#example').dataTable();

// Highlight every second row
oTable.$('oOpts.order=current');
} );



</script>

<style>

table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting {
    padding: 10px;
    opacity: 0; }

  table.dataTable.no-footer {
    border-bottom:1px solid #d8dbe0; }

    .dataTables_filter {
      display: none; }


.table-bordered, .table-bordered td, .table-bordered th {
border: 1px solid;
border-color: #ffffff;
}


input.chk {
    margin: 10px;
    width: 50px;
    height: 16px;
}

td {
    width: 50%;
}

</style>

@endsection
