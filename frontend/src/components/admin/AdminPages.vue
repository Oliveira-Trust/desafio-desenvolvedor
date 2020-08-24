<template>
    <div class="admin-pages">
        <PageTitle icon="fa fa-cogs" main="Administração do Sistema"
            sub="Cadastros & Cia" />
        <div class="admin-pages-tabs">
            <b-card no-body>
                <b-tabs card>
                    <b-tab title="Produtos" active>
                        <Product />
                    </b-tab>
                    <b-tab title="Pedidos">
                        <Transaction />
                    </b-tab>
                    <b-tab title="Clientes">
                        <Client />
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>
    </div>
</template>

<script>
import PageTitle from '../template/PageTitle'
import Product from './Product'
import Transaction from './Transaction'
import Client from './Client'

export default {
    name: 'AdminPages',
    components: { PageTitle, Product, Transaction, Client }
}
</script>

<style>

</style>
