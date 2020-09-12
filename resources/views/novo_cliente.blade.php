 <!-- head -->
 @extends('layouts.header')
 @extends('layouts.menu')

 @section('title')
 <h2>Cliente</h2>
 @endsection

 @section('content')
 <div class="ibox-content">

     <div class="form-group row">
         <form class="form-group row" id="form_cliente" onSunmit="return false">
             <label class="col-sm-2 col-form-label">Nome</label>
             <div class="col-sm-10">
                 <input class="form-control nome col-sm-5" name="nome" type="text" placeholder="nome">
             </div>
             <div class="hr-line-dashed"> </div>
             <label class="col-sm-2 col-form-label">CPF</label>
             <div class="col-sm-10">
                 <input class="form-control cpf col-sm-5" name="cpf" type="text" placeholder="CPF">
             </div>
             <div class="hr-line-dashed"> </div>
             <label class="col-sm-2 col-form-label">Data De Nascimento</label>
             <div class="col-sm-10">
                 <input class="form-control data_nascimento col-sm-5" name="data_nascimento" type="text" placeholder="Data De Nascimento">
             </div>
             <div class="hr-line-dashed"> </div>
                 <input class="id" name="id" type="hidden">
             <div class="col-sm-4 col-sm-offset-2">
                 <button class="btn btn-white btn-sm" type="button" onclick="menuTelas('clientes');"> Cancelar </button>
                 <button id="btn_novo" class="btn btn-primary btn-sm" type="button" onclick="insertCliente('form_cliente');"> Salvar </button>
                 <button id="btn_editar" class="btn btn-primary btn-sm" type="button" onclick="updateCliente('form_cliente');"> Editar </button>
             </div>
         </form>
     </div>

 </div>
 </div>

 @endsection
 @extends('layouts.footer')


 @section('js')
 <!-- Funcs-->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.min.js"></script>
 <script src="{{asset('assets/js/services/cliente.js')}}"></script>
 <script>
     $(document).ready(function() {
         $(".cpf").mask("999.999.999-99");
         $(".data_nascimento").mask("99/99/9999");
         $("#side-menu").on("click", "li", function(event) {
             menuTelas($(this).attr("class"))
         });
         $(".cpf").mask("999.999.999-99");
         $(".data_nascimento").mask("99/99/9999");
         cliente_dados = JSON.parse(sessionStorage.getItem('cliente_dados'));
         if(cliente_dados != 'null'){
             console.log(cliente_dados);
             $("#btn_novo").hide();
             $("#btn_editar").show();
             $(".id").val(cliente_dados["id"]);
            $(".nome").val(cliente_dados["nome"]);
            $(".cpf").val(cliente_dados["cpf"]);
            $(".data_nascimento").val(cliente_dados["data_nascimento"]);
            
         }else{
            $("#btn_novo").show();
             $("#btn_editar").hide();
         }

     });
 </script>
 @endsection