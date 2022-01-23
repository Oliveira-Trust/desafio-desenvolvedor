import axios from 'axios';


if(localStorage.getItem("auth") != undefined){
    var access_token = "bearer " + JSON.parse(atob(localStorage.getItem("auth"))).token
}else{
    var access_token = "bearer ";
}

export async function VerifyAuth() {
    const response = await Verifytoken.get();
    var dados = response.data;
    if(dados.status != "1"){
        alert("Token de acesso expirado ou inválido.");
        window.location.href = "/";
    }
}

export const Verifytoken = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/auth/verify',
    headers: {
        "Content-type": "application/json",
        "Authorization": access_token
    }
});

export const accessSystem = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/auth/login',
    headers: {
        "Content-type": "application/json"
    }
});

export const ListCoin = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/coin/list-coins',
    headers: {
        "Content-type": "application/json",
        "Authorization": access_token
    }
});

export const ListFormPayment = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/payment/list-form-payment',
    headers: {
        "Content-type": "application/json",
        "Authorization": access_token
    }
});

export const ConvertCurrency = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/operation/convert-currency',
    headers: {
        "Content-type": "application/json",
        "Authorization": access_token
    }
});

export const listOperatonHistoric = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/operation/list-operations/',
    headers: {
        "Content-type": "application/json",
        "Authorization": access_token
    }
});