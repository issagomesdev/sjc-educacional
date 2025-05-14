$("#1at").keyup(calc);
$("#2at").keyup(calc);
$("#3at").keyup(calc);
$("#4at").keyup(calc);
$("#5at").keyup(calc);
$("#1nota").keyup(calc);
$("#2nota").keyup(calc);

function calc() {

    $('#1nota').val(
        (parseFloat($('#1at').val(), 10) + parseFloat($("#2at").val(), 10) + parseFloat($("#3at").val(), 10)
        + parseFloat($("#4at").val(), 10) + parseFloat($("#5at").val(), 10)) / parseFloat("5", 10)
  );

  $('#mb').val(
      (parseFloat($('#1nota').val(), 10) + parseFloat($("#2nota").val(), 10)) / parseFloat("2", 10)
);
}



$(function() {
  $('#1at').maskMoney({ decimal: '.', thousands: '', precision: 1 });
})
