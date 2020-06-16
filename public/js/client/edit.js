var ClientEdit = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _autoLoading = {
        dataClients: function() {
            var json = _configurationGeneral.submitPost("/api/v1/users/" + $("#hdnUserId").val(), {}, "GET");
            
            $("#txtId").val(json.data.id);
            $("#txtName").val(json.data.name);
            $("#txtEmail").val(json.data.email);
        },
    },
    _clickButton = {
        updateClient: function(){
            $("#btnUpdateClient").click(function() {
                _configurationGeneral.submitPost("/api/v1/users/" + $("#hdnUserId").val(), $("form").serializeArray(), "PUT");

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
            _clickButton.updateClient();
        }
    };
    return {
        init: init
    };
})();