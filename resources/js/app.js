import './bootstrap';
import { initAppShell } from './modules/app-shell';
import { initLoginPage } from './modules/login';
import { initUploadForm } from './modules/upload-form';
import { initUploadHistory } from './modules/upload-history';

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
