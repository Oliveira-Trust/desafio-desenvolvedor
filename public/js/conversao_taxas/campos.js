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
