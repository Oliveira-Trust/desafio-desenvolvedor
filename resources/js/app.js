import './bootstrap';
import IncrementCounter from './components/IncrementCounter.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('increment-counter', IncrementCounter)

app.mount('#app')