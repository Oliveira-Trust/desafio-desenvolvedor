import Vue from 'vue'
import Toast, { POSITION } from 'vue-toastification'
import "vue-toastification/dist/index.css";

/**
 * NOTE: If you are using other transition them make sure to import it in `src/@resources/scss/vue/libs/notification.scss` from it's source
 */
Vue.use(Toast, {
  hideProgressBar: true,
  closeOnClick: true,
  closeButton: false,
  icon: false,
  timeout: 3000,
  position: POSITION.BOTTOM_RIGHT,
  transition: 'Vue-Toastification__fade',
});
