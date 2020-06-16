function getNextItem(data) {
    i = data.meta.current_page+1;
    if (data.meta.current_page == data.meta.last_page) 
        s = '<li class="page-item disabled">';
    else
        s = '<li class="page-item">';
    s += '<a class="page-link" ' + 'page="'+i+'" ' + ' href="javascript:void(0);">Próximo</a></li>';
    return s;
}

function getPreviousItem(data) {
    i = data.meta.current_page-1;
    if (data.meta.current_page == 1) 
        s = '<li class="page-item disabled">';
    else
        s = '<li class="page-item">';
    s += '<a class="page-link" ' + 'page="'+i+'" ' + ' href="javascript:void(0);">Anterior</a></li>';
    return s;
}

function getItem(data, i) {
    if (data.meta.current_page == i) 
        s = '<li class="page-item active">';
    else
        s = '<li class="page-item">';
    s += '<a class="page-link" ' + 'page="'+i+'" ' + ' href="javascript:void(0);">' + i + '</a></li>';
    return s;
}

function createPaginator(data) {
    $("#paginationNav > ul > li").remove();

    $("#paginationNav > ul").append(
        getPreviousItem(data)
    );
    
    n = 2;
    
    if (data.meta.current_page - n/2 <= 1)
        first = 1;
    else if (data.meta.last_page - data.meta.current_page < n)
        first = data.meta.last_page - n + 1;
    else 
        first = data.meta.current_page - n/2;
    
    last = first + n-1;

    for (i=first;i<=last;i++) {
        $("#paginationNav>ul").append(
            getItem(data,i)
        );
    }
    $("#paginationNav>ul").append(
        getNextItem(data)
    );
}