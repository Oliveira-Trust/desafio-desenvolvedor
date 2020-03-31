function Cruds() {

    this.bindDelete = function (destiny,classBind,classIdName) {

        if (typeof classBind   === "undefined"){classBind   = 'a.btn-delete';}
        if (typeof classIdName === "undefined"){classIdName = 'data-id';}

        $(classBind).on('click',function(){
            let dataId = $(this).attr(classIdName);
            swal({
                title: 'Deseja excluir esse registro?',
                text: "Esta ação não poderá ser desfeita!",
                confirmButtonText: 'Sim',
                showCancelButton: true
            }).then((result) => {
                if ( typeof result.dismiss === "undefined" ) {
                    $('.swal-button--confirm').html(helper.htmlSpinner());
                    $.ajax({
                        url: "/api/delete/"+destiny+"@"+dataId,
                        success: function (data, jqXHR) {
                            helper.alertSucess('Registros deletado com sucesso!');
                            location.reload();
                        },
                        error: function(data, jqXHR) {
                            //console.log(data.responseJSON);
                            let msgError = 'Ocorreu um erro!';
                            if( typeof data.responseJSON.error !== 'undefined' ){
                                msgError = data.responseJSON.messages;
                            }
                            helper.alertError(msgError)
                        }
                    });
                }
            })
        });

    };

}

var cruds = new Cruds();
