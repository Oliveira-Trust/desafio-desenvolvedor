import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'
import Conversor from '../views/Conversor.vue'
import Historico from '../views/Historico.vue'
import Moedas from '../views/Moedas.vue'
import Usuarios from '../views/Usuarios.vue'

import { userKey } from '@/config/global'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'login',
    component: Login
  },
  {
    path: '/conversor',
    name: 'conversor',
    component: Conversor
  },
  {
    path: '/historico',
    name: 'historico',
    component: Historico
  },
  {
    path: '/usuarios',
    name: 'usuarios',
    component: Usuarios,
    meta: {
      requiresAdmin: true
    }
  },
  {
    path: '/moedas',
    name: 'moedas',
    component: Moedas,
    meta: {
      requiresAdmin: true
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  routes
})

router.beforeEach((to, from, next) => {
  const json = localStorage.getItem(userKey) || null

  if (to.matched.some(record => record.meta.requiresAdmin)) {
    const usuario = JSON.parse(json)
    usuario && usuario.usuario.admin === 1 ? next() : next(from)
  } else {
    next()
  }
})

export default router
