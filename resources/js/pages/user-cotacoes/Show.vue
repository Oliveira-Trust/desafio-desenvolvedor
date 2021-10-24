<template>
    <div>
        <div class="alert alert-success">
            <pre>{{ userCotacaoTaxas }}</pre>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                id: null,
                userCotacaoTaxas: []
            }
        },
        created() {
            this.id = this.$route.params.id ?? null;
            this.getUserCotacaoTaxas(this.id);
        },
        methods: {
            getUserCotacaoTaxas(id){
                axios.get(`api/v1/user-cotacoes/${id}`)
                    .then((response) => {
                        const data = response.data;
                        if(data.success == true){
                            this.userCotacaoTaxas = data.data;
                        }
                    })
                    .finally(() => {

                    });
            }
        }
    }
</script>

