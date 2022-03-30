import Alpine from "alpinejs";

Alpine.data('dataCurrenciesPurchases', () => ({
    openModal: false,
    currenciesPurchases: [],
    searchCurrenciesPurchases: function () {
        axios.get('/get-currencies-purchases')
            .then((response) => {
                this.currenciesPurchases = response.data.data
            })
    }
}));

Alpine.data('buyCurrencyForm', () => {
    return {
        formData: {
            origin_currency: 'BRL',
            origin_currency_value: '',
            payment_type_id: '',
            destination_currency_id: ''
        },
        submitData() {
            this.errors = []
            axios.post('/buy-currency', this.formData)
                .then((response) => {
                    this.$dispatch('closemodal')
                    this.$dispatch('searchcurrenciespurchases')
                    this.$dispatch('notify', {message: 'Comprado com sucesso', type: 'success'})
                }).catch(error => {
                this.$dispatch('notify', {errors: error.response.data, type: 'danger'})
                })
        },
        convertCurrency() {
            this.errors = []
            axios.post('/get-converted-currency', this.formData)
                .then((response) => {
                    this.formData = response.data
                }).catch(error => {
                    this.$dispatch('notify', {errors: error.response.data, type: 'danger'})
                })
        }
    }
});