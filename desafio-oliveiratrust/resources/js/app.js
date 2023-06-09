import './bootstrap';
import '../sass/app.scss'
import * as bootstrap from 'bootstrap'

$(document).ready(function() {
    $('#theme-toggle').change(function() {
        $.ajax({
            url: '/toggle-theme',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function() {
                location.reload();
            }
        });
    });
});


// $(document).ready(function(){
//     // Seu código aqui
//     console.log("Jquery Habilitado!");
// });

// $('.view-btn').click(function() {
//     var id = $(this).data('id'); // Obtém o ID da cotação do atributo data-id

//     // Dados fictícios da cotação
//     var cotacao = {
//         id: id,
//         moedaOrigem: 'USD',
//         moedaDestino: 'BRL',
//         valorParaConversao: 100,
//         valorTotal: 500,
//         dataDaConversao: '2023-06-08'
//     };

//     // Preenche o modal com os dados da cotação
//     var modal = $('#cotacaoModal');
//     modal.find('.modal-body').html(
//         'ID: ' + cotacao.id + '<br>' +
//         'Moeda de origem: ' + cotacao.moedaOrigem + '<br>' +
//         'Moeda de destino: ' + cotacao.moedaDestino + '<br>' +
//         'Valor para conversão: ' + cotacao.valorParaConversao + '<br>' +
//         'Valor total: ' + cotacao.valorTotal + '<br>' +
//         'Data da conversão: ' + cotacao.dataDaConversao
//     );

//     // Abre o modal
//     modal.modal('show');
// });