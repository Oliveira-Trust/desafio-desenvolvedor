<template>
  <b-overlay
    :show="loading"
  >
    <section class="vh-100 login-section">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <div class="mb-md-4 mt-md-3 pb-3">

                  <h2 class="fw-bold mb-2 text-uppercase">Cadastro</h2>

                  <div class="form-outline form-white mb-4 text-start">
                    <b-form-group label="Nome" label-for="name" class="input-group-merge">
                      <b-form-input
                        id="name"
                        v-model="name"
                        class="form-control form-control-lg"
                      />
                    </b-form-group>
                  </div>

                  <div class="form-outline form-white mb-4 text-start">
                    <b-form-group label="Email" label-for="email" class="input-group-merge">
                      <b-form-input
                        id="email"
                        v-model="email"
                        class="form-control form-control-lg"
                      />
                    </b-form-group>
                  </div>

                  <div class="form-outline form-white mb-5 text-start">
                    <b-form-group label="Senha" label-for="password" class="input-group-merge">
                      <b-form-input
                        id="password"
                        type="password"
                        v-model="password"
                        class="form-control form-control-lg"
                      />
                    </b-form-group>
                  </div>

                  <button class="btn btn-outline-light btn-lg px-5" @click="doRegister">Cadastrar</button>
                </div>

                <div>
                  <p class="mb-0">
                    <b-link :to="{name:'login'}" class="text-white-50 fw-bold">Login</b-link>
                  </p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </b-overlay>
</template>

<script>
import { useAuthStore } from '@/stores/auth.js'
import { login, signup } from '@/services/api/index.js'
import { getApiErrorMessageFromResponse } from '@/utils/index.js'

export default {
  name: 'LoginView',
  data() {
    return {
      email: '',
      name: '',
      password: '',
      loading: false,
    }
  },
  mounted() {
    useAuthStore().setAccessToken('')
  },
  methods: {
    doRegister() {
      if (!this.email || !this.password || !this.name) {
        this.$toast.error('Informe os campos obrigatórios!', { timeout: 3000 })

      }
      this.loading = true

      signup({
        name: this.name,
        email: this.email,
        password: this.password
      })
        .then((result) => {
          this.$toast.success('Cadastro realizado com sucesso!', { timeout: 3000 })
          this.$router.push({ name: 'login' })
        })
        .catch((error) => {
          const errorMessage = getApiErrorMessageFromResponse(error)
          this.$toast.error(errorMessage, { timeout: 3000 })
        })
        .finally(() => {
          this.loading = false
        })

    }
  }
}
</script>

<style scoped>
@import '@scss/pages/login.scss';
</style>
