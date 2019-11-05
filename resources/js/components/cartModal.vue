<template>
  <transition name="fade-modal">
    <div class="cart-modal-container" v-if="showModal" @click="toggleCartModal(showModal)">
      <div class="cart-modal">
        <div class="cart-modal-header">
          <h1>سفارشات شما</h1>
          <h1 class="cart-modal-close color-red"><i class="fas fa-window-close"></i></h1>
        </div>
        <hr>
        <div class="cart-modal-main"></div>
        <div class="cart-modal-status"></div>
        <div class="cart-modal-footer"></div>
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
  computed: {
    ordersList () {
      return this.$store.state.ordersList;
    }
  },
  methods: {
    toggleCartModal (value) {
      this.$emit('toggleCartModal',value);
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

.cart-modal {
  background-color: white;
  display: flex;
  flex-direction: column;
  position: absolute;
  left: 20%;
  top:5%;
  width: 60%;
  height: 90%;
}

.cart-modal-header {
  display: flex;
  flex-direction: row;
  margin: 0.5rem;
}

.cart-modal-header h1 {
  font-weight:200;
}
.cart-modal-close {
  flex-grow: 1;
  text-align: end;
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