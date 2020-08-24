<template>
    <div class="home">
        <PageTitle icon="fa fa-home" main="Dashboard"
            sub="Vaga Dev Pleno" />
        <div class="stats">
            <Stat title="produtos" :value="stat.categories"
                icon="fa fa-folder" color="#d54d50" />
            <Stat title="Pedidos" :value="stat.articles"
                icon="fa fa-file" color="#3bc480" />
            <Stat title="Clientes" :value="stat.users"
                icon="fa fa-user" color="#3282cd" />
        </div>
    </div>
</template>

<script>
import PageTitle from '../template/PageTitle'
import Stat from './Stat'


export default {
    name: 'Home',
    components: { PageTitle, Stat },
    data: function() {
        return {
            stat: {}
        }
    },
    
}
</script>

<style>
    .stats {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
</style>
