var ClientView = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _clickButton = {
        destroy: function(){
            $(".destroyClient").click(function() {
                var userId = $(this).attr("user_id");

                _configurationGeneral.submitPost("/api/v1/users/" + userId, [], "DELETE");
                location.reload();
            });
        },
    },
    _configurationGeneral = {
        submitPost: function(url, fields, type){
            var json,
                csrfToken = $('meta[name="csrf-token"]').attr('content');

            fields.push({name: "_token", value: csrfToken});

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
            _clickButton.destroy();
        }
    };
    return {
        init: init
    };
})();