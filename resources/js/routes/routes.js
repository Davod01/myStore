import Vue from 'vue'
import Router from 'vue-router'
import Home from '../views/Home.vue'
import Shop from '../views/Shop.vue'
import singleProduct from '../views/singleProduct.vue'
import AppHeader from '../components/navbar.vue'
import AppFooter from "../components/footer.vue";


Vue.use(Router)

export default new Router({
  linkExactActiveClass: "active",
  routes: [
    {
      path: "/",
      name: "Home",
      components: {
        header: AppHeader,
        default: Home,
        footer: AppFooter
      },
      meta: {
        breadcrombs: [
          {name: 'خانه'}
        ]
      }
    },
    {
      path: "/shop",
      name: "Shop",
      components: {
        header: AppHeader,
        default: Shop,
        footer: AppFooter
      },
      meta: {
        breadcrombs: [
          {name: 'خانه /',link:'/'},
          {name: 'بخش خرید /',link:'/shop'}
        ]
      }
    },
    {
      path: "/shop/:product",
      name: "singleProduct",
      components: {
        header: AppHeader,
        default: singleProduct,
        footer: AppFooter
      },
      meta: {
        breadcrombs: [
          {name: 'خانه /',link:'/'},
          {name: 'بخش خرید /',link:'/shop'},
          {name: 'محصول'}
        ]
      }
    },
  ]
});