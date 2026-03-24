import { apiFetch, getErrorCode, getErrorMessage, getSuccessData, getSuccessMessage } from '../services/http';
import { clearFeedback, showFeedback } from '../utils/feedback';

const allowedExtensions = ['csv', 'xls', 'xlsx'];
const allowedMimeTypes = [
    'text/csv',
    'application/csv',
    'application/vnd.ms-excel',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'text/plain',
];

function getExtension(fileName) {
    const parts = fileName.split('.');
    return parts.length > 1 ? parts.pop().toLowerCase() : '';
}

function isAllowedFile(file) {
    const extension = getExtension(file.name);

    if (!allowedExtensions.includes(extension)) {
        return false;
    }

    return !file.type || allowedMimeTypes.includes(file.type.toLowerCase());
}

function getUploadErrorMessage(data) {
    if (getErrorCode(data) === 'UPLOAD_DUPLICATE_FILE') {
        return getErrorMessage(data) || 'Não é possível enviar o mesmo arquivo duas vezes.';
    }

    return getErrorMessage(data) || 'Não foi possível enviar o arquivo.';
}

export function initUploadForm() {
    const form = document.getElementById('upload-form');
    const fileInput = document.getElementById('file');
    const submitButton = document.getElementById('submit-btn');
    const feedback = document.getElementById('feedback');

    if (!form || !fileInput || !submitButton || !feedback) {
        return;
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const file = fileInput.files[0];

        if (!file) {
            showFeedback(feedback, 'Selecione um arquivo para continuar.', 'error');
            return;
        }

        if (!isAllowedFile(file)) {
            showFeedback(feedback, 'Formato inválido. Envie apenas arquivos .csv, .xls ou .xlsx.', 'error');
            return;
        }

        submitButton.disabled = true;
        clearFeedback(feedback);

        const formData = new FormData();
        formData.append('file', file);

        try {
            const { response, data } = await apiFetch('/api/uploads', {
                method: 'POST',
                auth: true,
                body: formData,
            });

            if (!response.ok) {
                showFeedback(feedback, getUploadErrorMessage(data), 'error');
                return;
            }

            const responseData = getSuccessData(data);
            const message = getSuccessMessage(data) || 'Upload realizado com sucesso.';
            const fileName = responseData?.upload?.filename ? `\nArquivo: ${responseData.upload.filename}` : '';
            showFeedback(feedback, `${message}${fileName}`, 'success');
            form.reset();
        } catch (error) {
            showFeedback(feedback, error.message || 'Erro de conexão ao tentar enviar o arquivo.', 'error');
        } finally {
            submitButton.disabled = false;
        }
    });
}
