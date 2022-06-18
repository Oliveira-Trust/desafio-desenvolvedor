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

if (store.state.user.id > 0) {
    $axios.defaults.headers.common.Authorization = `Bearer ${store.state.user.token}`;
}

export default $axios;
