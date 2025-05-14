@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Atualizar Pedido
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pedidos-de-compras.update", [$pedidosDeCompra->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="produto_id"> Produtos </label>

                <div class="produtos">

                <select class="form-control select2" id="produtos">
                  <option value=""> Selecione por favor </option>
                    @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}" data-lab="{{ $produto->titulo }}"
                          data-quant="
                          @if(!in_array($produto->id, $produtos_array)) 0 @endif
                          @foreach($produtos_no_estoque as $produto_no_estoque)
                          @if($produto_no_estoque['produto_id'] == $produto->id )
                          @if($produto_no_estoque['estoque_id'] == $pedidosDeCompra->estoque_id )

                         {{ $produto_no_estoque['quantidade'] }}

                          @endif
                          @endif
                          @endforeach">

                             Produto: {{ $produto->titulo }} | Unidade: {{ $produto->unidade }} |

                             @if(!in_array($produto->id, $produtos_array)) Quantidade atual: 0 @endif

                              @foreach($produtos_no_estoque as $produto_no_estoque)
                              @if($produto_no_estoque['produto_id'] == $produto->id )
                              @if($produto_no_estoque['estoque_id'] == $pedidosDeCompra->estoque_id )

                             Quantidade atual: {{ $produto_no_estoque['quantidade'] }}

                              @endif
                              @endif
                              @endforeach

                         </option>
                    @endforeach
                </select>
                <input type="number" id="quntd" placeholder="informe quantidade" autocomplete="off" onkeypress="return isNumberKey(event)">
                <button class="btn-produto-add" id="add_produtos"> add </button>
              </div>
            </div>

            <select class="form-control select2" name="produtos[]" id="lista_de_produtos" multiple required>
              @foreach($pedidos as $pedido)
              <option value='array("produto_id" => {{ $pedido['produto_id'] }}, "produto_nome" => "{{ $pedido['produto_nome'] }}", "quantidade" => {{ $pedido['quantidade'] }}),' selected='true'> Produto: {{ $pedido['produto_nome'] }} | Quantidade: {{ $pedido['quantidade'] }} </option>
              @endforeach
            </select>

            <div class="form-group">
                <label for="fornecedor_id">{{ trans('cruds.pedidosDeCompra.fields.fornecedor') }}</label>
                <select class="form-control select2 {{ $errors->has('fornecedor') ? 'is-invalid' : '' }}" name="fornecedor_id" id="fornecedor_id" required>
                    @foreach($fornecedors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('fornecedor_id') ? old('fornecedor_id') : $pedidosDeCompra->fornecedor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fornecedor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fornecedor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pedidosDeCompra.fields.fornecedor_helper') }}</span>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<style media="screen">

.produtos {
    display: flex;
}

input#quntd {
    margin-left: 10px;
}

label {
    margin-top: 15px;
}

.btn-produto-add {
    margin-left: 10px;
    width: 60px;
    border-width: 2px;
    border-style: double;
    color: white;
    background-color: #39f;
    border-color: #39f;
    border-radius: 3px;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}

.btn-produto-remove {
    width: 170px;
    margin-top: 5px;
    margin-bottom: 20px;
    border-width: 2px;
    border-style: double;
    color: white;
    background-color: #e55353;
    border-color: #e55353;
    border-radius: 3px;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}

.quntd {
    margin-left: 10px;
    border-width: 1px;
    border-color: #c2c4c5;
}

.quntd:focus-visible {
    margin-left: 10px;
    border-width: 1px;
    border-color: #c2c4c5;
}

select#lista_de_produtos {
    width: 100%;
}

</style>

<script type="text/javascript">

const add = document.querySelector('#add_produtos');
const remove = document.querySelector('#remove_produtos');
const lp = document.querySelector('#lista_de_produtos');
const produtos = document.querySelector('#produtos');
const quntd = document.querySelector('#quntd');

add.onclick = (e) => {
    e.preventDefault();

    // validar opção
    if (produtos.value == '' || quntd.value == '') {
        alert('Por favor selecione um produto e informe a quantidade desejada.');
        return;
    }
    // criando array com quantidade e produto_id e texto.
    var text = 'Produto: ' + document.querySelector(`option[value="${produtos.value}"`).dataset.lab + ' | ' + 'Quantidade: ' + quntd.value;
    var value = 'array("produto_id" => ' + produtos.value
    + ', "produto_nome" => "' + document.querySelector(`option[value="${produtos.value}"`).dataset.lab
    + '", "quantidade" => ' + quntd.value + '),';
    var selected = 'selected';
    const option = new Option(text, value, true, true);
    // adiciona a lista
    lp.add(option, undefined);
    // limpar
    quntd.value = '';
    quntd.focus();

};

</script>

@endsection
