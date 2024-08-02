import type { Toast } from '@/domain/entities/toast.interface';
import { defineStore } from 'pinia';
import { ref } from 'vue';
import { EToastType } from '../enums/toast-type.enum';

export const useToastStore = defineStore('toast', () => {
    const toasts = ref<Toast[]>([]);

    function addToast(type: EToastType, message: string, duration: number) {
        const toast: Toast = {
            type,
            message,
            timeout: duration,
            visible: true,
            id: Math.random().toString(36).substring(7),
        };

        toasts.value.push(toast);
    }

    function success(message: string, duration: number = 2500) {
        addToast(EToastType.SUCCESS, message, duration);
    }

    function info(message: string, duration: number = 2500) {
        addToast(EToastType.INFO, message, duration);
    }

    function error(message: string, duration: number = 2500) {
        addToast(EToastType.ERROR, message, duration);
    }

    function warning(message: string, duration: number = 2500) {
        addToast(EToastType.WARNING, message, duration);
    }

    function removeToast(id: string) {
        toasts.value = toasts.value.filter((toast) => toast.id !== id);
    }

    return {
        toasts,
        success,
        error,
        info,
        warning,
        removeToast,
    };
});
