var ClientView = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _autoLoading = {
        dataClients: function(page=1) {
            var fields = {page: page},
                coditions = "",
                json = "";

            
            if($("#txtName").val().length > 0) {
                coditions += "name:like:%" + $("#txtName").val() + "%";
            }
            if($("#txtEmail").val().length > 0) {
                if(coditions.length > 0) {
                    coditions += ";email:like:%" + $("#txtEmail").val() + "%";
                } else {
                    coditions += "email:like:%" + $("#txtEmail").val() + "%";
                }
            }

            if(coditions.length > 0) {
                fields = {coditions: coditions};
            }

            json = _configurationGeneral.submitPost("/api/v1/users", fields, "GET");
            _configurationGeneral.createDataTable(json);
        },
    },
    _clickButton = {
        destroy: function(){
            $("table > tbody").on("click", ".destroyClient", function() {
                var userId = $(this).attr("user_id");

                _configurationGeneral.submitPost("/api/v1/users/" + userId, {}, "DELETE");
                location.reload();
            });
        },
        nextPage: function(){
            $("#paginationNav").on("click", ".page-link", function() {
                _autoLoading.dataClients($(this).attr("page"));
            });
        },
        search: function() {
            $("#btnSearch").click(function() {
                _autoLoading.dataClients();
            });
        },
    },
    _configurationGeneral = {
        createDataTable: function(json) {
            var html = "";

            $(json.data).each(function(i, data) {
                html += "<tr>" +
                            "<td>" +
                                "<button type='button' user_id='" + data.id + "' class='btn btn-xs btn-outline-danger destroyClient' title='Excluir Cliente'>" +
                                    "<i class='material-icons vertical-align-sub md-17'>person_add_disabled</i>" +
                                "</button>" +
                                "<a href='/client/" + data.id + "' class='btn btn-xs btn-outline-success' title='Editar Cliente'>" +
                                    "<i class='material-icons vertical-align-sub md-17'>edit</i>" +
                                "</a>" +
                            "</td>" +
                            "<td>" + data.id + "</td>" +
                            "<td>" + data.name + "</td>" +
                            "<td>" + data.email + "</td>" +
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
            _autoLoading.dataClients();
            _clickButton.destroy();
            _clickButton.nextPage();
            _clickButton.search();
        }
    };
    return {
        init: init
    };
})();