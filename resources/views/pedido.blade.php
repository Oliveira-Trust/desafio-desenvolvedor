 <!-- head -->
 @extends('layouts.header')
 @extends('layouts.menu')

 @section('title')
 <h2>Pedidos</h2>
 @endsection

 @section('content')
 <div class="ibox-content">
     <div class="table-responsive">
         <table id="tabPedido" class="table table-striped table-bordered table-hover">
             <thead>
                 <tr>

                     <th>cliente_id</th>
                     <th>produto_id</th>
                     <th>nome</th>
                     <th>cpf</th>
                     <th>Nome Do Produto</th>
                     <th>Descrição Do Produto</th>
                     <th>status</th>
                     <th>status</th>
                     <th>Editar</th>

                 </tr>
             </thead>
         </table>
     </div>

 </div>

 @endsection
 @extends('layouts.footer')


 @section('js')
 <!-- Funcs-->
 <script src="{{asset('assets/js/services/pedido.js')}}"></script>
 <script>
     $(document).ready(function() {
         $('#tabPedido').DataTable({
             pageLength: 25,
             responsive: true,
             ajax: {
                 dataType: 'json',
                 contentType: "application/json; charset=utf-8",
                 type: "GET",
                 url: '/api/pedido',
                 dataSrc: ''
             },
             lengthChange: false,
             dom: '<"html5buttons"B>lTfgitp',
             buttons: [{
                     text: 'atualizar',
                     action: function(e, dt, node, config) {
                         dt.ajax.reload();
                     }
                 },
                 {
                     text: "adicionar",
                     action: function(e, dt, node, config) {
                         sessionStorage.clear();
                         sessionStorage.setItem("pedido_dados", JSON.stringify('null'));
                         window.location.href = "/novo_pedido";
                     }
                 },
                 {
                     text: 'deletar',
                     action: function(e, dt, node, config) {
                        var i;
                        var text =[];
                         //   alert($('#tabPedido').DataTable().rows('.selected').data().length + ' row(s) selected');
                         var data = $('#tabPedido').DataTable().rows('.selected').data();
                        //  for (i = 0; i < $('#tabPedido').DataTable().rows('.selected').data().length; i++) {
                        //      text.push( data[i].id) ;
                        //  }
                         deletePedido(data[0].cliente_id);

                     }
                 }
             ],
             columns: [{
                     'data': 'cliente_id'
                 },
                 {
                     'data': 'produto_id'
                 },
                 {
                     'data': 'nome'
                 },
                 {
                     'data': 'cpf'
                 },
                 {
                     'data': 'nome_produto'
                 },
                 {
                     'data': 'descricao_produto'
                 },
                 {
                     'data': 'status'
                 },
                 {
                     'data': 'status_nome'
                 },
                 {
                     'data': 'id'
                 }

             ],
             columnDefs: [{
                     "render": function(data, type, row) {
                         return '<button id="editar" type="button" class="btn btn-w-m btn-warning">Editar</button>';
                     },
                     "targets": 8

                 },
                 {
                     "targets": [0],
                     "visible": false,
                     "searchable": false
                 },
                 {
                     "targets": [1],
                     "visible": false,
                     "searchable": false
                 },
                 {
                     "targets": [6],
                     "visible": false,
                     "searchable": false
                 }
             ]
         });
         $("#side-menu").on("click", "li", function(event) {
             menuTelas($(this).attr("class"))
         });


         $('#tabPedido tbody').on('click', 'button', function() {
             var data = $('#tabPedido').DataTable().row($(this).parents('tr')).data();
             ajax_grid_pedido(data);

         });
         $('#tabPedido tbody').on('click', 'tr', function() {
             $(this).toggleClass('selected');
             $('#tabPedido').DataTable().rows('.selected').data();
             $('td', '.selected').css('background-color', 'Gray');
         });



     });
 </script>
 @endsection