function Gerais() {

    this.abreModalInserirGenerico = function () {
        $("#modalInserirGenerico").modal();
    };

    this.abreModalEditarGenerico = function (nomeCliente, prkCliente) {
        $('#modalEditarGenerico #editarNomeCliente').val(nomeCliente);
        $('#modalEditarGenerico #botaoSalvaAlteracoesModal').attr("onClick" ,"new Cliente().editarCliente("+prkCliente+")");
        $("#modalEditarGenerico").modal();
    }





}

