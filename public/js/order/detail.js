var OrderDetail = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _autoLoading = {
        dataProducts: function() {
            var json = "";
                
            json = _configurationGeneral.submitPost("/api/v1/order/" + $("#hdnOrderId").val(), {}, "GET");
            _configurationGeneral.createDataTable(json);
        },
    },
    _configurationGeneral = {
        createDataTable: function(json) {
            var html = "";

            $(json.data.product).each(function(i, data) {
                html += "<tr>" +
                            "<td>" + data.id + "</td>" +
                            "<td>" + data.title + "</td>" +
                            "<td>" + data.description + "</td>" +
                            "<td>R$ " + data.price + "</td>" +
                            "<td>" + data.pivot.quantity + "</td>" +
                            "<td>" + data.created_at + "</td>" +
                        "</tr>";
            });

            $("table tbody").html(html);
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
            _autoLoading.dataProducts();
        }
    };
    return {
        init: init
    };
})();