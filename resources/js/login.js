import { Auth } from "./auth";

const email = document.querySelector("#email");
const password = document.querySelector("#password");
const btnLogin = document.querySelector("#login");
const form = document.querySelector("form");

async function login() {
    event.preventDefault();
    let auth = new Auth();

    return await auth.login(email.value, password.value)
    .then(() => {
        if (auth.isLoggedIn()) {
            form.submit();
        }
    });
}
btnLogin.onclick = login;