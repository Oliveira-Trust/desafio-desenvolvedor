<template>
  <aside
    v-show="isSideMenuVisible"
    class="sideMenu"
  >
    <b-navbar-nav>
      <b-nav-item to="/conversor">
        Conversor
      </b-nav-item>
      <b-nav-item to="/historico">
        Historico
      </b-nav-item>
      <b-nav-item
        v-if="usuario.admin"
        to="/usuarios"
      >
        Usuarios
      </b-nav-item>
      <b-nav-item
        v-if="usuario.admin"
        to="/moedas"
      >
        Moedas
      </b-nav-item>
    </b-navbar-nav>
  </aside>
</template>

<script>
import { mapState } from 'vuex'
export default {
  name: 'Sidemenu',
  computed: mapState(['isSideMenuVisible', 'isToggle', 'isConfigVisible', 'usuario'])
}
</script>

<style>
.sideMenu {
    grid-area: sideMenu;
    background: linear-gradient(to right, #232526, #414345);

    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
}

.sideMenu a,
.sideMenu a:hover
{
  color: #fff;
  text-decoration: none;
}

.sideMenu li > a:hover
 {
   background-color: rgba(255,255,255,0.2);
}

</style>
