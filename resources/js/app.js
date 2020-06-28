import Vue from 'vue'
import router from './routes/routes'
import App from './views/App'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import auth from './auth'
import axios from 'axios';
import './bootstrap'
import Store from './store'
import VueCookies from 'vue-cookies'



window.Vue = Vue
// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication
Vue.use(VueAxios, axios)

Vue.use(VueAuth, auth)

Vue.use(VueCookies)

Vue.$cookies.config('7d')

const app = new Vue({
  el: '#app',
  router: router,
  store: Store,
  render:h=>h(App),
}).$mount('#app')