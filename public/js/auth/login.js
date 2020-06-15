var Login = (function(){
    "use strict";
    
    var init = function(){
        _load.begin();
    },
    _clickButton = {
        login: function(){
            $("#btnLogin").click(function() {
                var fields = {
                    "email": $("#email").val(),
                    "password": $("#password").val(),
                };

                $.post("/api/v1/login", fields, function(data, textStatus, xhr) {
                    localStorage.setItem("token-jwt", data.token)
                    $("form").submit();
                });
            });
        },
    },
    _load = {
        begin: function(){
            _clickButton.login();
        }
    };
    return {
        init: init
    };
})();