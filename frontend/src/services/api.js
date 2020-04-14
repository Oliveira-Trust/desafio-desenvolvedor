import axios from "axios";
import { getToken } from "./auth";

const url = process.env.REACT_APP_API_URL;
const port = process.env.REACT_APP_API_PORT;
const basePath = process.env.REACT_APP_API_BASEPATH;

axios.interceptors.response.use((response) => {
  return response;
},(error) => {
  if (error.response.status === 401) {    
    window.location.href = "/login";
  }
  return Promise.reject(error);
});

const api = axios.create({
  baseURL: url + ":" + port + basePath
});
api.interceptors.request.use(async config => {
  const token = getToken();
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default api;