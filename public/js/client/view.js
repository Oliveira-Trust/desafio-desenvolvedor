var ClientView = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _autoLoading = {
        dataClients: function(page=1) {
            var html = "",
                fields = {page: page},
                json = _configurationGeneral.submitPost("/api/v1/users", fields, "GET");
                
            $(json.data).each(function(i, client) {
                html += "<tr>" +
                            "<td>" +
                                "<button type='button' user_id='" + client.id + "' class='btn btn-xs btn-outline-danger destroyClient' title='Excluir Cliente'>" +
                                    "<i class='material-icons vertical-align-sub md-17'>person_add_disabled</i>" +
                                "</button>" +
                                "<a href='/client/" + client.id + "' class='btn btn-xs btn-outline-success' title='Editar Cliente'>" +
                                    "<i class='material-icons vertical-align-sub md-17'>edit</i>" +
                                "</a>" +
                            "</td>" +
                            "<td>" + client.id + "</td>" +
                            "<td>" + client.name + "</td>" +
                            "<td>" + client.email + "</td>" +
                            "<td>" + client.created_at + "</td>" +
                        "</tr>";
            });

            $("table tbody").html(html);
            createPaginator(json);
        },
    },
    _clickButton = {
        destroy: function(){
            $(".destroyClient").click(function() {
                var userId = $(this).attr("user_id");

                _configurationGeneral.submitPost("/api/v1/users/" + userId, [], "DELETE");
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