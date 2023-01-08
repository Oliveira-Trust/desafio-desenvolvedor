<template>
  <div id="app">
<!--    <header>-->

<!--      <div class="wrapper">-->
<!--        <nav>-->
<!--          <router-link to="/">Home</router-link>-->
<!--          <router-link to="/about">About</router-link>-->
<!--          <router-link to="/login">Login</router-link>-->
<!--        </nav>-->
<!--      </div>-->
<!--    </header>-->

    <router-view :key="$route.fullPath" />
  </div>
</template>

