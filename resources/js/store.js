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
        image:value.image
      });
    }
  }
});