<script>
  import {
    Alert,
    Spinner
  } from 'sveltestrap';
  import { LogInIcon } from 'svelte-feather-icons';
  import axios from 'axios';
  import { browser } from "$app/env";
  import { token } from '../stores.js';
  import { API_URL, API_USERNAME, API_PASSWORD } from '../utils.js';

  let username = 'demo',
      password = 'demo123',
      alerts = [],
      loading = true;

  if (browser) loading = false;

  function login() {
    const params = new URLSearchParams();
    params.append('grant_type', 'password');
    params.append('username', username);
    params.append('password', password);

    loading = true;

    axios.post(`${API_URL}/user/login`, params, {
      auth: { 
        username: API_USERNAME, 
        password: API_PASSWORD 
      }
    })
    .then(resp => {
      token.update(() => resp.data.access_token);
      localStorage.setItem('token', resp.data.access_token);

      const date = new Date();
      date.setSeconds(date.getSeconds() + resp.data.expires_in);
      localStorage.setItem('expires_at', date);
    })
    .catch(error => {
      alerts.push(error.response.data.error_description);
      alerts = alerts;
    })
    .then(() => {
      loading = false;
    });
  }
</script>

<div id="login" class:loading={loading}>
  <div class="card">
    <div class="card-body">
      <form on:submit|preventDefault={login}>
        <h3 class="text-center">Oliveira Trust</h3>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Nome de usuário" required="required" bind:value={username} disabled={loading}>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Senha" required="required" bind:value={password} disabled={loading}>
        </div>
        <div class="form-group text-right">
          <button type="submit" class="btn btn-primary btn-block"><LogInIcon size="18"/> Entrar</button>
        </div>      
      </form>
    </div>
    <div class="spinner-wrapper">
      <Spinner color="primary" />
    </div>
  </div>

  <div class="alerts">
    {#each alerts as alert}
      <Alert color="danger" dismissible>
        {alert}
      </Alert>
    {/each}
  </div>
</div>

<style type="text/sass">
  #login
    position: fixed
    display: flex
    justify-content: center
    align-items: center
    height: 100%
    width: 100%

    .card-body
      padding: 1.5rem

    h3
      margin-bottom: 1.5rem

    .form-group

      &:not(:last-child)
        margin-bottom: .75rem

      .form-control
        min-width: 16rem

      .btn
        display: flex !important
        align-items: center

    .spinner-wrapper
      position: absolute
      top: 0
      left: 0
      display: flex
      justify-content: center
      align-items: center
      height: 100%
      width: 100%
      background-color: rgba(255, 255, 255, .5)
      transition: all .2s ease

    &:not(.loading) .spinner-wrapper
      opacity: 0
      pointer-events: none
</style>