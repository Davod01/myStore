<template>
  <div>
    <h1>User Dasboard</h1>
  </div>
</template>

<script>
export default {
  return: {
    registerdOeder: {
      orderId: 0,
      delivered: false,
      productList: {
        'PName' : '',
        'PUnit' : '',
        'Pprice': '',
        'PImage': ''
      }
    }
  },
  mounted : {
    
  }
}
</script>

<style>

</style>