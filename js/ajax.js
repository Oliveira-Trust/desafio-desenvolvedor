var response = ''

function returnData(page, method, data) {

    $.ajax({
        url : '../' + page,
        type : method,
        data : data,
        async: false,
    })
    .done(function(json){
        response = JSON.parse(json);
    })
    .fail(function(jqXHR, textStatus, msg){
        alert(msg);
    }); 

}