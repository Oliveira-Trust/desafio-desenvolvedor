function Product() {

    this.getProductList = function() {

        returnData('controllers/ProductController.php?acao=index', 'get');

        var json = response;

        return json;
    }
}