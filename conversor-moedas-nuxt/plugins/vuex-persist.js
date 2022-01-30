import VuexPersistence from 'vuex-persist'

export default ({ store }) => {
    new VuexPersistence({
        key: 'conversor-moedas-nuxt',
        storage: window.localStorage,
    }).plugin(store);
}
