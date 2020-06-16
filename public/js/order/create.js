var OrderCreate = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _autoLoading = {
        selectDataProducts: function() {
            var html = "<option value='' selected>Escolha...</option>",
                json = "";
            
            json = _configurationGeneral.submitPost("/api/v1/product", {}, "GET");
            
            $(json.data).each(function(i, data) {
                html += "<option value='" + data.id + "'>" + data.title + "</option>";
            });

            $("#selProducts").html(html);
        },
    },
    _clickButton = {
        addProduct: function(){
            $("#btnAddProduct").click(function() {

                $("#divMessage").addClass("d-none");

                if($("#selProducts").val().length < 1) {
                    $("#divMessage").addClass("alert-danger").removeClass("d-none").text("Selecione um produto");
                    return false;
                }

                if($("#txtQuantity").val().length < 1) {
                    $("#divMessage").addClass("alert-danger").removeClass("d-none").text("Informe a Quantidade");
                    return false;
                }

                var html = "<div class='form-row'>" +
                                "<div class='form-group col-sm-2'>" +
                                    "<input type='text' class='form-control form-control-sm' name='products[]' value='" + $("#selProducts").val() + "-" + $("#txtQuantity").val() + "' readonly />" +
                                "</div>" +
                                "<div class='form-group col-sm-1'>" +
                                    "<button type='button' class='btn btn-xs btn-outline-danger btnRemoveProduct' title='Remover Produto'>" +
                                        "<i class='material-icons vertical-align-middle'>delete_outline</i>" +
                                    "</button>" +
                                "</div>" +
                            "</div>";

                $("#divProductSelected").append(html);
            });
        },
        removeProduct: function(){
            $("form").on("click", ".btnRemoveProduct", function() {
                $(this).parent().parent().remove();
            });
        },
        saveOrder: function(){
            $("#btnSaveOrder").click(function() {
                _configurationGeneral.submitPost("/api/v1/order", $("form").serializeArray(), "POST");

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
            _clickButton.addProduct();
            _clickButton.removeProduct();
            _clickButton.saveOrder();
            _autoLoading.selectDataProducts();
        }
    };
    return {
        init: init
    };
})();