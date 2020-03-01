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
                                        <input type="checkbox" class="form-check-input" name="deleteSelected" value="`+json.data[i].id+`" />
                                    </div>
                                </td>
                                <td>`+json.data[i].clientName+`</td>
                                <td>`+json.data[i].productName+`</td>
                                <td>`+json.data[i].status+`</td>
                                <td>`+json.data[i].qtd+`</td>
                                <td>R$ `+parseFloat(json.data[i].price).toFixed(2)+`</td>
                                <td>R$ `+parseFloat(json.data[i].totalPrice).toFixed(2)+`</td>
                                <td>
                                    <a href='purchaseOrderEdit.php?id=`+json.data[i].id+`'><button class="btn btn-primary btn-sm">Editar</button></a>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" type='button' name='delete' onclick='new PurchaseOrder().delete(`+json.data[i].id+`)'>Deletar</button>
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

    this.delete = function(id) {

        var data = 'id='+id;

        returnData('controllers/PurchaseOrderController.php?acao=destroy', 'post', data);

        var json = response;

        if (json.status != undefined) {
            if (json.status == 0) {
                alert(json.msg);
            } else {
                this.getData();
            }
        } else {
            alert('Erro ao efetuar operação.');
        }
    }

    this.deleteSelected = function() {

        debugger;

        var data = []

        $.each($('input[name=deleteSelected]:checked'), function(){
            data.push($(this).val());
        });

        returnData('controllers/PurchaseOrderController.php?acao=destroySelected', 'post', 'ids='+data);

        var json = response;

        if (json.status != undefined) {
            if (json.status == 0) {
                alert(json.msg);
            } else {
                this.getData();
            }
        } else {
            alert('Erro ao efetuar operação.');
        }

    }
}