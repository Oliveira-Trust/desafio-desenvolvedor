
//Para o close button do popup
$('.popup-confirm .mfp-close').unbind('click').click(function (e) {
    e.preventDefault();
    const didConfirm = confirm("Você tem certeza que deseja fechar o cadastro?");
    if (didConfirm === false) {
        return false;
    }
});

$('.popup-modal-dismiss-confirm').click(function (e) {
    e.preventDefault();
    $('.popup-confirm .mfp-close').trigger("click");
    /*const didConfirm = confirm("Você tem certeza que deseja cancelar o cadastro?");
    if (didConfirm === false) {
        return false;
    }

    $.magnificPopup.close();*/
})
$('.popup-modal-dismiss').click(function (e) {
    e.preventDefault();
    $.magnificPopup.close();
});


/*$('.popup-modal-dismiss').click(function (e) {
    e.preventDefault();
    $.magnificPopup.close();
});


$('.popup-modal-dismiss-confirm').click(function (e) {
    e.preventDefault();
    // $('.popup-confirm .mfp-close').trigger("click");
    var didConfirm = confirm("Você tem certeza que deseja cancelar o cadastro?");
    if (didConfirm == false) {
        return false;
    }

    $.magnificPopup.close();
});*/

/*$('.popup-modal-dismiss-click-add').click(function (e) {
    e.preventDefault();
    /!*var didConfirm = confirm("Você tem certeza que deseja cancelar o cadastro?");
    if (didConfirm == false) {
        return false;
    }*!/

    $.magnificPopup.close();
    $('.btn-add').trigger("click");
});*/
