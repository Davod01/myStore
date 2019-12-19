<template>
  <transition name="fade-modal">
    <div class="cart-modal-container" v-if="showModal" >
      <div class="hide-cart-modal" @click="toggleCartModal(showModal)"></div>
      <div class="cart-modal">
        <div class="cart-orders">
          <div class="cart-header">
            <div class="cart-header-title"><h2>سبد خرید</h2></div>
            <div class="cart-header-close"></div>
          </div>
          <div class="cart-main">
            <ul v-for="(order,index) in ordersList" v-bind:key="index">
              <li class="cart-list-image"><img v-bind:src="order.image + '.jpg'" class="cycle-image" /></li>
              <li class="cart-list-name">{{ order.name|truncate }}</li>
              <li class="cart-list-price"><input type="number" class="number-of-product" v-model.number="order.number" min="1" max="99" > </li>
              <li class="cart-list-price">{{ order.price }}</li>
              <li class="cart-list-total">{{ order.price * order.number }}</li>
              <li class="cart-list-close" v-on:click="removeFromOrderlist(order)"><i class="far fa-times-circle color-red"></i></li>
            </ul>
          </div>
          <div class="cart-status">
            <p @click="toggleCartModal(showModal)" style="cursor: pointer">ادامه خرید</p>
            <p>مجموع: {{ totalPrice }}</p>
          </div>
        </div>
        <div class="cart-main-form">
          
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'cartModal',
  props: {
    showModal: {
      type: Boolean,
      required: true,
      default: false
    }
  },
  data () {
    return {
      
    }
  },
  computed: {
    ordersList () {
      return this.$store.state.ordersList;
    },
    totalPrice () {
      return this.$store.getters.getOrderTotalPrice
    } 
  },
  methods: {
    toggleCartModal (value) {
      this.$emit('toggleCartModal',value);
    },
    removeFromOrderlist (order) {
      this.ordersList.splice( this.ordersList.indexOf(order),1 );
    }
  },
  filters: {
    truncate: function(value) {
      if (value.length > 15) {
        value = value.substring(0, 14) + '...';
      }
      return value
    }
  }

}
</script>

<style>

.cart-modal-container {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(60,60,60,0.5);
  overflow: hidden;
}

.hide-cart-modal{
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(60,60,60,0.5);
  overflow: hidden;
}

.cart-modal {
  background-color: white;
  display: flex;
  flex-direction: row;
  position: absolute;
  left: 15%;
  top:5%;
  width: 70%;
  height: 90%;
}
.cart-orders {
  display: flex;
  flex-direction: column;
  width: 70%;
}
.cart-header {
  margin: 1rem 2rem 0 0;
  flex-grow: 1;
}

.cart-main {
  margin: 1.5rem;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  overflow: auto;
  flex-grow: 4;
}

.cart-main ul {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.cart-status {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  margin: 0 1rem;
  height: 2rem;
}

.cart-main-form{
  background-color: #484a52;
  width: 30%;
  margin: 1rem;
}

.cycle-image {
  width: 50px;
  height: 50px;
  border-radius: 50px;
}

.cart-list-image{
  width: 80px;
}

.cart-list-name{
  width: 150px;
}

.cart-list-number{
  width: 30px;
}

.cart-list-price{
  width: 80px;
}

.cart-list-total{
  width: 110px;
}

.cart-list-close {
  width: 30px;
  cursor: pointer;
}

.cart-list-close:hover {
  transform: scale(1.2);
}

.number-of-product {
  width: 40px;
  display: inline-block;
}
@media screen and (max-width: 798px) and (min-width: 498px)  {

}
@media screen and (max-width: 497px) {

}

/* 
.fade-modal-enter-active, .fade-modal-leave-active {
  transition: opacity .5s;
}
.fade-modal-enter, .fade-modal-leave-to  {
  opacity: 0;
}
 */

/* .fade-modal-enter-active {
  transition: all .5s ease;
}
.fade-modal-leave-active {
  transition: all 1s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.fade-modal-enter, .fade-modal-leave-to
{
  transform: translateX(10px);
  opacity: 0;
} */

.fade-modal-enter-active {
  animation: bounce-in .5s;
}
.fade-modal-leave-active {
  animation: bounce-in .5s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}

</style>