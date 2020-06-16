var ProductView = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _autoLoading = {
        dataClients: function(page=1) {
            var html = "",
                fields = {page: page},
                json = _configurationGeneral.submitPost("/api/v1/product", fields, "GET");
                
            $(json.data).each(function(i, product) {
                html += "<tr>" +
                            "<td>" +
                                "<button type='button' product_id='" + product.id + "' class='btn btn-xs btn-outline-danger destroyProduct' title='Excluir Produto'>" +
                                    "<i class='material-icons vertical-align-sub md-17'>close</i>" +
                                "</button>" +
                                "<a href='/product/" + product.id + "' class='btn btn-xs btn-outline-success' title='Editar Produto'>" +
                                    "<i class='material-icons vertical-align-sub md-17'>edit</i>" +
                                "</a>" +
                            "</td>" +
                            "<td>" + product.id + "</td>" +
                            "<td>" + product.title + "</td>" +
                            "<td>" + product.description + "</td>" +
                            "<td>R$ " + product.price + "</td>" +
                            "<td>" + product.created_at + "</td>" +
                        "</tr>";
            });

            $("table tbody").html(html);
            createPaginator(json);
        },
    },
    _clickButton = {
        destroy: function(){
            $(".destroyProduct").click(function() {
                var productId = $(this).attr("product_id");

                _configurationGeneral.submitPost("/api/v1/product/" + productId, {}, "DELETE");
                location.reload();
            });
        },
        nextPage: function(){
            $("#paginationNav").on("click", ".page-link", function() {
                _autoLoading.dataClients($(this).attr("page"));
            });
        },
    },
    _configurationGeneral = {
        submitPost: function(url, fields, type){
            var json,
                csrfToken = $('meta[name="csrf-token"]').attr('content');

            Object.assign(fields, {name: "_token", value: csrfToken});

            $.ajax({
                url: url,
                data: fields,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", 'Bearer ' + localStorage.getItem("token-jwt"));
                },
                type: type,
                async: false,
                success: function(data){
                    json = data;
                    return false;
                }
            });
            
            return json;
        },
    },
    _load = {
        begin: function(){
            _autoLoading.dataClients();
            _clickButton.destroy();
            _clickButton.nextPage();
        }
    };
    return {
        init: init
    };
})();