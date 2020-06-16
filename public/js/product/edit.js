var ProductEdit = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _autoLoading = {
        dataClients: function() {
            var json = _configurationGeneral.submitPost("/api/v1/product/" + $("#hdnProductId").val(), {}, "GET");
            
            $("#txtId").val(json.data.id);
            $("#txtTitle").val(json.data.title);
            $("#txtPrice").val(json.data.price);
            $("#txtDescription").val(json.data.description);
        },
    },
    _clickButton = {
        updateProduct: function(){
            $("#btnUpdateProduct").click(function() {
                _configurationGeneral.submitPost("/api/v1/product/" + $("#hdnProductId").val(), $("form").serializeArray(), "PUT");

                $("#divMessage").removeClass("d-none");
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

                    $("#divMessage").removeClass("alert-danger");
                    $("#divMessage").addClass("alert-success").text(data.message);
                    return false;
                },
                error: function(data) {
                    $("#divMessage").addClass("alert-danger").text(data.responseText);
                    $("#divMessage").removeClass("d-none");
                }
            });
            
            return json;
        },
    },
    _load = {
        begin: function(){
            _autoLoading.dataClients();
            _clickButton.updateProduct();
        }
    };
    return {
        init: init
    };
})();