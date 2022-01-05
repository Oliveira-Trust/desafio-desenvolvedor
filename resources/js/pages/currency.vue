<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <Message v-if="error !== null" severity="error" >{{ message }}</Message>
                <Message v-if="success !== null" severity="success" >{{ message }}</Message>
            </div>
            <div class="col-md-8 mb-5">
                <h3>Quais moedas você deseja converter?</h3>
            </div>
            <div class="col-md-4">
                <a @click="openModal" style="font-size: 25px;cursor: pointer;color: #d40000;float: right;"><i class="fas fa-cogs"></i></a>
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
            <div class="col-md-3">
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

            <div class="col-md-3">
                <label for="destiny">Forma pagamento: </label>
                <div class="input-group ">
                    <div class="form-check">
                        <input class="form-check-input" value="boleto" type="radio" name="flexRadioDefault" id="flexRadioDefault1" v-model="form_payment" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            <i class="fas fa-ticket-alt"></i> Boleto
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="credito" type="radio" name="flexRadioDefault" id="flexRadioDefault2" v-model="form_payment">
                        <label class="form-check-label" for="flexRadioDefault2">
                            <i class="far fa-credit-card"></i> Cartão de Crédito
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
                    <li style="display:block"><b>Moeda de origem:</b> {{ data.currency_select_origin }} </li>
                    <li style="display:block"><b>Moeda de destino:</b> {{ data.currency_select_destiny }} </li>
                    <li style="display:block"><b>Valor para conversão:</b> $ {{ data.value_curreny }} </li>
                    <li style="display:block"><b>Forma de pagamento:</b>  {{data.form_payment.charAt(0).toUpperCase() + data.form_payment.substr(1)}} </li>
                    <li style="display:block"><b>Valor da "Moeda de destino" usado para conversão:</b> $ {{ data.bid }}</li>
                    <li style="display:block"><b>Valor comprado em "Moeda de destino":</b> $ {{ data.bidden }} (taxas aplicadas no valor de compra diminuindo no valor total de conversão)</li>
                    <li style="display:block"><b>Taxa de pagamento:</b> R$ {{ data.tax_payment.toFixed(2) }}</li>
                    <li style="display:block"><b>Taxa de conversão:</b> R$ {{ data.tax_currency.toFixed(2) }}</li>
                    <li style="display:block"><b>Valor utilizado para conversão descontando as taxas:</b> R$ {{ data.currency_without_tax }}</li>
                </ul>
            </div>
        </div>
        <DataTable :value="data_history" :paginator="true" class="p-datatable-customers" :rows="10"
                   dataKey="id" :rowHover="true" filterDisplay="menu"
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
            <Column field="valor_conversao" header="Valor Conversão">
                <template #body="{data}">
                    $ {{formatPrice(data.valor_conversao)}}
                </template>
            </Column>
            <Column field="valor_com_taxa" header="Valor com Taxa">
                <template #body="{data}">
                    $ {{formatPrice(data.valor_sem_taxa)}}
                </template>
            </Column>
            <Column field="valor_sem_taxa" header="Valor sem Taxa">
                <template #body="{data}">
                    $ {{formatPrice(data.valor_sem_taxa)}}
                </template>
            </Column>
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
        </DataTable>
    </div>
    <Dialog header="Configuração de taxas" v-model:visible="displayModal" :style="{width: '50vw'}" :modal="true">
        <div class="col-md-12 mb-3">
            <h5>Taxa de Conversão: </h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="tax_conversion">Taxa: </label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 5px 0px 0px 5px;border-right: none;">%</span>
                                <input type="number" id="tax_conversion" class="form-control"  v-model="tax_conversion.menor.valor">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="menor">Menor do que: </label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 5px 0px 0px 5px;border-right: none;">$</span>
                                <input type="number" id="menor" class="form-control" v-model="tax_conversion.menor.valor_condicao" @change="setEqual" @keyup="setEqual">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="tax_conversion2">Taxa: </label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 5px 0px 0px 5px;border-right: none;">%</span>
                                <input type="number" id="tax_conversion2" class="form-control"  v-model="tax_conversion.maior.valor">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="maior">Maior do que: </label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 5px 0px 0px 5px;border-right: none;">$</span>
                                <input type="number" id="maior" class="form-control" disabled v-model="tax_conversion.maior.valor_condicao">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h5>Taxa de Pagamanento: </h5>
            <div class="row">
                <div class="col-md-6">
                    <label for="tax_payment">Boleto: </label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius: 5px 0px 0px 5px;border-right: none;">%</span>
                        <input type="number" id="tax_payment" class="form-control"  v-model="tax_payment.boleto">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="tax_payment2">Crédito: </label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius: 5px 0px 0px 5px;border-right: none;">%</span>
                        <input type="number" id="tax_payment2" class="form-control"  v-model="tax_payment.credito">
                    </div>
                </div>
            </div>
        </div>
    </Dialog>
</template>

<script>
    export default {
        data() {
            return {
                displayModal: false,
                data_history: null,
                tax_payment: {
                    boleto: (0.0145 * 100).toFixed(2),
                    credito: (0.0763 * 100).toFixed(2)
                },
                tax_conversion: {
                    menor: {
                      valor: (0.02 * 100).toFixed(2),
                      valor_condicao: 3000
                    },
                    maior: {
                        valor:  (0.01 * 100).toFixed(2),
                        valor_condicao: 3000
                    }
                },
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
                success: null,
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
                },
                error_message: null
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
            }).catch( function (error) {
                this.error = true;
                this.message = error;
            });

            this.$axios.get('api/gethistory').then(response => {
                this.data_history = response.data.message;
            }).catch( function (error) {
                this.error = true;
                this.message = error;
            });
        },
        methods: {
            setVariableNull () {
                this.error = null;
                this.success = null;
                this.message = null;
            },
            setVariableToZero() {
                this.value_curreny = 0.00;
                this.value_curreny_destiny = 0.00;
            },
            setEqual () {
                this.tax_conversion.maior.valor_condicao = this.tax_conversion.menor.valor_condicao;
            },
            closeModal() {
                this.displayModal = false;
            },
            openModal () {
                this.displayModal = true;
            },
            getConversionDestiny () {
                this.setVariableNull();

                this.$axios.post('api/convert', {
                    from: this.currency_select_origin,
                    to: this.currency_select_destiny
                }).then(response => {
                    if (response.data.success) {
                        let dados = response.data.message[this.currency_select_origin + this.currency_select_destiny];
                        this.value_curreny_destiny = (parseFloat(dados.bid) * parseFloat(this.value_curreny.replaceAll(',',''))).toFixed(2) ;
                    } else {
                        this.error = true;
                        this.message = response.data.message;
                    }
                }).catch( function (error) {
                    this.error = true;
                    this.message = error;
                });
            },
            getValue() {
                this.setVariableNull();

                if (this.value_curreny.replaceAll(',','') > 1000 && this.value_curreny.replaceAll(',','') < 100000) {
                    this.$axios.post('api/convert', {
                        from: this.currency_select_origin,
                        to: this.currency_select_destiny
                    }).then(response => {
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
                            this.sendEmail();
                        } else {
                            this.error = true;
                            this.message = response.data.message;
                        }

                    }).catch( function (error) {
                        this.error = true;
                        this.message = error;
                    });
                } else {
                    this.result = null;
                    this.error = true;
                    this.message = "O valor de compra deve ser maior do que R$1.000 e menor do que R$ 100.000,00";
                }
            },
            setHistory () {
                this.$axios.post('api/sethistory', {
                    currency_origin: this.data.currency_select_origin,
                    currency_destiny: this.data.currency_select_destiny,
                    form_payment: this.data.form_payment,
                    tax_payment: this.data.tax_payment.toFixed(2) ,
                    tax_conversion: this.data.tax_currency.toFixed(2),
                    value_conversion: this.data.value_curreny,
                    value_with_tax: this.data.bidden,
                    value_without_tax: this.data.currency_without_tax
                }).then(response => {
                    if (response.data.success) {
                        this.getHistory()
                    } else {
                        this.error = true;
                        this.message = response.data.message;
                    }
                }).catch( function (error) {
                    this.error = true;
                    this.message = error;
                });
            },
            getHistory () {
                this.$axios.get('api/gethistory').then(response => {
                    this.data_history = response.data.message;
                });
            },
            getTaxPayment (form_payment, value_curreny) {
                if (form_payment === 'boleto') {
                    return (this.tax_payment.boleto/100) * value_curreny;
                }
                return (this.tax_payment.credito/100) * value_curreny;
            },
            getTaxCurrency (value_curreny) {
                if (value_curreny < this.tax_conversion.menor.valor_condicao) {
                    return (this.tax_conversion.menor.valor/100) * value_curreny;
                }
                return (this.tax_conversion.maior.valor/100) * value_curreny;
            },
            formatPrice (value) {
                let val = (value/1).toFixed(2).replace('.', ',');
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },
            async removeCoin () {
                this.setVariableToZero();

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
                }).catch( function (error) {
                    this.error = true;
                    this.message = error;
                });;
            },
            sendEmail () {
                this.setVariableNull();

                this.$axios.post('api/sendemail', {
                    currency_origin: this.data.currency_select_origin,
                    currency_destiny: this.data.currency_select_destiny,
                    form_payment: this.data.form_payment.charAt(0).toUpperCase() + this.data.form_payment.substr(1),
                    tax_payment: this.data.tax_payment.toFixed(2) ,
                    tax_conversion: this.data.tax_currency.toFixed(2),
                    value_conversion: this.data.bid,
                    value_curreny: this.value_curreny,
                    value_without_tax: this.data.currency_without_tax,
                    bidden: this.data.bidden
                }).then(response => {
                    if (response.data.success) {
                        this.success = true;
                        this.message = response.data.message;
                    } else {
                        this.error = true;
                        this.message = response.data.message;
                    }
                }).catch( function (error) {
                    this.error = true;
                    this.message = error;
                });
            }
        },
        beforeRouteEnter(to, from, next) {
            if (!window.Laravel.isLoggedin) {
                window.location.href = "/login";
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

