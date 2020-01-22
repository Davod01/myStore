import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
      ordersList: []
  },
  mutations: {
    addTo_OrdersList (state,value) {
      let itemExist = false;
      for (let i = 0 ; i < state.ordersList.length ; i++) {
        if (state.ordersList[i].id === value.id ) {
          itemExist = true;
          break;
        }
      }
      if ( itemExist === false) {
        state.ordersList.push({
        id:value.id,
        name:value.name,
        price:value.price,
        image:value.image,
        number: 1
        });
      }
      Vue.$cookies.set('cart',JSON.stringify(state.ordersList));
    },

    set_orderList (state,value) {
      state.ordersList = JSON.parse(value);
    },

    remove_Product (state,value) {
      state.ordersList.splice( state.ordersList.indexOf(value),1 );
      Vue.$cookies.set('cart',JSON.stringify(state.ordersList));
    },
    
    reset_orderList (state) {
      state.ordersList=[];
      Vue.$cookies.remove('cart');
    }
  },
  getters: {
    getOrderTotalPrice: state => {
      let data = 0;
      state.ordersList.forEach( x => {
        data += x.number * x.price;
      });
      return data;
    },
    getOrderedProduct: state => {
      let data = [];
      state.ordersList.forEach( x => {
        data.push(
          [
          x.id,
          x.number
        ])
      });
      return data;
    }
  }
});