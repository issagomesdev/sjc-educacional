@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Deslocar Profissional
    </div>
     <div class="card-body">

       <form method="GET" action="{{ route('admin.deslocars.create') }}">
           @csrf

                    <div class="form-group">
                       <span class="help-block"> Selecione a instituição do profissional destinado a instalação: </span>
                       <select name="institucao_1" id="institucao_1" required>
                           @foreach($instituicao as $id => $entry)
                               <option value="{{ $id }}" {{ old('institucao_1') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                           @endforeach
                       </select>
                   </div>


            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Próximo
                </button>
            </div>

         </div>
       </div>



@endsection
