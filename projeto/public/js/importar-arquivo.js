const form = document.getElementById('uploadForm');
const fileInput = document.getElementById('fileInput');
const submitButton = document.getElementById('submitButton');
const responseMessage = document.getElementById('responseMessage');

form.addEventListener('submit', async function(event) {
    event.preventDefault(); // Evita o envio padrão do formulário

    // Cria um objeto FormData para enviar o arquivo
    const formData = new FormData();
    formData.append('file', fileInput.files[0]);

    // Alterar o estado do botão para "Enviando..."
    submitButton.disabled = true;
    submitButton.textContent = 'Enviando...';

    try {
        // Envia a requisição POST usando fetch
        const response = await fetch('/api/arquivo', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'// Adiciona o token CSRF se necessário
            }
        });

        const result = await response.json();
        console.log(result)
        if (response.ok) {
            // Exibe mensagem de sucesso
            // responseMessage.textContent = 'Arquivo enviado com sucesso!';
            responseMessage.textContent = result.message;
            responseMessage.classList.add('text-green-500');
        } else {
            // Exibe mensagem de erro
            responseMessage.textContent = 'Erro ao enviar o arquivo: ' + result.message;
            responseMessage.classList.add('text-red-500');
        }
    } catch (error) {
        // Exibe mensagem de erro em caso de falha
        responseMessage.textContent = 'Erro na requisição: ' + error.message;
        responseMessage.classList.add('text-red-500');
    } finally {
        // Restaura o estado do botão após a conclusão da requisição
        submitButton.disabled = false;
        submitButton.textContent = 'Enviar Arquivo';
    }
});
