<template>
    <div>
        <header>
            <nav class="fixed w-full bg-white">
                <div class="container m-auto px-6 md:px-12 lg:px-6">
                    <div class="flex flex-wrap items-center justify-between py-6 gap-6 md:py-4 md:gap-0">
                        <div class="w-full flex justify-between lg:w-auto">
                            <a href="#" aria-label="logo">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </a>

                            <button aria-label="humburger" id="hamburger" class="relative w-10 h-10 -mr-2 lg:hidden">
                                <div aria-hidden="true" id="line" class="inset-0 w-6 h-0.5 m-auto rounded bg-gray-500 transtion duration-300"></div>
                                <div aria-hidden="true" id="line2" class="inset-0 w-6 h-0.5 mt-2 m-auto rounded bg-gray-500 transtion duration-300"></div>
                            </button>
                        </div>

                        <div hidden class="w-full bg-white md:space-y-0 md:p-0 md:flex-nowrap md:bg-transparent lg:w-auto lg:flex">
                            <div class="block w-full lg:items-center lg:flex">
                                <ul class="space-y-6 pb-6 tracking-wide font-medium text-gray-600 lg:pb-0 lg:pr-6 lg:items-center lg:flex lg:space-y-0">
                                    <li>
                                        <a href="#" class="block md:px-3">
                                            <span>Cotação online</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="block md:px-3">
                                            <span>Moedas disponíveis</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="block md:px-3">
                                            <span>Saiba mais</span>
                                        </a>
                                    </li>
                                </ul>

                                <ul class="border-t space-y-2 pt-2 lg:space-y-0 lg:space-x-2 lg:pt-0 lg:pl-2 lg:border-t-0 lg:border-l lg:items-center lg:flex">
                                    <li v-if="!isLoggedIn">
                                        <button @click.prevent="openLoginModal(false)" type="button" class="w-full py-3 px-6 rounded-md text-center transition active:bg-sky-200 focus:bg-sky-100 sm:w-max block text-cyan-600 font-semibold">
                                            Criar uma conta grátis
                                        </button>
                                    </li>

                                    <li v-if="!isLoggedIn">
                                        <button @click.prevent="openLoginModal(true)" type="button" class="w-full py-3 px-6 rounded-md text-center transition bg-cyan-500 hover:bg-cyan-600 active:bg-cyan-700 focus:bg-sky-600 sm:w-max font-semibold text-white">
                                            Fazer login
                                        </button>
                                    </li>

                                    <li v-if="isLoggedIn && isAdmin">
                                        <button v-if="!isAdminMode" @click.prevent="changeAdminMode(true)" type="button" class="w-full py-3 px-6 rounded-md text-center transition bg-red-500 hover:bg-red-600 active:bg-red-700 focus:bg-red-600 sm:w-max font-semibold text-white">
                                            Ir para o painel Administrativo
                                        </button>

                                        <button v-else @click.prevent="changeAdminMode(false)" type="button" class="w-full py-3 px-6 rounded-md text-center transition bg-cyan-500 hover:bg-cyan-600 active:bg-cyan-700 focus:bg-sky-600 sm:w-max font-semibold text-white">
                                            Ir para o painel de cotações
                                        </button>
                                    </li>

                                    <li v-if="isLoggedIn" class="ml-4">{{ name }}</li>

                                    <li v-if="isLoggedIn">
                                        <button @click.prevent="logout" type="button" class="w-full py-3 px-6 rounded-md text-center transition active:bg-sky-200 focus:bg-sky-100 sm:w-max block text-cyan-600 font-semibold">
                                            Sair
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="pt-32 pb-20 md:pt-40">
            <div v-if="!isAdminMode" class="container m-auto px-6 md:px-12 lg:px-6">
                <div class="lg:flex lg:items-center lg:gap-x-16">
                    <div class="space-y-8 lg:w-7/12">
                        <h1 class=" font-bold text-gray-900 text-4xl md:text-5xl">Fazer uma cotação online ficou ainda mais fácil com nossa ferramenta.</h1>
                        <p class="text-gray-600 lg:w-11/12">
                            Faça uma cotação em BRL com as principais moedas do mundo. <br>Veja como é fácil.
                        </p>

                        <span class="block font-semibold">Siga os passos abaixo</span>

                        <div class="grid grid-cols-3 space-x-4 md:space-x-6 md:flex">
                            <a aria-label="add to slack" href="#" class="p-4 border border-gray-200 rounded-md hover:border-cyan-400 hover:shadow-lg">
                                <div class="flex justify-center space-x-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>

                                    <span class="hidden font-medium md:block">Escolha o valor em real (BRL)</span>
                                </div>
                            </a>
                            <a aria-label="add to chat" href="#" class="p-4 border border-gray-200 rounded-md hover:border-green-400 hover:shadow-lg">
                                <div class="flex justify-center space-x-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>

                                    <span class="hidden font-medium md:block">Escolha a moeda de destino</span>
                                </div>
                            </a>
                            <a aria-label="add to zoom" href="#" class="p-4 border border-gray-200 rounded-md hover:border-blue-400 hover:shadow-lg">
                                <div class="flex justify-center space-x-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>

                                    <span class="hidden font-medium md:block">Pronto, simples assim!</span>
                                </div>
                            </a>
                        </div>

                        <div class="flex">
                            🔥🌟
                            <span>Você poderá também receber a cotação por </span>
                            <span class="font-semibold text-gray-700 flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>

                                EMAIL
                            </span>
                        </div>
                    </div>

                    <div class="lg:block lg:w-5/12">
                        <Quotation @created="carregarCotacoes"/>
                    </div>
                </div>

                <div class="w-full" v-if="isLoggedIn">
                    <minhas-cotacoes ref="cotacoes"/>
                </div>
            </div>

            <div v-else class="container m-auto px-6 md:px-12 lg:px-6">
                <div class="flex flex-col">
                    <div class="w-4/12">
                        <h1>Cotações</h1>

                        <table>
                            <thead>
                            <tr>
                                <th>Moeda</th>
                                <th>Preço Atual</th>
                                <th>Data de alteração</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(moeda) in moedas">
                                <td>{{ moeda.code }}</td>
                                <td>R${{ moeda.last_price }}</td>
                                <td>{{ moeda.created_at }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <button class="button-link my-5 p-2" @click="sincronizarMoedas">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>

                            {{ isLoadingRefresh ? 'Atualizando...' : 'Sincronizar utilizando a API' }}
                        </button>
                        <p><small>O sistema de cotação está configurado para atualizar os preços automaticamente a cada 1 hora. Essa opção pode ser fácilmente alterada.</small></p>
                    </div>

                    <div class="w-full mt-20">
                        <h1>Taxas</h1>

                        <table>
                            <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Valor min.</th>
                                <th>Valor max.</th>
                                <th>Taxa (%)</th>
                                <th>Taxa Fixa (R$)</th>
                                <th>Atualizado em</th>
                                <th colspan="2">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="taxa in taxas">
                                <td>
                                    {{ taxa.fee_type_description }}
                                    <div v-if="taxa.fee_type_id === 1">
                                        {{ taxa.payment_type_description }}
                                    </div>
                                </td>
                                <td>{{ formatValue(taxa.min_amount) }}</td>
                                <td>{{ formatValue(taxa.max_amount) }}</td>
                                <td>{{ formatValue(taxa.percent) }}%</td>
                                <td>{{ formatValue(taxa.fixed_value) }}</td>
                                <td>{{ taxa.updated_at }}</td>
                                <td>
                                    <button @click.prevent="editarTaxa(taxa)" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                </td>
                                <td>
                                    <button @click.prevent="excluirTaxa(taxa)" title="Excluir">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <button class="button-link my-5 p-2" @click="adicionarTaxa">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>

                            Adicionar taxa
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <login-modal ref="loginModal"></login-modal>
        <taxa-modal ref="taxaModal"></taxa-modal>
    </div>
</template>
<script>
import Quotation from "./Quotation";
import LoginModal from '../components/LoginModal';
import TaxaModal from '../components/TaxaModal';
import MinhasCotacoes from "../components/MinhasCotacoes";
import {formatValue} from "../utils/formatValue";

export default {
    components: {MinhasCotacoes, LoginModal, Quotation, TaxaModal},

    computed: {
        isAdmin() {
            return this.$store.state.user.is_admin;
        },

        isLoggedIn() {
            return this.$store.state.user.id > 0;
        },

        name() {
            return this.$store.state.user.name;
        }
    },

    data() {
        return {
            isAdminMode: false,
            isLoadingRefresh: false,
            moedas: [],
            taxas: []
        }
    },

    methods: {
        openLoginModal(isLogin) {
            if (this.$store.state.user.id > 0) {
                return;
            }

            this.$refs.loginModal.fazerLogin(isLogin, true);
        },

        logout() {
            this.isAdminMode = false;

            this.$refs.loginModal.logout();
        },

        carregarCotacoes() {
            this.$refs.cotacoes.load();
        },

        changeAdminMode(value) {
            this.isAdminMode = value;

            this.buscarMoedas();
            this.buscarTaxas();
        },

        buscarMoedas() {
            this.isLoadingRefresh = true;

            this.axios.get('/api/admin/currencies').then((response) => {
                this.isLoadingRefresh = false;

                this.moedas = response.data.data;
            }).catch(() => {
                this.isLoadingRefresh = false;
            });
        },

        sincronizarMoedas() {
            this.isLoadingRefresh = true;

            this.axios.get('/api/admin/currencies/refresh').then((response) => {
                this.buscarMoedas();
            }).catch(() => {
                this.isLoadingRefresh = false;
            });
        },

        buscarTaxas() {
            this.axios.get('/api/admin/fees').then((response) => {
                this.taxas = response.data.data;
            });
        },

        adicionarTaxa() {
            this.$refs.taxaModal.abrirModal(null, () => {
                this.buscarTaxas();
            })
        },

        editarTaxa(fee) {
            this.$refs.taxaModal.abrirModal(fee, () => {
                this.buscarTaxas();
            })
        },

        excluirTaxa(fee) {
            if (window.confirm("Você tem certeza que quer excluir essa taxa?")) {
                this.axios.delete('/api/admin/fees/' + fee.id).then((response) => {
                    this.buscarTaxas();
                });
            }
        },

        formatValue
    }
}
</script>
