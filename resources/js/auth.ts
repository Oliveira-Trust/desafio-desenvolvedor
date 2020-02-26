import axios from 'axios';

export class Auth {
    private apiRoot: string = 'http://localhost:8080/';

    private setSession(authResult) {
        let token = authResult.access_token;
        localStorage.setItem('token', token);
    }

    getToken(): any {
        return localStorage.getItem('token');
    }

    redirectHome() { 
        axios.get(this.apiRoot.concat('home'), {
            headers: {
                "Content-Type": 'application/json',
                Authorization: 'Bearer '.concat(localStorage.getItem('token'))
            }
        })
        .then((res) => location.href = res.request.responseURL);
    }

    login(email: string, password: string) {
        try {
            axios.post(this.apiRoot.concat('api/auth/login'), {email, password})
            .then((response) => {
                console.log(response);
                this.setSession(response.data);
                this.redirectHome();
            })
        } catch (error) {
            console.log(error);
        }
    }

    logout() {
        localStorage.removeItem('token');
    }
}