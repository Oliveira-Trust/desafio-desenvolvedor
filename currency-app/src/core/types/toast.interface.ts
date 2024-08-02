import type { EToastType } from '@/core/enums/toast-type.enum';

export interface Toast {
    id: string;
    type: EToastType;
    message: string;
    timeout?: number;
    visible?: boolean;
}
