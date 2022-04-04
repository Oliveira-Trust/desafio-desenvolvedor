import Alpine from "alpinejs";


Alpine.data('dataConversionFee', (e) => {
    return {
        openModal: false,
        conversionFees: [],
        formData: {
            fee: '',
            comparison_operator: '',
            comparator_value: ''
        },
        searchConversionFee() {
            axios.get('/get-conversion-fees')
                .then((response) => {
                    this.conversionFees = response.data
                })
        },
        createConversionFee() {
            this.errors = []
            axios.post('/create-conversion-fee', this.formData)
                .then((response) => {
                    this.$dispatch('closemodal')
                    this.$dispatch('searchconversionfees')
                    this.$dispatch('notify', {message: 'Cadastrado com sucesso', type: 'success'})
                    this.formData = {
                        fee: '',
                        comparison_operator: '',
                        comparator_value: ''
                    }
                }).catch(error => {
                this.$dispatch('notify', {errors: error.response.data, type: 'danger'})
            })
        },
        updateConversionFee(data, id) {
            axios.patch('/update-conversion-fee/' + id, data)
                .then((response) => {
                    this.$dispatch('notify', {title: 'Salvo com sucesso!', type: 'success'})
                    this.$dispatch('searchconversionfees')
                    this.$dispatch('conversionfeesaved', {id: id})
                }).catch(error => {
                this.$dispatch('notify', {errors: error.response.data, type: 'danger'})
            })
        }
    }
})

