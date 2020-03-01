function Client() {

    this.getClientList = function() {

        returnData('controllers/ClientController.php?acao=index', 'get');

        var json = response;

        return json;
    }

    this.registerClient = function() {

        var form = $('#formClientGetData').serialize();

        returnData('controllers/ClientController.php?acao=store', 'post', form);

        var json = response;

        if (json.status != undefined) {
            if (json.status == 0) {
                alert(json.msg);
            } else {
                alert('Cliente cadastrado com sucesso.')
            }
        } else {
            alert('Erro ao efetuar operação.');
        }

    }

    this.getData = function() {

        var form = $('#formClientGetData').serialize();

        returnData('controllers/ClientController.php?acao=index', 'post', form);

        var json = response;
        
        if (json.status != undefined) {

            if (json.status == 0) {
                $('#clientData').html('Nenhum registro');
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
                                <td>`+json.data[i].email+`</td>
                                <td>
                                    <a href='clientEdit.php?id=`+json.data[i].id+`'><button class="btn btn-primary btn-sm" type="button">Editar</button></a>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" type='button' name='delete' onclick='new Client().delete(`+json.data[i].id+`)'>Deletar</button>
                                </td>
                            </tr>`;
                }
                
                $('#clientData').html(html);
                $('#deleteSelected').show();
            }

        } else {
            alert('Erro ao efetuar operação.');
        }
    }

    this.delete = function(id) {

        var data = 'id='+id;

        returnData('controllers/ClientController.php?acao=destroy', 'post', data);

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

        var data = []

        $.each($('input[name=deleteSelected]:checked'), function(){
            data.push($(this).val());
        });

        returnData('controllers/ClientController.php?acao=destroySelected', 'post', 'ids='+data);

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

    this.findById = function(id) {
        
        returnData('controllers/ClientController.php?acao=show', 'post', 'id='+id);

        var json = response;

        return json;
    }

    this.getDataEdit = function(id) {

        var clientDataById = this.findById(id);


        if (clientDataById.status != 0) {
            $('#name').val(clientDataById.data.name);
            $('#email').val(clientDataById.data.email);
        }
    }

    this.updateClient = function(id) {

        var form = $('#formClientGetData').serialize();

        returnData('controllers/ClientController.php?acao=update', 'post', form+'&id='+id);

        var json = response;

        if (json.status != undefined) {
            if (json.status == 0) {
                alert(json.msg);
            } else {
                alert('Cliente atualizado com sucesso.')
            }
        } else {
            alert('Erro ao efetuar operação.');
        }

    }
}