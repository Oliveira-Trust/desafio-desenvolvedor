import { defineStore } from "pinia";

export const useModal = defineStore("modal", {
    state: () => ({
        isOpen: false,
        message: "",
    }),
    actions: {
        open(value) {
            this.isOpen = true;
            this.message = value;
        },
        close() {
            this.isOpen = false;
        },
    },
});

export default useModal;
