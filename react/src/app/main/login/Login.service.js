import axios from "axios";

export async function loginUser(credentials) {
    return axios.post(`http://localhost:8001/api/login`, credentials)
        .then(res => {

            return res.data
        })
}

export async function me() {
    return axios.get(`http://localhost:8001/api/me`)
        .then(res => {
            localStorage.setItem('me', JSON.stringify(res.data));
        })
}
