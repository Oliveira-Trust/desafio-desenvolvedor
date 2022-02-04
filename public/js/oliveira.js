$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip()
    //Tratar busca avancada
    $('.botao-busca-avancada').on('click',function(){
        if($('.div-busca-avancada').css('display') != 'none'){
            // $(this).removeClass('btn-outline-dark');
            // $(this).addClass('btn-dark');
            $('.div-busca-avancada').addClass('hidden');
            $(this).find('i').addClass('fa-search-plus').removeClass('fa-search-minus');
        }else{
            // $(this).addClass('btn-outline-dark');
            // $(this).removeClass('btn-dark');
            $('.div-busca-avancada').removeClass('hidden');
            $(this).find('i').removeClass('fa-search-plus').addClass('fa-search-minus');
        }
    });
    $('body').delegate('.botao-reset','click',function(){
        $(':input','#form-busca-avancada')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
    });

    // Modal de botão cancelar padrão 
    // $('.botao-deletar').on('click',function(){
    $('body').delegate('.botao-deletar','click',function(){
        $('#form-modal-excluir').attr('action', '');
        $('#form-modal-excluir').attr('action', $(this).attr('data-action'));
        if($(this).attr('data-titulo') != '' && $(this).attr('data-titulo') != undefined){
            $('#modal-excluir-titulo').html('');
            $('#modal-excluir-titulo').html($(this).attr('data-titulo'));
        }
        if($(this).attr('data-msg') != '' && $(this).attr('data-msg') != undefined){
            $('#div-modal-excluir-msg').html('');
            $('#div-modal-excluir-msg').html($(this).attr('data-msg'));
        }
        $('#modal-excluir').modal('show');
    });
    //Botao modal
    $('body').delegate('.botao-modal-admin','click',function(){
        $('#form-modal-admin').attr('action', '');
        $('#form-modal-admin').attr('action', $(this).attr('data-action'));
        if($(this).attr('data-titulo') != '' && $(this).attr('data-titulo') != undefined){
            $('#modal-admin-titulo').html('');
            $('#modal-admin-titulo').html($(this).attr('data-titulo'));
        }
        if($(this).attr('data-msg') != '' && $(this).attr('data-msg') != undefined){
            $('#div-modal-admin-msg').html('');
            $('#div-modal-admin-msg').html($(this).attr('data-msg'));
        }
        $('#modal-admin').modal('show');
    });
    //DataTable padrão
    $('.data-table-padrao').DataTable({
        "info": false,
        "lengthChange": false,
        "bPaginate": false,
        // "searching": false, 
        "oLanguage": {
            "sSearch": "Pesquisar",
            "sEmptyTable": "Não há dados!"
        }
    }); 
    //Remover Validacao apos sair do input
    $("form :input").change(function() {
        $(this).removeClass('is-invalid');
        if($(this).parent().parent().find('.invalid-feedback-input-group').length > 0 ){
            $(this).parent().parent().find('.invalid-feedback-input-group').remove();
            $(this).parent().parent().find('.btn-outline-danger').removeClass('btn-outline-danger').addClass(' btn-outline-secondary');
        }
    });

});

function gerarCodigo(id){
    var data = new Date().getTime();
    // var cod = (jQuery.randomBetween(1, 99999) * data)+"";
    var cod = (Math.floor(Math.random() * 99999) * data)+"";
    cod = "20"+cod.substr(-10);
    cod += calcEanDv(cod);
    $('#'+id).val(cod);
    $('#'+id).removeClass('is-invalid');
    if($('#'+id).parent().parent().find('.invalid-feedback-input-group').length > 0 ){
        $('#'+id).parent().parent().find('.invalid-feedback-input-group').remove();
        $('#'+id).parent().parent().find('.btn-outline-danger').removeClass('btn-outline-danger').addClass(' btn-outline-secondary');
    }
};

function calcEanDv(value){
    var pares = 0 ;
    var impares = 0;
    var dv = '';
    var cod = value.replace('-','');
     /* verificando se tem todos os digitos, caso nao haja criando-o e fazendo verificacao caso tenha */
    if(cod.length <= 11){
        return false;
    } 
    //Verificar
    for (i=0; i <= 11; i++){
        mod = i%2;
        if( mod == 0 ){
            pares += parseInt(value[i]);
        }else{
            impares += parseInt(value[i]) * 3;
        }
    }
    dv = 10 - ((impares + pares) % 10);
    if (dv > 9){ dv=0; }
    return dv;
}

function reiniciarDataTable(){
    $('.data-table-padrao').dataTable().fnDestroy() 
    $('.data-table-padrao').DataTable({
        "info": false,
        "lengthChange": false,
        "bPaginate": false,
        // "searching": false, 
        "oLanguage": {
            "sSearch": "Pesquisar",
            "sEmptyTable": "Não há dados!"
        }
    }); 
    $('[data-toggle="tooltip"]').tooltip();
}

function mensagemSucesso(mensagem){
    $('#flashMessage').remove();
    var flashMessage = '';
    flashMessage += '<div id="flashMessage" class="alert alert-success" role="alert">';
        flashMessage += '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>';
        flashMessage += mensagem;
    flashMessage += '</div>';
    $('.container-fluid').prepend(flashMessage);
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}



function formatarNumero(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}
function formatarDinheiro(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") { return; }

    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");
        
    // check for decimal
    if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatarNumero(left_side);

        // validate right side
        right_side = formatarNumero(right_side);
        
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
        right_side += "00";
        }
        
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = "$" + left_side + "." + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatarNumero(input_val);
        input_val = "$" + input_val;
        
        // final formatting
        if (blur === "blur") {
        input_val += ".00";
        }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function formatarPorcentagem(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") { return; }

    // original length
    var original_len = input_val.length;

    // initial caret position 
    var caret_pos = input.prop("selectionStart");
        
    // check for decimal
    if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatarNumero(left_side);

        // validate right side
        right_side = formatarNumero(right_side);
        
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
        right_side += "00";
        }
        
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = "%" + left_side + "." + right_side;

    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatarNumero(input_val);
        input_val = "%" + input_val;
        
        // final formatting
        if (blur === "blur") {
        input_val += ".00";
        }
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}