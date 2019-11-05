import Vue from 'vue'
import Router from './routes/routes'
import App from './views/App'
import './bootstrap'
import Store from './store'

const app = new Vue({
  el: '#app',
  router:Router,
  store:Store,
  render:h=>h(App),
}).$mount('#app')