$(document).ready(function(){
    //Função em oliveira.js - formatarDinheiro
    $("input[data-type='dinheiro']").on({
        keyup: function() {
            formatarDinheiro($(this));
        },
        blur: function() { 
            formatarDinheiro($(this), "blur");
        }
    });
});
