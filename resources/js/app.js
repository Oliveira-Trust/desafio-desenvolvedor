require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;


Alpine.data('dataCurrenciesPurchases', () => ({
    openModal: false,
    currenciesPurchases: [],
    searchCurrenciesPurchases: function () {
        axios.get('/get-currencies-purchases')
            .then((response) => {
                this.currenciesPurchases = response.data.data
            })
    }
}))

Alpine.data('buyCurrencyForm', () => {
    return {
        formData: {
            origin_currency: 'BRL',
            origin_currency_value: '',
            payment_type_id: '',
            destination_currency_id: ''
        },
        errors: [],
        submitData($dispatch) {
            this.errors = []
            axios.post('/buy-currency', this.formData)
                .then((response) => {
                    $dispatch('closemodal')
                    $dispatch('searchcurrenciespurchases')
                }).catch(error => {
                this.errors = error.response.data
            })
        },
        convertCurrency() {
            this.errors = []
            axios.post('/get-converted-currency', this.formData)
                .then((response) => {
                    this.formData = response.data
                }).catch(error => {
                this.errors = error.response.data
            })
        }
    }
})

Alpine.start();
