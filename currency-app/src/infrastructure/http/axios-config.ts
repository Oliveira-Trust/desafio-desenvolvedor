import axios, {AxiosError, type AxiosInstance} from 'axios';
import { configuration } from "@/infrastructure/configuration";
import UnprocessableEntityException from "@/infrastructure/http/exceptions/unprocessable-entity-exception";

const axiosInstance: AxiosInstance = axios.create({
  baseURL: configuration.apiUrl,
  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

async function getCsrfToken() {
    await axiosInstance.get('/sanctum/csrf-cookie');
}

export function hasAuthenticationCookie() {
    return !!document.cookie.split('; ').find(row => row.startsWith('XSRF-TOKEN='))?.split('=')[1]
}

axiosInstance.interceptors.request.use(
    async (config) => {
        const method = config.method?.toUpperCase();
        if (['POST', 'PUT', 'DELETE'].includes(method || '')) {
            await getCsrfToken();
            const xsrfToken = document.cookie.split('; ').find(row => row.startsWith('XSRF-TOKEN='))?.split('=')[1];

            if (xsrfToken) {
                config.headers['X-XSRF-TOKEN'] = decodeURIComponent(xsrfToken);
            }
        }

        return config;
    },
    (error) => {
      return Promise.reject(error);
    }
);

// Interceptor de resposta (opcional)
axiosInstance.interceptors.response.use(
    (response) => {
      return response;
    },
    (error: AxiosError<any>) => {
        if (error.response?.status === 422) {
            return Promise.reject(new UnprocessableEntityException(error.response.data.message, error.response.data.errors));
        }

        return Promise.reject(error);
    }
);

export default axiosInstance;