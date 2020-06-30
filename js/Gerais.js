function Gerais() {

    this.abreModalInserirGenerico = function () {
        $("#modalInserirGenerico").modal();
    };

    this.ativaTodosChecksClientes = function (){
        $('#ativaTodosChecksClientes').click(function() {
            if ($(this).is(':checked')) {
                $('div input').prop('checked', true);
            } else {
                $('div input').prop('checked', false);
            }
        });
    };



}

