@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Usuário
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="foto_de_perfil"> Foto de Perfil </label>
                <div class="needsclick dropzone {{ $errors->has('foto_de_perfil') ? 'is-invalid' : '' }}" id="foto_de_perfil-dropzone">
                </div>
                @if($errors->has('foto_de_perfil'))
                    <div class="invalid-feedback">
                        {{ $errors->first('foto_de_perfil') }}
                    </div>
                @endif
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
              @if($autht[0] == 2)
            <div class="form-group">
                <label class="required" for="tipo_de_acessos">{{ trans('cruds.user.fields.tipo_de_acesso') }}</label>
                <select class="form-control selectd {{ $errors->has('tipo_de_acessos') ? 'is-invalid' : '' }}" name="tipo_de_acessos" id="tipo_de_acessos" required>
                    @foreach($tipo_de_acessos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('tipo_de_acessos') ? old('tipo_de_acessos') : $user->tipo_de_acessos->contains($id)) ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                <span class="help-block">{{ trans('cruds.user.fields.tipo_de_acesso_helper') }}</span>
            </div>
            @endif
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.situacao') }}</label>
                <select class="form-control {{ $errors->has('situacao') ? 'is-invalid' : '' }}" name="situacao" id="situacao" required>
                    <option value disabled {{ old('situacao', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::SITUACAO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('situacao', $user->situacao) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('situacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('situacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.situacao_helper') }}</span>
            </div>
            @if($autht[0] == 2)
            <div class="form-group">
                <label class="required" for="team_id"> Instituição </label>
                <select class="form-control select2 {{ $errors->has('team') ? 'is-invalid' : '' }}" name="team_id" id="team_id" required>
                    @foreach($teams as $id => $entry)
                        <option value="{{ $id }}" {{ (old('team_id') ? old('team_id') : $user->team->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
            </div>
            @else
            <div class="form-group">
                <label class="required" for="team_id"> Instituição </label>
                <select class="form-control select2 {{ $errors->has('team') ? 'is-invalid' : '' }}" name="team_id" id="team_id" required>
                    @foreach($yout as $id => $entry)
                        <option value="{{ $id }}" {{ (old('team_id') ? old('team_id') : $user->team->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
            </div>
            @endif
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    Dropzone.options.fotoDePerfilDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="foto_de_perfil"]').remove()
      $('form').append('<input type="hidden" name="foto_de_perfil" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="foto_de_perfil"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->foto_de_perfil)
      var file = {!! json_encode($user->foto_de_perfil) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="foto_de_perfil" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection
