<template>
  <transition name="fade-modal">
    <div class="cart-modal-container" v-if="showModal" >
      <div class="hide-cart-modal" @click="toggleCartModal(showModal)"></div>
      <div class="cart-modal">
          <div class="cart-header">
            <div class="cart-header-title"><h3>سبد خرید</h3></div>
          </div>
          <hr>
          <div class="cart-main">
            <ul>
              <li v-for="(order,index) in ordersList" v-bind:key="index">
                <div class="cart-product-image"><img v-bind:src="order.image + '.jpg'" class="cycle-image"/></div>
                <div class="cart-product-info">
                  <div class="cart-list-name">
                    <div>{{ order.name|truncate }}</div>
                    <div class="cart-list-price">{{ order.price }}</div>
                    <div class="cart-list-close" v-on:click="removeFromOrderlist(order)">حذف</div>
                  </div>
                  <div class="cart-list-number"><input type="number" class="number-of-product" v-model.number="order.number" min="1" max="99" >
                  </div>
                  <div class="cart-list-totalPrice">{{ order.price * order.number }} ریال</div>
                </div>
              </li>
            </ul>
            <div v-if="$auth.check()" class="checkOut">
              <div style="flex-grow:4">
                <p>مجموع: {{ totalPrice }}</p>
                <p>تعداد کالا : {{ordersList.length}}</p>
                <input v-model="address"  type="text" max="200" min="5" placeholder="ادرس شما">
              </div>
              <div class="checkOut-submit" @click="checkOut_orders()">خرید</div>
            </div>
            <div v-else class="checkOut">
              <div style="flex-grow:4">
                <p>مجموع: {{ totalPrice }}</p>
                <p>تعداد کالا : {{ordersList.length}}</p>
              </div>
              <router-link to="/login" class="checkOut-submit">ورود</router-link>
            </div>

          </div>
          <div class="cart-status">
            <p @click="toggleCartModal(showModal)" style="cursor: pointer">ادامه خرید</p>
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
      address: '',
      
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
      this.$store.commit('remove_Product',order);
    },

    reset_orders () {
      this.$store.commit('reset_orderList');
    },


    checkOut_orders() {
      if(this.address.length < 8){
        alert('لطفا ابتدا ادرستان را وارد کنید');
      }
      else if (this.ordersList.length < 1) {
        alert('شما کالایی انتخاب نکردید');
      }
      else {

        axios.post('/api/user/ordered', {
          address: this.address,
          orders: this.$store.getters.getOrderedProduct
          })
          .then (res => {
            console.log(res);
            this.reset_orders();
            this.address = '';
            alert('سفارش شما ثبت شد');
          })
          .catch(function (error) {
            console.log(error);
        });
      }
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
  flex-direction: column;
  position: absolute;
  left: 15%;
  top:5%;
  width: 70%;
  height: 90%;
}
.cart-header {
  height: 2.5rem;
  margin-bottom: 0.5rem;
}

hr{
  margin: 0 1rem;
}

.cart-header h3 {
  margin: 0.5rem 1rem 0.5rem 0;
}

.cart-main {
  margin: 1.5rem;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  overflow: hidden;
  flex-grow: 4;
}

.cart-main ul {
  display: flex;
  direction: ltr;
  flex-direction: column;
  width: 80%;
  height: 100%;
  overflow-y: scroll;
}

.cart-main ul li {
  width: 100%;
  display: flex;
  direction: rtl;
}

.checkOut {
  display: flex;
  flex-direction: column;
  height: 10rem;
  align-items: center;
  justify-content: center;
  width: 20%;
  background: rgb(24,24,24);
  background: linear-gradient(0deg, rgba(24,24,24,1) 0%, rgba(62,62,62,1) 100%);
  align-self: flex-end;
  color: #fff
}

.checkOut input {
  height: 2rem;
  width: 8rem;
  margin-top: 1rem;
}



.checkOut-submit {
  margin-bottom: 4px;
  flex-grow: 0.5;
  text-align: center;
  width: 5rem;
  padding: 0 1rem;
  background-color: #C70039;
  border-radius: 15px;
  color: #fff;
  cursor: pointer;
}


.cart-status {
  display: flex;
  flex-direction: row-reverse;
  justify-content: space-between;
  margin: 0 1rem;
  height: 2rem;
}


.cycle-image {
  width: 5rem;
  height: 5rem;
  border-radius: 50px;
}

.cart-product-image{
  width: 7rem;
    height: 6rem;
    display: flex;
    justify-content: center;
    align-items: center;
}

.cart-product-info {
  display: flex;
  flex-grow: 1;
  padding: 0.5rem 0;
}

.cart-list-name{
  width: 150px;
  display: flex;
  flex-direction: column;
}

.cart-list-number{
  width: 80px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.cart-list-price{
  width: 80px;
  font-size: 0.8rem;
  padding: 0.5rem 0;
  font-weight: 100;
}

.cart-list-totalPrice {
  display: flex;
  justify-content: center;
  align-items: center;
}

.cart-list-total{
  width: 110px;
}

.cart-list-close {
  width: 30px;
  cursor: pointer;
  color: cornflowerblue;
  font-size: 0.9rem;
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