import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import '@/config/msgs'
import '@/plugins/bootstrap'
import 'font-awesome/css/font-awesome.css'

Vue.config.productionTip = false

Vue.filter('converterData', function(valor){
    const d = valor.split('');
    const data = d[0].split('-').reverse().join('/');
    const hora = d[1];
    const final = data+" "+hora;
    return final;
})

Vue.filter('currency', function(valor, moeda){
  if(typeof valor !== "number") {
    return valor;
  }
  var formato;
  if(moeda!=='BRL'){
    formato = new Intl.NumberFormat('en-US',{
      style: 'currency',
      currency: moeda,
      minimumFractionDigits: 2
    });
    return
  }else{
    formato = new Intl.NumberFormat('pt-BR',{
      style: 'currency',
      currency: moeda,
      minimumFractionDigits: 2
    });
  }
  return formato.format(valor);
})

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
