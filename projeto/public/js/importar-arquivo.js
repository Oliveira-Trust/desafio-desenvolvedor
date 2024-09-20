const form = document.getElementById('uploadForm');
const fileInput = document.getElementById('fileInput');
const submitButton = document.getElementById('submitButton');
const responseMessage = document.getElementById('responseMessage');

form.addEventListener('submit', async function (event) {
    event.preventDefault();

    const formData = new FormData();
    formData.append('file', fileInput.files[0]);

    submitButton.disabled = true;
    submitButton.textContent = 'Enviando...';

    try {
        const response = await fetch('/api/arquivo', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });

        const result = await response.json();
        console.log(result)
        if (response.ok) {
            responseMessage.textContent = result.message;
            responseMessage.classList.add('text-green-500');
        } else {
            responseMessage.textContent = 'Erro ao enviar o arquivo: ' + result.message;
            responseMessage.classList.add('text-red-500');
        }
    } catch (error) {
        responseMessage.textContent = 'Erro na requisição: ' + error.message;
        responseMessage.classList.add('text-red-500');
    } finally {
        submitButton.disabled = false;
        submitButton.textContent = 'Enviar Arquivo';
    }
});
