import axios from 'axios';

export class Auth {
    private headers = {
        'Authorization': 'Bearer '.concat(this.getToken())
    };
    private apiRoot: string = 'http://localhost:8080/';

    private setSession(authResult) {
        let token = authResult.access_token;
        localStorage.setItem('token', token);
    }

    getToken(): any {
        return localStorage.getItem('token');
    }

    async login(email: string, password: string) {
        return await axios.post(this.apiRoot.concat('api/login'), {email, password})
            .then((response) => {
                this.setSession(response.data);
            })
            .catch (error => console.log(error));
    }

    async logout() {
        return await axios.get(this.apiRoot.concat('api/logout'), {
            headers: this.headers
        }).then((res) => {
            localStorage.removeItem('token');
        })
        .catch(error => console.log(error));
    }

    isLoggedIn(): boolean {
        return this.getToken() != null ? true : false;
    }
    isLoggedOut(): boolean {
        return !this.isLoggedIn();
    }
}