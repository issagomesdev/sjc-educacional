@extends('layouts.admin')
@section('content')

@can('abrir_e_encerrar_ano_letivo_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.abrir-e-encerrar-ano-letivos.create') }}">
                Adicionar Ano Letivo
            </a>
    </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        Anos Letivos
    </div>

    <div class="card-body">

      <div class="year">
        @foreach($anos_letivos as $ano_letivo)

         <span class="year"> {{ $ano_letivo->ano }}
          @if(!in_array($ano_letivo->ano, $anos))

          <div class="header">
          <div class="dropdown">
            <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $ano_letivo->ano }}()"> <li class="not-found"> </li> </ul>
            <div id="myDropdown{{ $ano_letivo->ano }}" class="dropdown-content">
              <form  method="POST" action="{{ route('admin.abrir-e-encerrar-ano-letivos.insert') }}" enctype="multipart/form-data"> @csrf
                <input type="hidden" name="ano" id="ano" value="{{ $ano_letivo->ano }}">
                <button type="submit" class="status" value="Vincular"> Vincular </form>
            </div>
          </div>
         </div>

           @endif


          @foreach($anos_status as $ano_status) @if($ano_letivo->ano == $ano_status['ano'])

          @if($ano_status['situacao'] == 1)
          <div class="header">
          <div class="dropdown">
            <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $ano_letivo->ano }}()"> <li class="open"> </li> </ul>
            <div id="myDropdown{{ $ano_letivo->ano }}" class="dropdown-content">
              <form  method="POST" action="{{ route('admin.abrir-e-encerrar-ano-letivos.up') }}" enctype="multipart/form-data"> @csrf
                <input type="hidden" name="ano" id="ano" value="{{ $ano_letivo->ano }}">
                <input type="hidden" name="situacao" id="situacao" value="0">
                <button type="submit" class="status" value="Encerrar"> Encerrar </form>
            </div>
          </div>
         </div>
          @endif

          @if($ano_status['situacao'] == 0)
          <div class="header">
          <div class="dropdown">
            <ul class="dropbtn icons btn-right showLeft" onclick="showDropdown{{ $ano_letivo->ano }}()"> <li class="closed"> </li> </ul>
            <div id="myDropdown{{ $ano_letivo->ano }}" class="dropdown-content">
              <form  method="POST" action="{{ route('admin.abrir-e-encerrar-ano-letivos.up') }}" enctype="multipart/form-data"> @csrf
                <input type="hidden" name="ano" id="ano" value="{{ $ano_letivo->ano }}">
                <input type="hidden" name="situacao" id="situacao" value="1">
                <button type="submit" class="status" value="Abrir"> Abrir </form>
            </div>
          </div>
         </div>
          @endif

          @endif @endforeach

          </span>

          @section('scripts')
          @parent
          <script>

          function changeLanguage(language) {
          var element = document.getElementById("url");
          element.value = language;
          element.innerHTML = language;
          }

          function showDropdown{{ $ano_letivo->ano }}() {
          document.getElementById("myDropdown{{ $ano_letivo->ano  }}").classList.toggle("dshow");
          }

          // Close the dropdown if the user clicks outside of it
          window.onclick = function(event) {
          if (!event.target.matches(".dropbtn")) {
          var dropdowns = document.getElementsByClassName("dropdown-content");
          var i;
          for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains("dshow")) {
          openDropdown.classList.remove("dshow");
          }
          }
          }
          };

          </script>
          @endsection

        @endforeach
      </div>

                </div>
                </div>

<link rel="stylesheet" href="{{ url('css/panel.css') }}">
<link rel="stylesheet" href="{{ url('css/hide-menu.css') }}">
<link rel="stylesheet" href="{{ url('css/button.css') }}">
<link rel="stylesheet" href="{{ url('resources/anos-letivos.css') }}">

<style media="screen">

.dropdown {
  position: relative;
  display: inline-block;
  left: 0;
}

</style>

@endsection
@section('scripts')
@parent

<script type="text/javascript">

setTimeout(function() {
   $('.alert').fadeOut('fast');
}, 6000);

</script>

<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('abrir_e_encerrar_ano_letivo_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.abrir-e-encerrar-ano-letivos.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 6, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-AbrirEEncerrarAnoLetivo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>

@endsection
