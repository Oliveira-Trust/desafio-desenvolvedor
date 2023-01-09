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

                  <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                  <p class="text-white-50 mb-4">Por favor informe seu email e senha!</p>

                  <div class="form-outline form-white mb-4 text-start">
                    <b-form-group label="Email" label-for="login-email" class="input-group-merge">
                      <b-form-input
                        id="login-email"
                        v-model="email"
                        class="form-control form-control-lg"
                      />
                    </b-form-group>
                  </div>

                  <div class="form-outline form-white mb-5 text-start">
                    <b-form-group label="Senha" label-for="login-password" class="input-group-merge">
                      <b-form-input
                        id="login-password"
                        type="password"
                        v-model="password"
                        class="form-control form-control-lg"
                      />
                    </b-form-group>
                  </div>

                  <button class="btn btn-outline-light btn-lg px-5" @click="doLogin">Entrar</button>
                </div>

                <div>
                  <p class="small mb-3 pb-lg-2"><a class="text-white-50" href="#">Esqueceu a senha?</a></p>
                  <p class="mb-0">Não tem cadastro? <a href="#" class="text-white-50 fw-bold">Cadastre-se</a>
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
import { login } from '@/services/api/index.js'

export default {
  name: 'LoginView',
  data() {
    return {
      registerActive: false,
      email: 'user@user.com',
      password: '353535',
      emailReg: '',
      passwordReg: '',
      confirmReg: '',
      loading: false,
    }
  },
  mounted() {
    useAuthStore().setAccessToken('')
  },
  methods: {
    doLogin() {
      if (this.email && this.password) {
        this.loading = true

        login({
          email: this.email,
          password: this.password
        })
          .then((result) => {
            useAuthStore().setAccessToken(result.access_token)
            this.$router.push({ name: 'home' })
          })
          .catch((error) => {
            console.error(error)
            this.$toast.error(error.response?.data?.message ?? 'Ocorreu um problema, tente novamente mais tarde.', {
              timeout: 2000
            })
          })
          .finally(() => {
            this.loading = false
          })

      }
    },

    doRegister() {
      if (this.emailReg === '' || this.passwordReg === '' || this.confirmReg === '') {
        this.emptyFields = true
      } else {
        alert('You are now registered')
      }
    }
  }
}
</script>

<style scoped>
@import '@scss/pages/login.scss';
</style>
