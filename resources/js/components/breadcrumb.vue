<template>
  <div class="breadcrumb">
    <ul>
      <li v-for="(breadcrumb,idx) in BreadcrumbList" v-bind:key="idx">
        <div v-if="breadcrumb.link">
          <router-link v-bind:to="breadcrumb.link">{{breadcrumb.name}}</router-link>
        </div>
        <div v-else>{{breadcrumb.name}}</div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'breadcrumb',
  data () {
    return {
      BreadcrumbList: []
    }
  },
  mounted () {
    this.updateList();
  },
  watch: {
    '$route' () {
      this.updateList();
    }
  },
  methods: {
    // routeTo (pRouteTo) {
    //   if(this.BreadcrumbList[pRouteTo].link) {
    //     thi
    //   }
    // },
    updateList () {
      this.BreadcrumbList = this.$route.meta.breadcrombs;
    }
  }
}
</script>

<style>
  .breadcrumb {
    background-color: #ddd;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: flex-start;
    margin: 2rem;
    padding: 1rem;
  }
  .breadcrumb ul{
    display: flex;
    align-items: center;
  }
  .breadcrumb ul li{
    margin: 0 0.4rem
  }
  .breadcrumb ul li a:hover {
    color: coral;
  }
</style>