import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    ordersList:[]
  },
  mutations: {
    addTo_OrdersList (state,value) {
      state.ordersList.push({
        id:value.id,
        name:value.name,
        price:value.price,
        image:value.image,
        number: 1
      });
    }
  },
  getters: {
    getOrderTotalPrice: state => {
      let data = 0;
      state.ordersList.forEach( x => {
        data += x.number * x.price;
      });
      return data;
    }
  }
});