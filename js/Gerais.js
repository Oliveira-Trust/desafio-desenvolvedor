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

    };


    this.limpaModalEditar = function(primeiraVez = false){

        var form =  document.querySelectorAll('#formularioModalEditarGenerico')[0].firstChild;

        if(primeiraVez === true){
            return;
        }

        if(form !== undefined && form !== null){
            form.remove();
        }

    };

    this.limpaModalInserir = function(primeiraVez = false){

        var form =  document.querySelectorAll('#formularioModalInserirGenerico')[0].firstChild;


        if(primeiraVez === true){
            return;
        }

        if(form !== undefined && form !== null){
            form.remove();
        }

    };



}

