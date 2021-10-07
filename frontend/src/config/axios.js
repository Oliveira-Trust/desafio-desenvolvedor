import axios from 'axios'

const success = res => res
const error = err => {
    if (401 === err.response.status) {
        window.location = '/'
    } else {
        return Promise.reject(err)
    }
}
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
axios.defaults.headers.common['Access-Control-Allow-Methods'] = 'POST, GET, OPTIONS, PUT, DELETE';

axios.interceptors.response.use(success, error)