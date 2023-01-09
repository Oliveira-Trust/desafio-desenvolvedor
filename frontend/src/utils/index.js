import { useAuthStore } from '@/stores/auth.js'

export const isUserLoggedIn = () => {
    return !!useAuthStore().accessToken
}

export const getApiErrorMessageFromResponse = (error) => {

    if(error.response?.data?.message){
        return error.response?.data?.message;
    }

    console.log(error);
    if(error.response?.data.error_code === 422 && error.response?.data?.error){
        return Object.entries(error.response.data.error)[0][1][0];
    }


    return 'Ocorreu um problema, tente novamente mais tarde.';
}
