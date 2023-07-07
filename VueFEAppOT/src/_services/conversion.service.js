import config from 'config';
import { handleResponse, requestOptions } from '@/_helpers';

export const conversionService = {
    conversion,
//    getById
};

function conversion(conversionData) {
    const { conversion_value, destination_currency, payment_method_id } = conversionData;
    const params = new URLSearchParams({ conversion_value, destination_currency, payment_method_id });

    const url = `${config.apiUrl}/conversion?${params.toString()}`;
    return fetch(url, requestOptions.post())
        .then(handleResponse);
}

// function getAll() {
//     return fetch(`${config.apiUrl}/payment-methods`, requestOptions.get())
//         .then(handleResponse);
// }

// function getById(id) {
//     return fetch(`${config.apiUrl}/payment-methods/${id}`, requestOptions.get())
//         .then(handleResponse);
// }