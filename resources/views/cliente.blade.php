 <!-- head -->
 @extends('layouts.header')
 @extends('layouts.menu')

 @section('title')
 <h2>Cliente</h2>
 @endsection

 @section('content')
 <div class="ibox-content">
     <div class="table-responsive">
         <table id="tabCliente" class="table table-striped table-bordered table-hover">
             <thead>
                 <tr>
                     <th>Nome</th>
                     <th>CPF</th>
                     <th>Data de nascimento</th>
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
 <script src="{{asset('assets/js/services/cliente.js')}}"></script>
 <script>
     $(document).ready(function() {
         $('#tabCliente').DataTable({
             pageLength: 25,
             responsive: true,
             ajax: {
                 dataType: 'json',
                 contentType: "application/json; charset=utf-8",
                 type: "GET",
                 url: '/api/cliente',
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
                         sessionStorage.setItem("cliente_dados", JSON.stringify('null'));
                         window.location.href = "/novo_cliente";
                     }
                 },
                 {
                     text: 'deletar',
                     action: function(e, dt, node, config) {
                         alert("fazer")
                     }
                 }
             ],
             columns: [{
                     'data': 'nome'
                 },
                 {
                     'data': 'cpf'
                 },
                 {
                     'data': 'data_nascimento'
                 },
                 {
                     'data': 'id'
                 }


             ],
             columnDefs: [{
                 "render": function(data, type, row) {
                     return '<button id="editar" type="button" class="btn btn-w-m btn-warning">Editar</button>';
                 },
                 "targets": 3

             }]
         });


         $("#side-menu").on("click", "li", function(event) {
             menuTelas($(this).attr("class"))
         });

         $('#tabCliente tbody').on('click', 'button', function() {
             var data = $('#tabCliente').DataTable().row($(this).parents('tr')).data();
             ajax_grid_cliente(data);

         });
         $('#tabCliente tbody').on('click', 'tr', function() {
             $(this).toggleClass('selected');
             $('#tabCliente').DataTable().rows('.selected').data();
             $('td', '.selected').css('background-color', 'Gray');
         });


     });
 </script>
 @endsection