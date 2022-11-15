import axios from "axios";

export const api = axios.create({
    baseURL: "http://localhost/api/"
});

api.interceptors.request.use(
    (config) => {
      const token = localStorage.getItem("token")
  
      if (token) {
        config.headers.Authorization = `Bearer ${token}`
      }
      
      return config
    },
    (e) => {
      console.log(e)
    }
);

export const getApiCurrencies = async () => {
    const { data } = await api.get('currencies')
    return data;
}

export const getApiExchange = async (params) => {
    const { data } = await api.get('exchange', { params } )
    return data
}

export const getUserExchanges = async (params) => {
    const { data } = await api.get('exchanges', { params } )
    return data
}

export const registerUser = async (body) => {
    const { data } = await api.post('user/register', { ...body } )
    return data
}

export const loginUser = async (body) => {
    const { data } = await api.post('user/authenticate', { ...body } )
    return data
}

export const logoutUser = async () => {
    const { data } = await api.post('user/logout')
    return data
}