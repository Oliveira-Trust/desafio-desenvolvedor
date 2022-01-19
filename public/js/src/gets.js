$.ajax({
    type: 'get',
    dataType: 'json',
    url: `/quotations/getAll` + location.search

}).done(function (dados){
    console.log(dados)
})