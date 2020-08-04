<template>
  <div class="single-product">
    <div class="single-product-info">
      <div class="product-image">
        <img :src="'/' + Product.image + '.jpg'" class="produxt-image-main">
      </div>
      <div class="product-property">
        <h3 class="product-name">{{ Product.name }}</h3>
        <p>{{ Product.price }} ریال</p>
        <div>
          <input class="add-to-cart-input" type="number" min="1" value="1">
       </div>
       <div>
        <div class="add-to-cart-submit" @click="Add_To_Cart(Product)">افزودن به سبد</div>
       </div>
      </div>
    </div>
    
    <div class="product-description">{{ Product.description }}</div>

  </div>
</template>

<script>
export default {
  name:'singleProduct',
  data () {
    return {
      Product:''
    }
  },
  methods: {
    Add_To_Cart (value) {
      this.$store.commit('addTo_OrdersList',value);
    }
  },
  created () {
    axios.get('/api/shop/' + this.$route.params.product ).then(x => {
      this.Product = x.data;
    })
    .catch (err => {
      alert(err.message);
    });
  }
}
</script>

<style>
  .add-to-cart-input {
    background: #fff;
    padding: 5px;
    height: 25px;
    border: 1px solid #ebebeb;
    border-radius: 50px;
    text-align: center;
    width:100px;
  }

  .add-to-cart-submit{
    background: #f1ac06 none repeat scroll 0 0;
    border-color: #f1ac06;
    color: #fff;
    display: inline-block;
    height: 40px;
    border-radius: 15px;
    line-height: 36px;
    text-align: center;
    text-transform: capitalize;
    width: 100px;
    cursor: pointer;
  }

  .single-product{
    display: flex;
    flex-direction: column;
    margin: 2rem;

  }
  .single-product-info{
    display: flex;
    flex-direction: row;
  }


  .product-property {
    flex-grow: 1;
    display: flex;
    margin-right: 1.5rem;
    flex-direction: column;
  }

  .product-property * {
    margin: 0.5rem 0 0.5rem 0;
  }

  @media screen and (min-width:799px) {
    
  }

  @media screen and (max-width: 798px) and (min-width: 498px) {
  .add-to-cart input {
    width:40%
  }

  .add-to-cart a{
    width: 40%;
  }
}

@media screen and (max-width: 497px) {
  .produxt-image-main {
    width: 100%;
  }

  .product-name{
    margin: 1rem 0;
  }

  .product-price{
    margin: 1rem 0;
  }
  .product-description {
    font-size: 1rem;
  }
  .add-to-cart input {
    width:40%
  }

  .add-to-cart a{
    width: 40%;
  }
}
</style>