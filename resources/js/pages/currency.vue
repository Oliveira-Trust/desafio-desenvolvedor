<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ message }}
                </div>
            </div>
            <div class="col-md-12 mb-5">
                <h3>Quais moedas você deseja converter?</h3>
            </div>
            <div class="col-md-4">
                <label for="origin">Origem: </label>
                <div class="input-group ">
                    <select id="origin" class="form-control"  v-model="currency_select_origin"  @change="removeCoin">
                        <option v-for="option in options_curreny_origin" :value="option.value">
                            {{ option.text }}
                        </option>
                    </select>
                    <input type="text" id="origin_input" class="form-control" @keyup="getConversionDestiny" v-money3="config" v-model.lazy="value_curreny">
                </div>
            </div>
            <div class="col-md-4">
                <label for="destiny">Destino: </label>
                <div class="input-group ">
                    <select id="destiny" class="form-control" v-model="currency_select_destiny" @change="removeCoin">
                        <option v-for="option in options_curreny_destiny" :value="option.value">
                            {{ option.text }}
                        </option>
                    </select>
                    <input type="number" id="destiny_input" class="form-control" disabled v-model="value_curreny_destiny">
                </div>
            </div>

            <div class="col-md-2">
                <label for="destiny">Forma pagamento: </label>
                <div class="input-group ">
                    <div class="form-check">
                        <input class="form-check-input" value="boleto" type="radio" name="flexRadioDefault" id="flexRadioDefault1" v-model="form_payment" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Boleto
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="credito" type="radio" name="flexRadioDefault" id="flexRadioDefault2" v-model="form_payment">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Cartão de Crédito
                        </label>
                    </div>

                </div>
            </div>
            <div class="col-md-2 mb-5">
                <label for="button">&nbsp</label>
                <button id="button" type="submit" class="btn btn-primary form-control" @click="getValue">Converter</button>
            </div>
            <div v-if="result !== null" class="col-md-12 text-left mb-5">
                Resultado:
                <ul>
                    <li><b>Moeda de origem:</b> {{ data.currency_select_origin }} </li>
                    <li><b>Moeda de destino:</b> {{ data.currency_select_destiny }} </li>
                    <li><b>Valor para conversão:</b> $ {{ data.value_curreny }} </li>
                    <li><b>Forma de pagamento:</b>  {{data.form_payment.charAt(0).toUpperCase() + data.form_payment.substr(1)}} </li>
                    <li><b>Valor da "Moeda de destino" usado para conversão:</b> $ {{ data.bid }}</li>
                    <li><b>Valor comprado em "Moeda de destino":</b> $ {{ data.bidden }} (taxas aplicadas no valor de compra diminuindo no valor total de conversão)</li>
                    <li><b>Taxa de pagamento:</b> R$ {{ data.tax_payment.toFixed(2) }}</li>
                    <li><b>Taxa de conversão:</b> R$ {{ data.tax_currency.toFixed(2) }}</li>
                    <li><b>Valor utilizado para conversão descontando as taxas:</b> R$ {{ data.currency_without_tax }}</li>
                </ul>
            </div>
        </div>
        <!--<div class="col-md-12">-->
            <DataTable :value="data_history" :paginator="true" class="p-datatable-customers" :rows="10"
                       dataKey="id" :rowHover="true" v-model:filters="filters" filterDisplay="menu" :loading="loading"
                       paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" :rowsPerPageOptions="[10,25,50]"
                       currentPageReportTemplate="Showing {first} to {last} of {totalRecords} entries"
                       responsiveLayout="scroll"
            >
                <Column field="forma_pagamento" header="Forma de Pagamento">
                    <template #body="{data}">
                         {{data.forma_pagamento.charAt(0).toUpperCase() + data.forma_pagamento.substr(1)}}
                    </template>
                </Column>
                <Column field="moeda_origin" header="Moeda Origem"></Column>
                <Column field="moeda_destino" header="Moeda Destino"></Column>
                <Column field="taxa_pagamento" dataType="numeric" header="Taxa Pagamento">
                    <template #body="{data}">
                        $ {{formatPrice(data.taxa_pagamento)}}
                    </template>
                </Column>
                <Column field="taxa_conversao" header="Taxa Conversão">
                    <template #body="{data}">
                       $ {{formatPrice(data.taxa_conversao)}}
                    </template>
                </Column>
                <Column field="valor_conversao" header="Valor Conversão">
                    <template #body="{data}">
                        $ {{formatPrice(data.valor_conversao)}}
                    </template>
                </Column>
                <Column field="valor_sem_taxa" header="Valor sem Taxa">
                    <template #body="{data}">
                        $ {{formatPrice(data.valor_sem_taxa)}}
                    </template>
                </Column>
            </DataTable>
        <!--</div>-->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data_history: null,
                // filters: {
                    // 'forma_pagamento': {value: null, matchMode: FilterMatchMode.CONTAINS},
                    // 'name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.STARTS_WITH}]},
                    // 'country.name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.STARTS_WITH}]},
                    // 'representative': {value: null, matchMode: FilterMatchMode.IN},
                    // 'date': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.DATE_IS}]},
                    // 'balance': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.EQUALS}]},
                    // 'status': {operator: FilterOperator.OR, constraints: [{value: null, matchMode: FilterMatchMode.EQUALS}]},
                    // 'activity': {value: null, matchMode: FilterMatchMode.BETWEEN},
                    // 'verified': {value: null, matchMode: FilterMatchMode.EQUALS}
                // },
                data: {
                    bid: null,
                    bidden: 0,
                    currency_without_tax: null,
                    total_tax: null,
                    tax_payment: null,
                    tax_currency: null,
                    form_payment: null,
                    value_curreny: null,
                    currency_select_origin: null,
                    currency_select_destiny: null
                },
                form_payment: 'boleto',
                value_curreny: 0.00,
                value_curreny_destiny: 0.00,
                currency_select_origin: null,
                currency_select_destiny: null,
                options_curreny_origin: [],
                options_curreny_destiny: [],
                result: null,
                message: null,
                error: null,
                config: {
                    prefix: '',
                    suffix: '',
                    thousands: ',',
                    decimal: '.',
                    precision: 2,
                    disableNegative: false,
                    disabled: false,
                    min: null,
                    max: null,
                    allowBlank: false,
                    minimumNumberOfCharacters: 0,
                }
            }
        },
        beforeMount() {
            this.$axios.get('api/getcoins').then(response => {
                let coins = [];
                let coins2 = [];

                Object.entries(response.data.success).forEach(function(item, key) {
                    coins.push({text: item[0], value: item[0]});
                    coins2.push({text: item[0], value: item[0]});
                });

                this.options_curreny_origin = coins;
                this.options_curreny_destiny = coins2;
                this.currency_select_origin = 'BRL';
                this.currency_select_destiny = 'USD';
            });

            this.$axios.get('api/gethistory').then(response => {
                console.log('getHistory', response.data.message);
                this.data_history = response.data.message;
            });
        },
        methods: {
            getConversionDestiny () {
                this.error = null;
                this.message = null;
                this.$axios.post('api/convert', {
                    from: this.currency_select_origin,
                    to: this.currency_select_destiny
                }).then(response => {

                    this.error = null;
                    this.message = null;

                    if (response.data.success) {
                        let dados = response.data.message[this.currency_select_origin + this.currency_select_destiny];
                        this.value_curreny_destiny = (parseFloat(dados.bid) * parseFloat(this.value_curreny.replaceAll(',',''))).toFixed(2) ;
                    } else {
                        this.error = true;
                        this.message = response.data.message;
                    }

                });
            },
            getValue() {
                this.error = null;
                this.message = null;

                if (this.value_curreny.replaceAll(',','') >= 1000 && this.value_curreny.replaceAll(',','') <= 100000) {
                    this.$axios.post('api/convert', {
                        from: this.currency_select_origin,
                        to: this.currency_select_destiny
                    }).then(response => {

                        this.error = null;
                        this.message = null;

                        if (response.data.success) {
                            this.result = response.data.message[this.currency_select_origin + this.currency_select_destiny];
                            this.data.bid = parseFloat(this.result.bid).toFixed(2);
                            this.data.tax_payment = this.getTaxPayment(this.form_payment, this.value_curreny.replaceAll(',',''));
                            this.data.tax_currency = this.getTaxCurrency(this.value_curreny.replaceAll(',',''));
                            this.data.total_tax = (parseFloat(this.data.tax_payment) + parseFloat(this.data.tax_currency));
                            this.data.bidden = (parseFloat(this.result.bid) * this.value_curreny.replaceAll(',','') + this.data.total_tax).toFixed(2);
                            this.data.currency_without_tax = (parseFloat(this.result.bid) * this.value_curreny.replaceAll(',','')).toFixed(2);
                            this.data.form_payment = this.form_payment;
                            this.data.value_curreny = this.value_curreny.replaceAll(',','');
                            this.data.currency_select_origin = this.currency_select_origin;
                            this.data.currency_select_destiny = this.currency_select_destiny;

                            this.setHistory();

                        } else {
                            this.error = true;
                            this.message = response.data.message;
                        }

                    });
                } else {
                    this.result = null;
                    this.error = true;
                    this.message = "O valor de compra maior que R$ 1.000 e menor que R$ 100.000,00";
                }
            },
            setHistory () {
                this.$axios.post('api/sethistory', {
                    moeda_origin: this.data.currency_select_origin,
                    moeda_destino: this.data.currency_select_destiny,
                    forma_pagamento: this.data.form_payment,
                    taxa_pagamento: this.data.tax_payment.toFixed(2) ,
                    taxa_conversao: this.data.tax_currency.toFixed(2),
                    valor_conversao: this.data.bid,
                    valor_sem_taxa: this.data.currency_without_tax
                }).then(response => {
                    this.getHistory()
                });
            },
            getHistory () {
                this.$axios.get('api/gethistory').then(response => {
                    console.log('getHistory', response);
                    this.data_history = response.data.message;
                });
            },
            getTaxPayment (form_payment, value_curreny) {
                if (form_payment === 'boleto') {
                    return 0.0145 * value_curreny;
                }
                return 0.0763 * value_curreny;
            },
            getTaxCurrency (value_curreny) {
                if (value_curreny < 3000) {
                    return 0.02 * value_curreny;
                }
                return 0.01 * value_curreny;
            },
            formatPrice (value) {
                let val = (value/1).toFixed(2).replace('.', ',');
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },
            async removeCoin () {
               await this.getCoins();

                let currency_origin = this.currency_select_origin;
                let currency_destiny = this.currency_select_destiny;
                let index;
                let _vm = this;

                this.options_curreny_destiny.forEach(function(item, key) {
                    if (item.text === currency_origin) {
                        index = key;
                        _vm.options_curreny_destiny.splice(index, 1);
                    }
                });

                this.options_curreny_origin.forEach(function(item, key) {
                    if (item.text === currency_destiny) {
                        index = key;
                        _vm.options_curreny_origin.splice(index, 1);
                    }
                });

            },
            async getCoins () {
                await this.$axios.get('api/getcoins').then(response => {
                    let coins = [];
                    let coins2 = [];

                    Object.entries(response.data.success).forEach(function(item, key) {
                        coins.push({text: item[0], value: item[0]});
                        coins2.push({text: item[0], value: item[0]});
                    });

                    this.options_curreny_origin = coins;
                    this.options_curreny_destiny = coins2;
                    // this.currency_select_origin = 'BRL';
                    // this.currency_select_destiny = 'USD';
                });
            }
        },
        beforeRouteEnter(to, from, next) {
            if (!window.Laravel.isLoggedin) {
                window.location.href = "/";
            }
            next();
        }
    }
</script>
<style lang="scss" scoped>

    .btn-primary {
        color: #fff;
        background-color: #d40000;
        border-color: #d40000;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #d40000;
        border-color: #d40000;
    }

    .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
        color: #fff;
        background-color: #d40000;
        border-color: #d40000;
    }

    ::v-deep(.p-paginator) {
        .p-paginator-current {
            margin-left: auto;
        }
    }

    ::v-deep(.p-progressbar) {
        height: .5rem;
        background-color: #D8DADC;

        .p-progressbar-value {
            background-color: #607D8B;
        }
    }

    ::v-deep(.p-datepicker) {
        min-width: 25rem;

        td {
            font-weight: 400;
        }
    }

    ::v-deep(.p-datatable.p-datatable-customers) {
        .p-datatable-header {
            padding: 1rem;
            text-align: left;
            font-size: 1.5rem;
        }

        .p-paginator {
            padding: 1rem;
        }

        .p-datatable-thead > tr > th {
            text-align: left;
        }

        .p-datatable-tbody > tr > td {
            cursor: auto;
        }

        .p-dropdown-label:not(.p-placeholder) {
            text-transform: uppercase;
        }
    }
</style>

