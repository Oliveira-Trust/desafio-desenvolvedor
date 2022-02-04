$(document).ready(function(){
    //Função em oliveira.js - formatarPorcentagem
    $("input[data-type='porcentagem']").on({
        keyup: function() {
            formatarPorcentagem($(this));
        },
        blur: function() { 
            formatarPorcentagem($(this), "blur");
        }
    });
});
