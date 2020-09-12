 <!-- head -->
 @extends('layouts.header')
 @extends('layouts.menu')

 @section('title')
 <h2>Pedidos</h2>
 @endsection

 @section('content')
 <div class="ibox-content">

     <div class="form-group row">
         <form class="form-group row" id="form_pedido" onSunmit="return false">
             <label class="col-sm-2 col-form-label">Clientes</label>
             <div class="col-sm-10">
                 <select id="select_cliente" class="form-control cliente_id col-sm-5" name="cliente_id">
                     <option value=""></option>
                 </select>
             </div>
             <div class="hr-line-dashed"> </div>
             <label class="col-sm-2 col-form-label">Produtos</label>
             <div class="col-sm-10">
                 <select id="select_produto" class="form-control produto_id col-sm-5" name="produto_id">
                     <option value=""></option>
                 </select>
             </div>
             <div class="hr-line-dashed"> </div>
             <label class="col-sm-2 col-form-label">Status</label>
             <div class="col-sm-10">
                 <select id="select_status" class="form-control status col-sm-5" name="status">
                     <option value=""></option>
                     <option value="0">Em Aberto</option>
                     <option value="1">Pago</option>
                     <option value="2">Cancelado</option>
                 </select>
             </div>
             <div class="hr-line-dashed"> </div>
             <input class="id" name="id" type="hidden">
             <div class="col-sm-4 col-sm-offset-2">
                 <button class="btn btn-white btn-sm" type="button" onclick="menuTelas('pedidos');"> Cancelar </button>
                 <button id="btn_novo" class="btn btn-primary btn-sm" type="button" onclick="insertPedido('form_pedido');"> Salvar </button>
                 <button id="btn_editar" class="btn btn-primary btn-sm" type="button" onclick="updatePedido('form_pedido');"> Editar </button>
             </div>
         </form>
     </div>

 </div>
 </div>

 @endsection
 @extends('layouts.footer')


 @section('js')
 <!-- Funcs-->
 <script src="{{asset('assets/js/services/pedido.js')}}"></script>
 <script>
     $(document).ready(function() {
         $("#side-menu").on("click", "li", function(event) {
             menuTelas($(this).attr("class"))
         });


         pedido_dados = JSON.parse(sessionStorage.getItem('pedido_dados'));
         if (pedido_dados != 'null') {
             $("#btn_novo").hide();
             $("#btn_editar").show();
             $(".id").val(pedido_dados["id"]);
             //  $("#select_status").val(pedido_dados["status"]);
             $("#select_status option[value='" + pedido_dados["status"] + "']").attr("selected", "selected");
             selectClienteProduto('#select_cliente',pedido_dados["cliente_id"] );
             selectClienteProduto('#select_produto',pedido_dados["produto_id"] );
             $('#select_cliente, #select_produto').prop('readonly',true);
            

         } else {
             $("#btn_novo").show();
             $("#btn_editar").hide();
             selectClienteProduto('#select_cliente',null);
             selectClienteProduto('#select_produto',null);
         }

     });
 </script>
 @endsection