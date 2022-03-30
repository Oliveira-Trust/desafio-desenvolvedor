import Alpine from "alpinejs";

Alpine.data('dataPaymentTypes', (e) => {
    return {
        paymentTypes: [],
        searchPaymentTypes() {
            axios.get('/get-payment-types')
                .then((response) => {
                    this.paymentTypes = response.data
                })
        },
        savePaymentType(data, id) {
            axios.patch('/save-payment-type/' + id, data)
                .then((response) => {
                    this.$dispatch('notify', {title: 'Salvo com sucesso!', type: 'success'})
                    this.$dispatch('searchpaymenttypes')
                    this.$dispatch('paymenttypesaved', {id: id})
                }).catch(error => {
                    this.$dispatch('notify', {errors: error.response.data, type: 'danger'})
                })
        }
    }
})
