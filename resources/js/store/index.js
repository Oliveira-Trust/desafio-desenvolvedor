import {createStore} from "vuex";

export const store = createStore({
    state: {
        showMenu: false,
        user: {}
    },
    mutations: {
        toggleMenu(state) {
            state.showMenu = !state.showMenu;
        },

        setUser(state, payload) {
            state.user = payload

            const user = JSON.stringify(payload);

            localStorage.setItem('user', user);
        },

        removeUser(state) {
            localStorage.removeItem('user');

            state.user = {};
        }
    },
    actions: {},
    getters: {},
    modules: {}
})
