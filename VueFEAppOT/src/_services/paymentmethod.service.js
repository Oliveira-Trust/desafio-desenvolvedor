import config from 'config';
import { handleResponse, requestOptions } from '@/_helpers';

export const paymentMethodService = {
    getAll,
    getById
};

function getAll() {
    return fetch(`${config.apiUrl}/payment-methods`, requestOptions.get())
        .then(handleResponse);
}

function getById(id) {
    return fetch(`${config.apiUrl}/payment-methods/${id}`, requestOptions.get())
        .then(handleResponse);
}