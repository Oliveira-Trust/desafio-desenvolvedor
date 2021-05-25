<script>
  import { Styles } from 'sveltestrap';
  import Dashboard from '../components/Dashboard.svelte';
  import Login from '../components/Login.svelte';
  import { browser } from "$app/env";
  import { token } from '../stores.js';

  let userToken;
  token.subscribe(value => {
    userToken = value;
  });

  if (browser) {
    userToken = localStorage.getItem('token') || null;
  }
</script>

{#if userToken}
  <Dashboard {userToken}>
    <slot/>
  </Dashboard>
{:else}
  <Login>
    <slot/>
  </Login>
{/if}

<Styles />