$(document).ready(function() {
    $('#formularioConversao').on('submit', function(event) {
        const quantidade = $('#quantidade').val();
        if (quantidade < 1000 || quantidade > 100000) {
            event.preventDefault();
            alert('O valor para conversão deve estar entre R$ 1.000,00 e R$ 100.000,00.');
        }
    });

    $('#formularioEmail').on('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        $.ajax({
            url: '/enviar-email',
            method: 'POST',
            data: $(this).serialize(), // Serializa os dados do formulário
            success: function(response) {
                $('#message-success').text(response.message).show(); // Exibe a mensagem de sucesso
            },
            error: function(xhr) {
                console.log(xhr.responseText); // Log de erro para depuração
                $('#message-error').text('Erro ao enviar e-mail.').show(); // Mensagem de erro
            }
        });
    });

    $('#btn-resetar').on('click', function(event) {
        event.preventDefault();  
        window.location.href = '/conversor';
    });    
});

