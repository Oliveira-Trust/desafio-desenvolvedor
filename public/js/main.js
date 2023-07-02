function alterarPosicao(alterar = 'desativado'){
    if(alterar == 'ativo'){
        $("#home_painel").addClass("home-pg");
    }
    else {
        $("#home_painel").removeClass("home-pg");
    }
}

