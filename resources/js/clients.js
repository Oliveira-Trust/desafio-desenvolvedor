import { Auth } from "./auth";
const axios = require('axios');
window.$ = window.jQuery = require('jquery');


async function getClients() {
    let auth = new Auth();
    
    if (auth.isLoggedIn()) {
        return await axios.get(auth.apiRoot.concat('api/client'), {
            headers: auth.headers
        }).then((res) => {
            console.log(res);
            localStorage.setItem('clients', JSON.stringify(res.data.data));
        })
        .catch(error => console.log(error));
    }
}

getClients();