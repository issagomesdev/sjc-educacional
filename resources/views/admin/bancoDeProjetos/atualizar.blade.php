@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Proposta
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('admin.projetos.propostas.up') }}" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label>Situação</label>
                <select class="form-control {{ $errors->has('situacao_do_projeto') ? 'is-invalid' : '' }}" name="situacao_do_projeto" id="situacao_do_projeto" onchange="showDiv('hidden_div', this)">
                    <option value disabled {{ old('situacao_do_projeto', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>

                        <option value="1"> Aprovar </option>
                        <option value="5"> Falta Informações </option>
                        <option value="6"> Em avaliação </option>
                        <option value="7"> Sugerir mudança </option>
                        <option value="8"> Arquivar </option>

                </select>
                <span class="help-block"> </span>
            </div>
            <div class="form-group" id="hidden_div">
                <label for="sugestao"> Inserir Sugestão </label>
                <input class="form-control" type="text" name="sugestao" id="sugestao" value="{{ old('sugestao', $bancoDeProjetos->sugestao) }}">
                <span class="help-block"> </span>
            </div>
            <input type="hidden" class="id" value="{{$id}}" for="id" name="id">
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Proximo
                </button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == 7 ? 'block' : 'none';
}

</script>

<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
        window.close();
    }
</script>

<style media="screen">

#hidden_div {
  display: none;
}
</style>

@endsection
