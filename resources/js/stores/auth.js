import { defineStore } from "pinia";
import http from "../clients/http.js";
import router from "../router/index.js";
import useModal from "./modal.js";

export const useAuth = defineStore("auth", {
    state: () => ({
        token: localStorage.getItem("token"),
        email: localStorage.getItem("email"),
        hasError: false,
        modal: useModal(),
    }),
    getters: {
        hasUser() {
            return this.token && this.email;
        },
    },
    actions: {
        setToken(tokenValue) {
            localStorage.setItem("token", tokenValue);
            this.token = tokenValue;
        },
        setEmail(emailValue) {
            localStorage.setItem("email", emailValue);
            this.email = emailValue;
        },
        async signIn(user) {
            await http
                .post("/login", user)
                .then(({ data }) => {
                    this.setToken(data.token);
                    this.setEmail(data.email);
                    router.push({ name: "show" });
                })
                .catch(({ response }) => {
                    this.clear();
                    this.modal.open(response?.data.message);
                    this.hasError = true;
                });
        },
        async checkToken() {
            await http
                .get("/login/verify", {
                    headers: {
                        Authorization: "Bearer " + this.token,
                    },
                })
                .catch(({ response }) => {
                    this.clear();
                    this.modal.open(response?.data.message);
                    this.hasError = true;
                });
        },
        clear() {
            localStorage.removeItem("token");
            localStorage.removeItem("email");

            this.token = "";
            this.email = "";
        },
    },
});

export default useAuth;
