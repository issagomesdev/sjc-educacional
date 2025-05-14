@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Adicionar Ano
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.abrir-e-encerrar-ano-letivos.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="ano"> Ano </label>
                <select class="form-control selectd" name="ano" id="ano">
                <?php foreach (range(date('Y'), 1950) as $year) { print '<option value="'.$year.'"'.'>'.$year.'</option>'; } ?>
                </select>
                <span class="help-block"> </span>
            </div>

            <input type="hidden" class="assinatura_id" value="{{Auth::user()->id}}" for="assinatura_id" name="assinatura_id">
            <input type="hidden" class="team_id" value="{{Auth::user()->team_id}}" for="team_id" name="team_id">
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<style media="screen">

label.required {
  display: inline-block;
  margin-bottom: 0.5rem;
  color: #3c4b64;
  font-weight: 600;
}

.alert {
    position: relative;
    font-size: 0.875rem;
    z-index: 1;
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    text-align: center;
}

.alert-success {
    color: #fff;
    background-color: #edc46c;
    border-color: #edc46c;
}

</style>

<script type="text/javascript">

setTimeout(function() {
   $('.alert').fadeOut('fast');
}, 6000);


</script>

@endsection
