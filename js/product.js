function Product() {

    this.getProductList = function() {

        returnData('controllers/ProductController.php?acao=index', 'get');

        var json = response;

        return json;
    }

    this.registerProduct = function() {

        var form = $('#formProductGetData').serialize();

        returnData('controllers/ProductController.php?acao=store', 'post', form);

        var json = response;

        if (json.status != undefined) {
            if (json.status == 0 || json.status == 2) {
                alert(json.msg);
            } else {
                alert('Produto cadastrado com sucesso.')
            }
        } else {
            alert('Erro ao efetuar operação.');
        }

    }

    this.getData = function() {

        var form = $('#formProductGetData').serialize();

        returnData('controllers/ProductController.php?acao=index', 'post', form);

        var json = response;
        
        if (json.status != undefined) {

            if (json.status == 0 || json.status == 2) {
                $('#productData').html('Nenhum registro');
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
                                <td>`+json.data[i].name+`</td>
                                <td>`+json.data[i].price+`</td>
                                <td>
                                    <a href='productEdit.php?id=`+json.data[i].id+`'><button class="btn btn-primary btn-sm" type="button">Editar</button></a>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" type='button' name='delete' onclick='new Product().delete(`+json.data[i].id+`)'>Deletar</button>
                                </td>
                            </tr>`;
                }
                
                $('#productData').html(html);
                $('#deleteSelected').show();
            }

        } else {
            alert('Erro ao efetuar operação.');
        }
    }

    this.delete = function(id) {

        var data = 'id='+id;

        returnData('controllers/ProductController.php?acao=destroy', 'post', data);

        var json = response;

        if (json.status != undefined) {
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

        returnData('controllers/ProductController.php?acao=destroySelected', 'post', 'ids='+data);

        var json = response;

        if (json.status != undefined) {
            if (json.status == 0 || json.status == 2) {
                alert(json.msg);
            } else {
                this.getData();
            }
        } else {
            alert('Erro ao efetuar operação.');
        }

    }

    this.findById = function(id) {
        
        returnData('controllers/ProductController.php?acao=show', 'post', 'id='+id);

        var json = response;

        return json;
    }

    this.getDataEdit = function(id) {

        var productDataById = this.findById(id);


        if (productDataById.status != 0 && productDataById.status != 2) {
            $('#name').val(productDataById.data.name);
            $('#price').val(productDataById.data.price);
        }
    }

    this.updateProduct = function(id) {

        var form = $('#formProductGetData').serialize();

        returnData('controllers/ProductController.php?acao=update', 'post', form+'&id='+id);

        var json = response;

        if (json.status != undefined) {
            if (json.status == 0 || json.status == 2) {
                alert(json.msg);
            } else {
                alert('Produto atualizado com sucesso.')
            }
        } else {
            alert('Erro ao efetuar operação.');
        }

    }
}