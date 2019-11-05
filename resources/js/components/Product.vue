<template>
  <div class="product" v-bind:id="'Product-' + Product.id">
    <router-link v-bind:to="'shop/' + Product.id">
      <img v-bind:src="Product.image + '.jpg'" width="200" height="200">
      <p>{{Product.name|truncate}}</p>
      <div class="product-price">
        <p> ریال</p><p>{{Product.price}}</p>
      </div>
    </router-link>
    <div class="product-button" @click="Add_To_Cart(Product)">
      <p>افزودن به سبد</p>
    </div>
  </div>
  
</template>

<script>
export default {
  props: {
    Product: {
      type: Object,
      required: true
    }
  },
  methods: {
    Add_To_Cart(value) {
      this.$store.commit('addTo_OrdersList',value)
    }
  },
  filters: {
    truncate: function(value) {
      if (value.length > 20) {
        value = value.substring(0, 17) + '...';
      }
      return value
    }
  }
}
</script>

<style>

.product {
  margin: 1.2rem;
  padding: 0.5rem;
  -webkit-transition: all 0.5s linear;
  transition: all 0.5s linear;
  /* -webkit-animation: roll-in-blurred-bottom 0.6s cubic-bezier(0.230, 1.000, 0.320, 1.000) both;
  animation: roll-in-blurred-bottom 0.6s cubic-bezier(0.230, 1.000, 0.320, 1.000) both; */
}

.product:hover {
  border: 1px solid #ebebeb;
  transform: scale(1.1);
}

.product p{
  text-align: center;
  padding: 0.3rem 0;
}

.product-price{
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  padding: 0.3rem 0;
}
.product-price p{
  display: inline-block;
  padding: 0 0.2rem;
}

.product-button {
  display: none;
  background-color: #FF5733;
  margin: 0.3rem 0;
  color: white;
  cursor: pointer;
}

.product-button p {
  text-align: center;
}

.product:hover .product-button{
  display: block;
  -webkit-animation: focus-in-expand-fwd 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	animation: focus-in-expand-fwd 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}



</style>
