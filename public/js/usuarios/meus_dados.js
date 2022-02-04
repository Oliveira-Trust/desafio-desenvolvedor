$(document).ready(function(){
    $('#gerar-credenciais').click(function(){
        gerarCodigo('cliente_id');
        gerarCodigo('cliente_secret');
    });

    $("#limpar-credencial").click(function(e){
        $('#form-credenciais')[0].reset();
        $('#form-credenciais #credencial-id').val('');
    });
    $("#salvar-credencial").click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.validacao-credenciais').hide();
        $.ajax({
            type:'POST',
            url:rotaSalvarCredencial,
            data:$('#form-credenciais').serialize(),
            dataType: 'json',
            success:function(data){
                // console.log(data.credenciais);
                atualizarTabelaCredenciais()
                mensagem = 'Credencial de api cadastrada com sucesso!';
                if($('#form-credenciais #credencial-id').val() != ''){
                    mensagem = 'Credencial de api atualizada com sucesso!';
                }
                $('#form-credenciais')[0].reset();
                $('#form-credenciais #credencial-id').val('');
                mensagemSucesso(mensagem);
            },
            error: function (retorno) {
                if(retorno.responseJSON.errors.nome != undefined){
                    // console.log(retorno.responseJSON.errors.nome); 
                    $('#nome-validar').html('');
                    $('#nome-validar').html(retorno.responseJSON.errors.nome);
                    $('#nome-validar').show();
                }
                if(retorno.responseJSON.errors.email != undefined){
                    // console.log(retorno.responseJSON.errors.email); 
                    $('#email-validar').html('');
                    $('#email-validar').html(retorno.responseJSON.errors.email);
                    $('#email-validar').show();
                }
                if(retorno.responseJSON.errors.password != undefined){
                    // console.log(retorno.responseJSON.errors.password); 
                    $('#password-validar').html('');
                    $('#password-validar').html(retorno.responseJSON.errors.password);
                    $('#password-validar').show();
                }
            },
        });
    });
});

function atualizarTabelaCredenciais(){
    $.ajax({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        url: rotaBuscarCredenciais,
        type: 'GET',
        // cache: false,
        // data: { 'userid': userid, '_token': $_token }, //see the $_token
        datatype: 'html',
        beforeSend: function() {
            //something before send
        },
        success: function(data) {
            console.log('success');
            console.log(data);
            $('#card-tabela-credenciais').html(data.html);
            reiniciarDataTable();
        },
        error: function(xhr,textStatus,thrownError) {
        }
    });
}
function montarEditar(id,nome,email){
    $('#form-credenciais')[0].reset();
    $('#form-credenciais #credencial-id').val(id);
    $('#form-credenciais #credencial-nome').val(nome);
    $('#form-credenciais #credencial-email').val(email);
}

window.addEventListener('DOMContentLoaded', function () {
    var avatar = document.getElementById('avatar-foto-usuario');
    var image = document.getElementById('imagem-modal');
    var input = document.getElementById('arquivo-foto-usuario');
    var nomeArquivo = '';
    var $progress = $('.progress');
    var $progressBar = $('.progress-bar');
    var $alert = $('.alert');
    var $modal = $('#modal-cortar-foto');
    var cropper;
    $('[data-toggle="tooltip"]').tooltip();
    input.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
        nomeArquivo = files[0].name;
        input.value = '';
        image.src = url;
        // $alert.hide();
        $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
        file = files[0];
        if (URL) {
            done(URL.createObjectURL(file));
        } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
            done(reader.result);
            };
            reader.readAsDataURL(file);
        }
        }
    });
    var minAspectRatio = 0.5;
    var maxAspectRatio = 1.5;
    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
        ready: function () {
            var cropper = this.cropper;
            var containerData = cropper.getContainerData();
            var cropBoxData = cropper.getCropBoxData();
            var aspectRatio = cropBoxData.width / cropBoxData.height;
            var newCropBoxWidth;
            if (aspectRatio < minAspectRatio || aspectRatio > maxAspectRatio) {
            newCropBoxWidth = cropBoxData.height * ((minAspectRatio + maxAspectRatio) / 2);
            cropper.setCropBoxData({
                left: (containerData.width - newCropBoxWidth) / 2,
                width: newCropBoxWidth
            });
            }
        },
        cropmove: function () {
            var cropper = this.cropper;
            var cropBoxData = cropper.getCropBoxData();
            var aspectRatio = cropBoxData.width / cropBoxData.height;
            if (aspectRatio < minAspectRatio) {
            cropper.setCropBoxData({
                width: cropBoxData.height * minAspectRatio
            });
            } else if (aspectRatio > maxAspectRatio) {
            cropper.setCropBoxData({
                width: cropBoxData.height * maxAspectRatio
            });
            }
        },
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    // document.getElementById('crop').addEventListener('click', function () {
    $('#crop').click(function () {
        var initialAvatarURL;
        var canvas;
        $modal.modal('hide');
        if (cropper) {
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });
        initialAvatarURL = avatar.src;
        avatar.src = canvas.toDataURL();
        $progress.show();
        $alert.removeClass('alert-success alert-warning');
        canvas.toBlob(function (blob) {
            var formData = new FormData();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            formData.append('avatar', blob, nomeArquivo);
            $.ajax(rotaAtualizarFoto, {
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
                var xhr = new XMLHttpRequest();
                xhr.upload.onprogress = function (e) {
                var percent = '0';
                var percentage = '0%';
                if (e.lengthComputable) {
                    percent = Math.round((e.loaded / e.total) * 100);
                    percentage = percent + '%';
                    $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                }
                };
                return xhr;
            },
            success: function () {
                $('#div-top').empty();
                var mensagem = '';
                mensagem += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> ';
                mensagem += 'Foto atualizada com sucesso.';
                $('#div-top').addClass('alert-success');
                $('#div-top').html(mensagem);
                if($('#avatar-foto-usuario').attr('src') != ''){
                $('#img-perfil-topo').attr('src', $('#avatar-foto-usuario').attr('src'));
                }
            },
            error: function () {
                avatar.src = initialAvatarURL;
                $alert.show().addClass('alert-warning').text('Upload error');
            },
            complete: function () {
                $progress.hide();
            },
            });
        });
        }
    });
});