function PurchaseOrder() {

    this.getData = function() {

        var form = $('#formPurchaseOrderGetData').serialize();

        returnData('controllers/PurchaseOrderController.php?acao=index', 'post', form);

        var json = response;
        
        if (json.status != undefined) {

            // Status 0 = Erro  -  Status 2 = Usuário não logado
            if (json.status == 0 || json.status == 2) {
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
                                <td><a href='clientDetail.php?id=`+json.data[i].clientId+`'>`+json.data[i].clientName+`</a></td>
                                <td><a href='productDetail.php?id=`+json.data[i].productId+`'>`+json.data[i].productName+`</a></td>
                                <td>`+json.data[i].status+`</td>
                                <td>`+json.data[i].qtd+`</td>
                                <td>R$ `+parseFloat(json.data[i].price).toFixed(2)+`</td>
                                <td>R$ `+parseFloat(json.data[i].totalPrice).toFixed(2)+`</td>
                                <td>
                                    <a href='purchaseOrderEdit.php?id=`+json.data[i].id+`'><button class="btn btn-primary btn-sm" type="button">Editar</button></a>
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
            
            // Status 0 = Erro  -  Status 2 = Usuário não logado
            if (json.status == 0 || json.status == 2) {
                alert(json.msg);
            } else {
                this.getData();
            }
        } else {
            alert('Erro ao efetuar operação.');
        }
    }

    this.deleteSelected = function() {

        var data = []

        $.each($('input[name=deleteSelected]:checked'), function(){
            data.push($(this).val());
        });

        returnData('controllers/PurchaseOrderController.php?acao=destroySelected', 'post', 'ids='+data);

        var json = response;

        if (json.status != undefined) {

            // Status 0 = Erro  -  Status 2 = Usuário não logado
            if (json.status == 0 || json.status == 2) {
                alert(json.msg);
            } else {
                this.getData();
            }
        } else {
            alert('Erro ao efetuar operação.');
        }

    }

    this.getDataRegister = function() {

        var clientList = new Client().getClientList();
        var productList = new Product().getProductList();

        var clientOptions = '';
        var productOptions = '';

        // Status 0 = Erro  -  Status 2 = Usuário não logado
        if (clientList.status != 0 && clientList.status != 2) {

            for (var i in clientList.data) {
                clientOptions += '<option value="'+clientList.data[i].id+'">'+clientList.data[i].name+'</option>';
            }
        }

        // Status 0 = Erro  -  Status 2 = Usuário não logado
        if (productList.status != 0 && productList.status != 2) {

            for (var i in productList.data) {
                productOptions += '<option value="'+productList.data[i].id+'">'+productList.data[i].name+'</option>';
            }
        }

        $('#clientId').append(clientOptions);
        $('#productId').append(productOptions);
    }

    this.registerOrder = function() {

        var form = $('#formPurchaseOrderGetData').serialize();

        returnData('controllers/PurchaseOrderController.php?acao=store', 'post', form);

        var json = response;

        if (json.status != undefined) {

            // Status 0 = Erro  -  Status 2 = Usuário não logado
            if (json.status == 0 || json.status == 2) {
                alert(json.msg);
            } else {
                alert('Pedido de compra cadastrado com sucesso.')
            }
        } else {
            alert('Erro ao efetuar operação.');
        }

    }

    this.findById = function(id) {
        
        returnData('controllers/PurchaseOrderController.php?acao=show', 'post', 'id='+id);

        var json = response;

        return json;
    }

    this.getDataEdit = function(id) {

        var clientList = new Client().getClientList();
        var productList = new Product().getProductList();
        var purchaseOrderDataById = this.findById(id);

        var clientOptions = '';
        var productOptions = '';


        // Status 0 = Erro  -  Status 2 = Usuário não logado
        if (clientList.status != 0 && clientList.status != 2) {

            for (var i in clientList.data) {
                clientOptions += '<option value="'+clientList.data[i].id+'">'+clientList.data[i].name+'</option>';
            }
        }

        // Status 0 = Erro  -  Status 2 = Usuário não logado
        if (productList.status != 0 && productList.status != 2) {

            for (var i in productList.data) {
                productOptions += '<option value="'+productList.data[i].id+'">'+productList.data[i].name+'</option>';
            }
        }

        $('#clientId').append(clientOptions);
        $('#productId').append(productOptions);

        // Status 0 = Erro  -  Status 2 = Usuário não logado
        if (purchaseOrderDataById.status != 0 && purchaseOrderDataById.status != 2) {
            $('#qtd').val(purchaseOrderDataById.data.qtd);
            $('#clientId > option').each(function() {
                if ($(this).val() == purchaseOrderDataById.data.clientId) {
                    $(this).attr('selected', true);
                }
            });
            
            $('#productId > option').each(function() {
                if ($(this).val() == purchaseOrderDataById.data.productId) {
                    $(this).attr('selected', true);
                }
            });

            $('#status > option').each(function() {
                if ($(this).val() == purchaseOrderDataById.data.status) {
                    $(this).attr('selected', true);
                }
            });
        }
    }

    this.updateOrder = function(id) {

        var form = $('#formPurchaseOrderGetData').serialize();

        returnData('controllers/PurchaseOrderController.php?acao=update', 'post', form+'&id='+id);

        var json = response;

        if (json.status != undefined) {

            // Status 0 = Erro  -  Status 2 = Usuário não logado
            if (json.status == 0 || json.status == 2) {
                alert(json.msg);
            } else {
                alert('Pedido de compra atualizado com sucesso.')
            }
        } else {
            alert('Erro ao efetuar operação.');
        }

    }
}