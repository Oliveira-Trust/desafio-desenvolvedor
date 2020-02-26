require('./bootstrap');
import { Auth } from "./auth";

const btnLogout = document.querySelector("#logout");

async function logout() {
    event.preventDefault();
    let auth = new Auth();
    
    return await auth.logout()
    .then(() => {
        if (auth.isLoggedOut()) {
            document.getElementById('logout-form').submit();
        }
    });
}
btnLogout.onclick = logout;