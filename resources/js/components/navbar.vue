<template>
  <header>
    <Cart :showModal="cumpCartModal" @toggleCartModal="toggleCartModal"></Cart>
    <div class="header">
      <div class="header-first-child">
        <div class="show-nav" v-on:click='ShowNav'><i class="fas fa-align-justify"></i></div>
        <div class="logo">مارکت ایرانی</div>
        <div class="nav">
          <div class="nav-close" v-on:click='HideNav'>
            <i class="fas fa-align-justify"></i>
          </div>
          <ul>
            <li>
              <router-link to="/">خانه</router-link>
            </li>
            <li>
              <router-link to="/shop">محصولات</router-link>
            </li>
            <li>
              <router-link to="/">درباره ما</router-link>
            </li>
          </ul>
        </div>
      </div>

      <div class="header-second-child">
        
        <div class="search-bar">
          <input type="text" placeholder="جست و جو" maxlength="30" minlength="3" />
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="header-child">
            <div class="user">
              <i class="fas fa-user"></i>
              <div class="user-plate">

                <ul v-if="$auth.check() && $auth.user().is_admin === 1">
                  <li v-for="(route, key) in routes.admin" v-bind:key="route.path">
                    <router-link  :to="{ name : route.path }" :key="key">
                        {{route.name}}
                    </router-link>
                  </li>
                  <li>
                    <a href="#" @click.prevent="$auth.logout()">خروج</a>
                  </li>
                </ul>

                <ul v-else-if="$auth.check()">
                   <li v-for="(route, key) in routes.user" v-bind:key="route.path">
                    <router-link  :to="{ name : route.path }" :key="key">
                        {{route.name}}
                    </router-link>
                  </li>
                  <li>
                    <a href="#" @click.prevent="$auth.logout()">خروج</a>
                  </li>
                </ul>

                <ul v-else>
                  <li v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                    <router-link  :to="route.path" :key="key">
                        {{route.name}}
                    </router-link>
                  </li>
                </ul>

              </div>
            </div>
          <div class="cart" @click="cumpCartModal = !cumpCartModal"><i class="fas fa-cart"></i></div>
        </div>
      </div>
    </div>
    <breadcrumb></breadcrumb>
  </header>
</template>

<script>
const myNav = document.getElementsByClassName('nav');
import axios from "axios"
import breadcrumb from "../components/breadcrumb"
import Cart from '../components/cartModal'

export default {
  components: {
    breadcrumb,
    Cart
  },
  data () {
    return {
      cartModal: false,
       routes: {
          // UNLOGGED
          unlogged: [
            {
              name: 'ورود',
              path: 'login'
            },
            {
              name: 'ثبت نام',
              path: 'register'
            }
          ],
          // LOGGED USER
          user: [
            {
              name: 'پنل کاربری',
              path: 'userDashboard'
            }
          ],
          // LOGGED ADMIN
          admin: [
            {
              name: 'پنل مدیریت',
              path: 'adminDashboard'
            }
          ]
      }
    }
  },
  methods: {
    ShowNav () {
      for (var i=0;i < myNav.length;i+=1){
        myNav[i].style.visibility = 'visible';
        myNav[i].style.opacity = 1;
      }
    },
    HideNav () {
      for (var i=0;i<myNav.length;i+=1){
        myNav[i].style.visibility = 'hidden';
        myNav[i].style.opacity = 0;
      }
    },
    toggleCartModal (value) {
      this.cumpCartModal = !value;
    }
  },
  computed: {
    cumpCartModal: {
      get () {
        return this.cartModal;
      },
      set (newValue) {
        this.cartModal = newValue;
      }
    }
  },
}
</script>

<style>
  .header{
    border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    padding: 1rem 0 1rem 0;
    margin: 1rem;
  }

  .header-first-child {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    flex-grow: 1;
  }

  .header-second-child {
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
    align-items: center;
    flex-grow: 1;
  }

  .logo{
    font-size: 2rem;
    font-weight: bold;
  }

  .nav {
    margin: auto;
  }

  .show-nav{
    display: none;
  }

  .nav-close {
    display: none;
    font-size: 2rem;
    padding: 0.5rem;
  }

  .nav ul{
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-items: center;
  margin-bottom: 0;
  font-size: 1.4rem;
  }

  .nav  ul li{
    margin: 0 1.4rem 0 0;
  }

  .search-bar {
    flex-grow: 2;
  }

  .search-bar input[type=text]{
    border-top-right-radius: 45px;
    border-bottom-right-radius: 45px;
    background: #fff none repeat scroll 0 0;
    border: solid 1px #ddd;
    outline: medium none;
    font-size: 1rem;
    padding: 0.5rem 2rem;
  }
  .search-bar button{
    background-color: #f1ac06;
    border: medium none;
    border-radius: 40px 0 0 40px;
    color: #fff;
    font-size: 1rem;
    padding: 0.6rem 0.8rem;
    margin-right: -5px;
  }

  .user {
    position: relative;
    flex-grow: 1;
    display: inline-block;
    justify-content: center;
  }

  .user-plate {
    display: none;
    position: absolute;
    width:100px;
    height: 90px;
    top: 46px;
    left: 15px;
    background: #fafafa;
  }

  .user:hover .user-plate {
    display: flex;
  }

  .user-plate::before {
    content: '';
    position: absolute;
    width: 100px;
    height: 30px;
    top: -30px;
  }

  .user-plate ul {
    display: flex;
    flex-direction: column;
  }

  .user-plate ul li {
    list-style: none;
    padding: 10px 10px 10px 20px;
    font-weight: 50;
    position: relative;
  }

  .user-plate ul li::before {
    content: '';
    position: absolute;
    right: 5px;
    bottom: 5px;
    height: 2px;
    width: 0px;
    background-color: red;
    transition: all 0.5s;
    opacity: 0.5;
  }

  .user-plate ul li:hover::before {
    width: 90px;
  }
  .logo{
    margin:0 2rem 0 2rem;
  }

  .cart {
    flex-grow: 1;
  }

  .header-child {
    flex-grow: 1;
    display: flex;
    flex-direction: row;
  }


@media screen and (max-width: 798px) and (min-width: 498px)  {
  .header{
    flex-direction: column;
  }
  .header-first-child {
    margin: 1rem 0;
    align-items: center;
    width: 100%;
  }

  .header-second-child {
    width: 100%;
  }
  
  .nav{
    display: flex;
    flex-direction: column;
    position: absolute;
    background-color: #fff;
    top:0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0;
    visibility: hidden;
    transition: visibility 0s, opacity 0.5s linear;
    -webkit-transition: visibility 0s, opacity 0.5s linear;
  }

  .nav-close {
    display: block;
    float: right;
  }

  .nav ul {
    flex-direction: column;
  }

  .nav ul li{
    margin: 1.5rem auto;
  }

  .show-nav{
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    margin: 0 1rem;
    flex-grow: 1;
    font-size: 1.5rem;
  }
  

  .logo{
    margin: 0 1rem;
    flex-grow: 1;
  }

  .search-bar {
    flex-grow: 1;
  }

  .search-bar input[type=text]{
    padding: 0.5rem 1rem;
  }

}

@media screen and (max-width: 497px) {
  .header{
    flex-direction: column;
  }
  
  .header-first-child {
    margin: 1rem 0;
    align-items: center;
    width: 100%;
  }

  .header-second-child {
    width: 100%;
  }
  
  .nav{
    display: flex;
    flex-direction: column;
    position: absolute;
    background-color: #fff;
    top:0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0;
    visibility: hidden;
    transition: visibility 0s, opacity 0.5s linear;
    -webkit-transition: visibility 0s, opacity 0.5s linear;
  }

  .nav-close {
    display: block;
    float: right;
  }

  .nav ul {
    flex-direction: column;
  }

  .nav ul li{
    margin: 1.5rem auto;
  }

  .show-nav{
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    margin: 0 1rem;
    flex-grow: 1;
    font-size: 1.5rem;
  }
  

  .logo{
    margin: 0 1rem;
    flex-grow: 1;
  }

  .search-bar {
    flex-grow: 1;
  }

  .search-bar input[type=text]{
    padding: 0.5rem 1rem;
  }

}

</style>
