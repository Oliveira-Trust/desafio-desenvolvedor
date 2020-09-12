 <!-- head -->
 @extends('layouts.header')
 @extends('layouts.menu')

 @section('title')
 <h2>Produto</h2>
 @endsection

 @section('content')
 <div class="ibox-content">
     <div class="form-group row">
         <form class="form-group row" id="form_produto" onSunmit="return false">
             <label class="col-sm-3 col-form-label">Nome Do Produto</label>
             <div class="col-sm-9">
                 <input class="form-control nome_produto col-sm-5" name="nome_produto" type="text" placeholder="Nome Do Produto">
             </div>
             <div class="hr-line-dashed"> </div>
             <label class="col-sm-3 col-form-label">Descrição Do Produto</label>
             <div class="col-sm-9">
                 <input class="form-control descricao_produto col-sm-5" name="descricao_produto" type="text" placeholder="Descrição Do Produto">
             </div>
             <div class="hr-line-dashed"> </div>
             <input class="id" name="id" type="hidden">
             <div class="col-sm-4 col-sm-offset-2">
                 <button class="btn btn-white btn-sm" type="button" onclick="menuTelas('produtos');"> Cancelar </button>
                 <button id="btn_novo" class="btn btn-primary btn-sm" type="button" onclick="insertProduto('form_produto');"> Salvar </button>
                 <button id="btn_editar" class="btn btn-primary btn-sm" type="button" onclick="updateProduto('form_produto');"> Editar </button>
             </div>
         </form>
     </div>

 </div>
 </div>

 @endsection
 @extends('layouts.footer')


 @section('js')
 <!-- Funcs-->
 <script src="{{asset('assets/js/services/produto.js')}}"></script>
 <script>
     $(document).ready(function() {

         $("#side-menu").on("click", "li", function(event) {
             menuTelas($(this).attr("class"))
         });
         produto_dados = JSON.parse(sessionStorage.getItem('produto_dados'));
         if (produto_dados != 'null') {
             $("#btn_novo").hide();
             $("#btn_editar").show();
             $(".id").val(produto_dados["id"]);
             $(".nome_produto").val(produto_dados["nome_produto"]);
             $(".descricao_produto").val(produto_dados["descricao_produto"]);
         } else {
             $("#btn_novo").show();
             $("#btn_editar").hide();
         }


     });
 </script>
 @endsection