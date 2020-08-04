<template>
<transition name="slide-fade">
    <div class="sidebar"  v-if="displaySidebar">
        <h1>مارکت ایرانی</h1>
        <div class="sidebar-Child">
            <ul>
                <li> <router-link to="/admin/dashboard">داشبورد</router-link> </li>
                <li> <router-link to="/admin/users">کاربران</router-link> </li>
                <li> <router-link to="/admin/product">محصولات</router-link></li>
                <li> <router-link to="/admin/orders">سفارشات</router-link> </li>
            </ul>
        </div>
    </div>
</transition>
  
</template>

<script>
export default {
  data () {
    return {
      
    }
  },
  computed:{
    displaySidebar () {
      return this.$store.getters.getDisplaySidebar;
    }
  }
}
</script>

<style scoped>

.sidebar {
    height: 100vh;
    width: 15%;
    background-color: #292e40;
    display:flex;
    flex-direction: column;
    color: #a9baca;
    position: fixed;
}

.sidebar h1 {
    margin: 0.8rem 0.8rem 1.6rem 0;
    color: #eee;
}


.sidebar-Child {
    margin: 0 0.8rem;
}

.sidebar-Child ul li {
    margin: 0.5rem 0;
    padding: 0.2rem;
}

.sidebar-Child ul a.active {
    color: #7680ff;
}

.sidebar-Child ul a {
  color: #a9baca;
  text-decoration: none;
}

</style>