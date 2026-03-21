import { initAppShell } from './modules/app-shell.js';
import { initLoginPage } from './modules/login.js';
import { initUploadForm } from './modules/upload-form.js';
import { initUploadHistory } from './modules/upload-history.js?v=20260321-2';

const currentPage = document.body.dataset.page;

initAppShell();

if (currentPage === 'login') {
    initLoginPage();
}

if (currentPage === 'upload-index') {
    initUploadForm();
}

if (currentPage === 'upload-history') {
    initUploadHistory();
}
