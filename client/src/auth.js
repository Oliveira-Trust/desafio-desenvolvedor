import axios from 'axios';

class Auth {
    constructor () {
        this.token = window.localStorage.getItem('token');
        let userData = window.localStorage.getItem('user');
        this.user = userData ? JSON.parse(userData) : null;
    }
    login (token, user) {
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('user', JSON.stringify(user));
        this.token = token;
        this.user = user;
    }
    check () {
        return !! this.token;
    }
    logout () {
        window.localStorage.removeItem('token');
        window.localStorage.removeItem('user');
        this.user = null;
        this.token = null;
    }
}
export default new Auth();