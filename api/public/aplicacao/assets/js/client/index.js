
findList();

/**
 * Carrega lista de registros
 */
function findList(){
    $("#result").html('');
    $.ajax({
        url: 'http://localhost/api/v1/clients',
        headers: {
            'Authorization': 'Bearer '+localStorage.getItem('token'),
        },
        method: 'GET',
        success: function(data){
            let content = '';
            $.each(data, function() {
                content += `
                <tr>
                <td>${this.name}</td>
                <td>${this.telephone}</td>
                <td>${this.mail}</td>
                <td>
                    <a href="#" class="link_item" url="client/create.html" id_item="${this.id}">Editar</a>&nbsp&nbsp
                    <a href="#" class="link_item" url="order/index.html" id_item="${this.id}">Pedidos</a>&nbsp&nbsp
                    <a href="#" class="delete" id="${this.id}">Apagar</a>
                    </td>
                </tr>
                `;
            });
            $("#result").html(content);
            $('#list').DataTable();
            menu();
            deleteItem();
        }
    });
}

/**
 * Define evento de remover registro
 */
function deleteItem(){
    $(".delete").off("click");
    $(".delete").on("click", function(event){
        event.preventDefault();
        let r = confirm('Deseja remover item?');
        if(r){
            let url = 'http://localhost/api/v1/clients/'+$(this).attr('id');
            $.ajax({
                url: url,
                data: {
                    "_method": "delete"
                },
                headers: {
                    'Authorization': 'Bearer '+localStorage.getItem('token'),
                },
                method: 'POST',
                success: function(data){
                    if(data){
                        alert('Apagado com sucesso!');
                    }else{
                        alert('Erro ao apagar!');
                    }
                    findList();
                }
            });
        }
    });
}
