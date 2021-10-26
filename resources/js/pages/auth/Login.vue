<template>
    <div>
      <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="onSubmit">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" v-model="form.email" id="email"  >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" v-model="form.password" id="password"  >
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                        <pre class="alert alert-danger mt-2" v-if="Object.keys(errors).length > 0">{{ errors }}</pre>             
                    </div>
               </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: false,
                form: {
                    email: '',
                    password: '',
                    device_name: 'browser',
                },
                errors: {}
            }
        },
        created() {
        },
        methods: {
            onSubmit(){
                this.loading = true;
                this.errors = {};
                axios.post('api/v1/sanctum/token', 
                    this.form
                )
                    .then((response) => {
                        console.log('response', response);
                        localStorage.setItem('token', response.data);
                        this.$router.push('/');
                    })
                    .catch(errors => {
                        this.errors = errors.response.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        }
    }
</script>

