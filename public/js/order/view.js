var OrderView = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _autoLoading = {
        dataOrders: function(page=1) {
            var coditions = "",
                fields = {page: page},
                json = "";
                
            if($("#txtUser").val().length > 0) {
                coditions += "title:like:%" + $("#txtUser").val() + "%";
            }
            if($("#selStatus").val().length > 0) {
                if(coditions.length > 0) {
                    coditions += ";order_status_id:like:%" + $("#selStatus").val() + "%";
                } else {
                    coditions += "order_status_id:like:%" + $("#selStatus").val() + "%";
                }
            }
            if($("#txtTotal").val().length > 0) {
                if(coditions.length > 0) {
                    coditions += ";total:>=:" + $("#txtTotal").val();
                } else {
                    coditions += "total:>=:" + $("#txtTotal").val();
                }
            }

            if(coditions.length > 0) {
                fields = {coditions: coditions};
            }

            json = _configurationGeneral.submitPost("/api/v1/order", fields, "GET");
            _configurationGeneral.createDataTable(json);
        },
    },
    _clickButton = {
        destroy: function(){
            $("table > tbody").on("click", ".destroyOrder", function() {
                var orderId = $(this).attr("order_id"),
                    fields = {order_condition: "payment_cancel"};

                _configurationGeneral.submitPost("/api/v1/order/" + orderId, fields, "PUT");
                location.reload();
            });
        },
        paidOrder: function(){
            $("table > tbody").on("click", ".paidOrder", function() {
                var orderId = $(this).attr("order_id"),
                    fields = {order_condition: "payment_done"};

                _configurationGeneral.submitPost("/api/v1/order/" + orderId, fields, "PUT");
                location.reload();
            });
        },
        nextPage: function(){
            $("#paginationNav").on("click", ".page-link", function() {
                _autoLoading.dataOrders($(this).attr("page"));
            });
        },
        search: function() {
            $("#btnSearch").click(function() {
                _autoLoading.dataOrders();
            });
        },
    },
    _configurationGeneral = {
        createDataTable: function(json) {
            var html = "";

            $(json.data).each(function(i, data) {
                html += "<tr>" +
                            "<td>" +
                                "<a href='/order/detail/" + data.id + "' class='btn btn-xs btn-outline-info' title='Detalhes do  Pedido'>" +
                                    "<i class='material-icons vertical-align-sub md-17'>find_in_page</i>" +
                                "</a>" +
                                "<button type='button' order_id='" + data.id + "' class='btn btn-xs btn-outline-danger destroyOrder' title='Cancelar Pedido'>" +
                                    "<i class='material-icons vertical-align-sub md-17'>close</i>" +
                                "</button>" +
                                "<a href='/order/" + data.id + "' class='btn btn-xs btn-outline-success' title='Editar Pedido'>" +
                                    "<i class='material-icons vertical-align-sub md-17'>edit</i>" +
                                "</a>" +
                                "<button type='button' order_id='" + data.id + "' class='btn btn-xs btn-outline-primary paidOrder' title='Efetuar baixa Pagamento'>" +
                                    "<i class='material-icons vertical-align-sub md-17'>done_outline</i>" +
                                "</button>" +
                            "</td>" +
                            "<td>" + data.id + "</td>" +
                            "<td>" + data.user.name + "</td>" +
                            "<td>R$ " + data.total + "</td>" +
                            "<td>" + data.order_status.status + "</td>" +
                            "<td>" + data.created_at + "</td>" +
                        "</tr>";
            });

            $("table tbody").html(html);
            createPaginator(json);
        },
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
            _autoLoading.dataOrders();
            _clickButton.destroy();
            _clickButton.nextPage();
            _clickButton.paidOrder();
            _clickButton.search();
        }
    };
    return {
        init: init
    };
})();