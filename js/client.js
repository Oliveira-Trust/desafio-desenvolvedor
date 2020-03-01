function Client() {

    this.getClientList = function() {

        returnData('controllers/ClientController.php?acao=index', 'get');

        var json = response;

        return json;
    }
}