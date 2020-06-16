var ProductCreate = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _clickButton = {
        saveProduct: function(){
            $("#btnSaveProduct").click(function() {
                _configurationGeneral.submitPost("/api/v1/product", $("form").serializeArray(), "POST");

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
            _clickButton.saveProduct();
        }
    };
    return {
        init: init
    };
})();