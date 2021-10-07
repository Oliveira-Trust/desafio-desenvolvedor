<template>
  <div class="login-content">
    <div class="login-modal">
      <img
        src="@/assets/images/logo.png"
        width="200"
        alt="Logo"
      >
      <hr>
      <div class="login-title">
        {{ showSignup ? 'Cadastro' : 'Login' }}
      </div>
      <input
        v-if="showSignup"
        v-model="usuario.nome"
        type="text"
        placeholder="Nome"
      >
      <input
        v-model="usuario.email"
        name="email"
        type="text"
        placeholder="E-mail"
      >
      <input
        v-model="usuario.password"
        name="password"
        type="password"
        placeholder="Senha"
      >
      <input
        v-if="showSignup"
        v-model="usuario.confirmPassword"
        type="password"
        placeholder="Confirme a Senha"
      >
      <button
        v-if="showSignup"
        @click="signup"
      >
        Registrar
      </button>
      <button
        v-else
        @click="signin"
      >
        Entrar
      </button>
      <a
        @click.prevent="showSignup = !showSignup"
      >
        <span
          v-if="showSignup"
        >
          Já tem cadastro? Acesse o Login!
        </span>
        <span
          v-else
        >
          Não tem cadastro? Registre-se aqui!
        </span>
      </a>
    </div>
  </div>
</template>

<script>
import { baseApiUrl, showError, userKey } from '@/config/global'
import axios from 'axios'

export default {
  name: 'Login',
  data () {
    return {
      showSignup: false,
      usuario: {}
    }
  },
  mounted () {
      localStorage.removeItem(userKey)
      this.usuario = {}
      this.showSignup = false
    },
  methods: {
    signin () {
      axios.post(`${baseApiUrl}/auth/login`, this.usuario)
        .then(res => {
          this.$store.commit('setUsuario', res.data)
          localStorage.setItem(userKey, JSON.stringify(res.data))
          this.$router.push({ path: '/conversor' })
          showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError('Usuario ou Senha Invalidos')
        })
    },
    signup () {
      axios.post(`${baseApiUrl}/auth/register`, this.usuario)
        .then(res => {
          this.$toasted.global.defaultSuccess()
          this.usuario = {}
          this.showSignup = false
         showSuccess('Solicitação realizada com sucesso', res.status)
        }).catch(function (error) {
          showError(error.message)
        })
    }
  },
}
</script>

<style>
.login-content {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-modal {
        background-color: #fff;
        width: 350px;
        padding: 35px;
        box-shadow: 0 1px 5px rgba(0,0,0,0.15);

        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .logo {
        width: 15rem;
    }
    .login-modal input {
        border: 1px solid #bbb;
        width: 100%;
        margin-bottom: 15px;
        padding: 3px 8px;
        outline: none;
    }
    .login-modal button {
        align-self: center;
        background-color:  #2460ae;
        color: #fff;
        padding: 5px 15px;
        border-radius: 5px;
    }
    .login-modal hr {
        border: 0;
        width: 100%;
        height: 1px;
        background-image: linear-gradient(to right,
            rgba(120,120,120,0),
            rgba(120,120,120,0.75),
            rgba(120,120,120,0));
    }
</style>
