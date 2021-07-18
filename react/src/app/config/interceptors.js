import axios from 'axios'


export default function Interceptors() {

    axios.interceptors.response.use(response => {
        return response;
    }, error => {
        if (error.response.status === 401) {

        }
        return error;
    });

}