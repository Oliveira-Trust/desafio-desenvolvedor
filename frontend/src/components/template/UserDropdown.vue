<template>
  <div class="user-dropdown">
    <div class="user-button">
      <span class="d-none d-sm-block">
        {{ usuario.name }}
      </span>
      <div class="user-dropdown-img">
        <Gravatar
          :email="usuario.email"
          alt="User"
        />
      </div>
      <i class="fa fa-angle-down" />
    </div>
    <div class="user-dropdown-content">
      <a
        @click.prevent="logout"
      >
        <i class="fa fa-sign-out" /> Sair
      </a>
    </div>
  </div>
</template>

<script>
import { userKey } from '@/config/global'
import { mapState } from 'vuex'
import Gravatar from 'vue-gravatar'

export default {
    name: 'UserDropdown',
    components: { Gravatar },
    computed: mapState(['usuario']),
    methods: {
        logout() {
            localStorage.removeItem(userKey)
            this.$store.commit('setUsuario', null)
            this.$store.commit('isSideMenuVisible', false)
            this.$router.push({ name: 'login' })
        }
    }
}
</script>

<style>
    .user-dropdown {
        position: relative;
        height: 100%;
    }

    .user-button {
        display: flex;
        align-items: center;
        color: #fff;
        font-weight: 100;
        height: 100%;
        padding: 0px 20px;
    }

    .user-dropdown:hover {
        background-color: rgba(0, 0, 0, 0.2);
    }

    .user-dropdown-img {
        margin: 0px 10px;
    }

    .user-dropdown-img > img {
        max-height: 37px;
        border-radius: 5px;
    }
    .user-dropdown-content {
        position: absolute;
        right: 0px;
        background-color: #f9f9f9;
        min-width: 170px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 10px;
        z-index: 1;

        display: flex;
        flex-direction: column;
        flex-wrap: wrap;

        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.5s linear;
    }

    .user-dropdown:hover .user-dropdown-content {
        visibility: visible;
        opacity: 1;
    }

    .user-dropdown-content a {
        text-decoration: none;
        color: #000;
        padding: 10px;
    }

    .user-dropdown-content a:hover {
        text-decoration: none;
        color: #000;
        background-color: #EDEDED;
    }
</style>
