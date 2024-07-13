import { defineStore } from "pinia";
import http from "../clients/http.js";
import { useAuth } from "./auth.js";
import useModal from "./modal.js";

export const useCurrencyConverter = defineStore("currencyConverter", {
    state: () => ({
        auth: useAuth(),
        translations: {},
        combinations: {},
        payments: [],
        conversionResult: {},
        modal: useModal(),
    }),
    actions: {
        async findTranslations() {
            await http
                .get("/translations", {
                    headers: {
                        Authorization: "Bearer " + this.auth.token,
                    },
                })
                .then(({ data }) => {
                    this.translations = data;
                })
                .catch(({ response }) => {
                    this.modal.open(response?.data.message);
                });
        },
        async findCombinations() {
            await http
                .get("/combinations", {
                    headers: {
                        Authorization: "Bearer " + this.auth.token,
                    },
                })
                .then(({ data }) => {
                    this.combinations = data;
                })
                .catch(({ response }) => {
                    this.modal.open(response?.data.message);
                });
        },
        async findPayments() {
            await http
                .get("/payments", {
                    headers: {
                        Authorization: "Bearer " + this.auth.token,
                    },
                })
                .then(({ data }) => {
                    this.payments = data;
                })
                .catch(({ response }) => {
                    this.modal.open(response?.data.message);
                });
        },
        async conversion(payload) {
            await http
                .post("/conversion", payload, {
                    headers: {
                        Authorization: "Bearer " + this.auth.token,
                    },
                })
                .then(({ data }) => {
                    this.conversionResult = data;
                })
                .catch(({ response }) => {
                    this.modal.open(response?.data.message);
                });
        },
    },
});

export default useCurrencyConverter;
