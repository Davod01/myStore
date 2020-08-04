<template>
  <header class="Dheader">
    <div class="Dhead1">
      <div class="DsidbarButton">
        <img src="/svg/menu2.svg" class="icon-size-2" alt="sidebar icon" v-on:click="funcDisplaySidebar">
      </div>
    </div>
    <div class="Dhead2">
      <div class="profile" v-on:click="displayPanel = !displayPanel">
        <div><p>مدیر</p></div>
        <div class="profile-icon">
          <img src="/svg/user.svg" class="icon-size-2" alt="profile icon">
        </div>
      </div>
      <transition name="slide-fade">
        <div class="profile-panel" v-if="displayPanel">
          <ul>
            <li><a href="/" >سایت</a></li>
            <li><a href="#" @click.prevent="$auth.logout()">خروج</a></li>
          </ul>
        </div>
      </transition>
    </div>
  </header>
</template>

<script>
export default {
  name: "DashboardNav",
  data () {
    return{
      displayPanel : false,
    }
  },
  methods: {
    funcDisplaySidebar () {
      this.$store.commit("toggleDisplaySidebar");
    }
  }
}
</script>

<style>
  .Dheader {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    padding: 1rem 0 1rem 0;
    height: 2.5rem;
    margin: 0.4rem 0;
    border-bottom: 1px solid #eceff5;
    }

  .Dhead1 {
    margin: 0 1.4rem;
    flex-grow: 1;
  }

  .Dhead2 {
    margin: 0 1.4rem;
  }

  .profile {
    display: flex;
    flex-direction: row;
    padding:0.4rem 3rem;
    cursor: pointer;
  }
  .profile div {
    margin: 0 0.2rem;
  }
  .profile-panel {
    position: absolute;
    border: solid 1px #eceff5;
    left: 75px;
    
  }

  .profile-panel ul {
    display: flex;
    flex-direction: column;
    width: 5rem;
    font-size: 16px;
  }

  .profile-panel ul li {
    padding: 2px 10px 2px 0;
    cursor: pointer;
  }

  .profile-panel ul li:hover {
    background-color: #dfdfdf;
  }

  .profile-panel ul:last-child li {
    margin:5px 0;
  }
  
</style>