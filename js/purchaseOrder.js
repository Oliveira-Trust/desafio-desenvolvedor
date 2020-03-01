function PurchaseOrder() {

    this.getData = function() {

        var form = $('#formPurchaseOrderGetData').serialize();

        returnData('controllers/PurchaseOrderController.php?acao=index', 'post', form);

        var json = response;
        
        if (json.status != undefined) {

            if (json.status == 0) {
                $('#purchaseOrderData').html('Nenhum registro');
                $('#deleteSelected').hide();
            } else {
                var html = '';
                for (var i in json.data) {
                    html += `<tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="delete[]" data-id="`+json.data[i].id+`" />
                                    </div>
                                </td>
                                <td>`+json.data[i].clientName+`</td>
                                <td>`+json.data[i].productName+`</td>
                                <td>`+json.data[i].status+`</td>
                                <td>`+json.data[i].qtd+`</td>
                                <td>R$ `+parseFloat(json.data[i].price).toFixed(2)+`</td>
                                <td>R$ `+parseFloat((json.data[i].price * json.data[i].qtd)).toFixed(2)+`</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Editar</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm">Deletar</button>
                                </td>
                            </tr>`;
                }
                
                $('#purchaseOrderData').html(html);
                $('#deleteSelected').show();
            }

        } else {
            alert('Erro ao efetuar operação.');
        }
    }
}