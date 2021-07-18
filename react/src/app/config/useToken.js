import axios from "axios";
import { useState } from "react";

export default function useToken() {

    const setInterceptor = () => {
        axios.interceptors.response.use(response => {
            return response;
         }, error => {
           if (error.response.status === 401) {
            removeToken()
           }
           return Promise.reject(error);
         });
    }

    const getToken = () => {
        const tokenString = localStorage.getItem('token');
        const userToken = JSON.parse(tokenString);
        if(userToken) {
            axios.defaults.headers.common.Authorization = 'Bearer ' + userToken.token;
        }
        return userToken?.token
    };

    const [token, setToken] = useState(getToken());

    const removeToken = () => {
        localStorage.removeItem('token');
        setToken(null);
    };

    const saveToken = userToken => {
        localStorage.setItem('token', JSON.stringify(userToken));
        setToken(userToken.token);
    };

    return {
        setInterceptor,
        setToken: saveToken,
        removeToken,
        token
    }
}