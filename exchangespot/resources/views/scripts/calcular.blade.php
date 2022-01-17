<script type="text/javascript">
$(document).ready(function () {

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#btnSubmit").click(function (event) {
    var nome = document.getElementById("nome").value
    var email = document.getElementById("email").value
    var sobrenome = document.getElementById("sobrenome").value
    if(nome=='' || email=='' || sobrenome==''){
        alert("Todos os campos são obrigatórios!"); 
    }else{

  //stop submit the form, we will post it manually.
  event.preventDefault();

  // Get form
  var form = $('#formConversao')[0];

 // Create an FormData object 
  var data = new FormData(form);

 // disabled the submit button
  $("#btnSubmit").prop("disabled", true); 
  $.ajax({
      type: "POST",
      url: "{{ url('currency') }}",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 800000,
      success: function (data) {
        $('div.flash-message').html(data);
        infos = JSON.parse(data); 
          $(".moedaOrigem").html(infos['moedaOrigem']); 
          $(".moedaDestino").html(infos['moedaDestino']); 
          $("#clientePagara").html(infos['clientePagara']); 
          $("#formaPgto").html(infos['formaPgto']); 
          $("#valorTaxaPgto").html(infos['valorTaxaPgto']); 
          $("#valorTaxaConversao").html(infos['valorTaxaConversao']); 
          $("#valorConvertido").html(infos['valorConvertidoReal']); 
          $("#valorCurrencyDestino").html(infos['valorCambio']); 
          $(".totalAdquirido").html(infos['totalAdquirido']); 
          $("#output").css("display","block"); 

            
       
          $("#btnSubmit").prop("disabled", false);

      },
      error: function (e) {

          $("#amount").html(e.responseText);
          console.log("ERROR : ", e);
          $("#btnSubmit").prop("disabled", false);

      }
  });
}
});

});
</script>