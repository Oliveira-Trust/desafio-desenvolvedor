import { useToast } from 'vue-toastification/composition';
import { POSITION } from 'vue-toastification';
import { getCurrentInstance } from "vue";

export const useToastService = () => {
    const toast = useToast();
    const instance = getCurrentInstance().proxy;

    const toastSuccess = (options) => {
        instance.$toast({
            props: {
                icon: options.icon ?? 'CheckCircleIcon',
                variant: 'success',
                title: options.title,
                html: options.message,
            },
        }, {
            timeout: 3000,
            position: POSITION.BOTTOM_RIGHT,
        })
    };

    const toastError = (options) => {
        instance.$toast({
            props: {
                icon: options.icon ?? 'AlertCircleIcon',
                variant: 'danger',
                title: options.title,
                html: options.message,
            },
        }, {
            timeout: 3000,
            position: POSITION.BOTTOM_RIGHT,
        })
    };

    return {
        toastSuccess,
        toastError,
        toast
    };
};
