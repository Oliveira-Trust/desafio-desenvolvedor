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

    this.removePosicaoVazia = function (array) {

        array = array.filter(function (el) {
            return el != null;
        });

        return array;

    }



}

