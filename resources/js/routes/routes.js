import vueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import dashboard from '../views/dashboard.vue'
import userDashboard from '../views/userDasboard.vue'
import Register from '../views/Register.vue'
import Shop from '../views/Shop.vue'
import singleProduct from '../views/singleProduct.vue'
import AppHeader from '../components/navbar.vue'
import AppFooter from "../components/footer.vue";


export default new vueRouter({
  linkExactActiveClass: "active",
  history:true,
  mode:'history',
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
        ],
        auth: undefined
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
        ],
        auth: undefined
      }
    },

    {
      path: "/login",
      name: "login",
      components: {
        default: Login,
      },
      meta: {
        auth: false
      }
    },

    {
      path: "/register",
      name: "register",
      components: {
        default: Register,
      },
      meta: {
        auth: false
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
        ],
        auth:undefined
      }
    },

    //
    //User Dashboard
    //
    {
      path: '/user/dashboard',
      name: 'userDashboard',
      components: {
        header: AppHeader,
        default: userDashboard,
        footer: AppFooter
      },
      meta: {
        auth: true
      }
    },

    //
    //Admin Dasboard
    //
    {
      path: '/admin/dashboard',
      name: 'adminDashboard',
      component: dashboard,
      meta: {
        auth: true
      }
    },
    
  ]
});