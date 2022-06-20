import axios from 'axios'
import {store} from "../store";

const $axios = axios.create({
    baseURL: `/`,
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
});

$axios.defaults.withCredentials = true;

$axios.interceptors.request.use(function (config) {
    if (store.state.user.id > 0) {
        config.headers.Authorization = `Bearer ${store.state.user.token}`;
    }

    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

export default $axios;
