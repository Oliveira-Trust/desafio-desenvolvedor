export default function config(url) {
    let tokenW = localStorage.getItem('token_gio');
    return axios.create({
        baseURL: url,
        timeout: 1000,
        headers: { 'Accept': 'application/json', 'Authorization': 'bearer' + tokenW }
    });
}

export function request(nAxios, url) {
    return nAxios.get(url).then((response) => {
        return response.data;
    });
}
