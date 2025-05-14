@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
      Atualizar Empréstimo de Livro
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.emprestimos-e-devolucos.update", [$emprestimosEDevoluco->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="usuario_da_biblioteca_id">{{ trans('cruds.emprestimosEDevoluco.fields.usuario_da_biblioteca') }}</label>
                <select class="form-control select2 {{ $errors->has('usuario_da_biblioteca') ? 'is-invalid' : '' }}" name="usuario_da_biblioteca_id" id="usuario_da_biblioteca_id">
                    @foreach($usuario_da_bibliotecas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('usuario_da_biblioteca_id') ? old('usuario_da_biblioteca_id') : $emprestimosEDevoluco->usuario_da_biblioteca->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('usuario_da_biblioteca'))
                    <div class="invalid-feedback">
                        {{ $errors->first('usuario_da_biblioteca') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.emprestimosEDevoluco.fields.usuario_da_biblioteca_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="biblioteca_id">{{ trans('cruds.emprestimosEDevoluco.fields.biblioteca') }}</label>
                <select class="form-control select2 {{ $errors->has('biblioteca') ? 'is-invalid' : '' }}" name="biblioteca_id" id="biblioteca_id">
                    @foreach($bibliotecas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('biblioteca_id') ? old('biblioteca_id') : $emprestimosEDevoluco->biblioteca->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('biblioteca'))
                    <div class="invalid-feedback">
                        {{ $errors->first('biblioteca') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.emprestimosEDevoluco.fields.biblioteca_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="livros">{{ trans('cruds.emprestimosEDevoluco.fields.livros') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('livros') ? 'is-invalid' : '' }}" name="livros[]" id="livros" multiple>
                  
                  <?php use App\Models\EmprestimosEDevoluco; ?>

                    @foreach($livros as $livro)
                    <?php

                    $table = DB::table('cadastrar_livro_emprestimos_e_devoluco')
                    ->where('cadastrar_livro_id', $livro->id)->pluck('emprestimos_e_devoluco_id');
                    $emprestimosEDevolucos = EmprestimosEDevoluco::whereIn('id', $table)
                    ->where('situacao', 'A devolver')
                    ->orWhere('situacao', 'Prorrogado')
                    ->orWhere('situacao', 'Atrasado')
                    ->count();
                    $exemplaresDisponiveis = $livro->exemplares_existentes - $emprestimosEDevolucos;

                     ?>
                     @if($exemplaresDisponiveis > 0)
                      <option value="{{ $livro->id }}" {{ (in_array($livro->id, old('livros', [])) || $emprestimosEDevoluco->livros->contains($livro->id)) ? 'selected' : '' }}> {{ $livro->titulo }} ({{ $exemplaresDisponiveis }} Exemplares Disponiveis) </option>
                     @else
                      <option value="{{ $livro->id }}" {{ (in_array($livro->id, old('livros', [])) || $emprestimosEDevoluco->livros->contains($livro->id)) ? 'selected' : '' }} disabled> {{ $livro->titulo }} ({{ $exemplaresDisponiveis }} Exemplares Disponiveis) </option>
                     @endif
                    @endforeach
                </select>
                <span class="help-block"> </span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
