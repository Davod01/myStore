import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
      myProducts: [],
      ordersList: [],
      filteredProduct: [],
      ordersPaginate: [],
      usersPaginate: [],
      productsPaginate: [],
      shopPagination: 1,
      shopCurentPage: 1,
      numberOfProductDisplayed: 24,
      displaySidebar: false,


  },
  mutations: {
    /*
    *************************************
    *************** Orders***************
    *************************************
    */
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
    
    reset_orderList (state) {
      state.ordersList=[];
      Vue.$cookies.remove('cart');
    },

    remove_Product (state,value) {
      state.ordersList.splice( state.ordersList.indexOf(value),1 );
      Vue.$cookies.set('cart',JSON.stringify(state.ordersList));
    },
    /*
    *************************************
    *************** MyProducts***************
    *************************************
    */

    setMyProducts (state) {
      axios.get('/api/shop').then (x => {
        state.myProducts = x.data;
        state.filteredProduct = x.data;
      })
      .catch(err => {
        alert(err.message)
      })
    },

    setFilteredProduct (state) {
      state.filteredProduct = state.myProducts;
    },

    setFilteredProductNone (state) {
      state.filteredProduct = [];
    },

    pushIntoFilteredProduct (state,value) {
      state.filteredProduct.push(value);
    },

    searchInProducts (state,value) {
      let name='';
      state.filteredProduct = [] ;
      state.myProducts.forEach(x => {
        name = x.name.toLowerCase()
        if ( name.indexOf( value.toLowerCase() ) > -1) {
          state.filteredProduct.push(x);
        }
      })
    },

    sortProducts (state , value) {
      switch(value){
        case 'new':
          state.filteredProduct.sort(function(a,b){return a.created_at - b.created_at} );
          break;
        case 'old':
          state.filteredProduct.sort(function(a,b){return b.created_at - a.created_at} );
          break;
        case 'highPrice':
          state.filteredProduct.sort(function(a,b){return b.price - a.price} );
          break;
        case 'lowPrice':
          state.filteredProduct.sort(function(a,b){return a.price - b.price} );
          break;
        default:
          state.filteredProduct.sort(function(a,b){return a.created_at - b.created_at} );
          break;
      };
    },
    /*
    *************************************
    *************** pagination***************
    *************************************
    */

    setPagination (state) {
       state.shopPagination = state.filteredProduct.slice(( state.shopCurentPage * state.numberOfProductDisplayed ) - state.numberOfProductDisplayed ,state.shopCurentPage  * state.numberOfProductDisplayed);
    },

    setCurrentPage (state,value) {
      state.shopCurentPage = value;
    },

    prevPage(state) {
      state.shopCurentPage --;
    },

    nextPage (state) {
      state.shopCurentPage++;
    },

    /*
    *************************************
    *************** Sidebar  ***************
    *************************************
    */

    toggleDisplaySidebar (state) {
      state.displaySidebar = !state.displaySidebar;
    },

    /*
    *************************************
    *************** MyProducts***************
    *************************************
    */
    
   setOrdersPagination (state,value) {
      axios.get('/api/admin/getOrdersPagination?page=' + value).then (x => {
        state.ordersPaginate = x.data;
      })
      .catch(err => {
        alert(err.message)
      })
    },

    setUsersPagination (state,value) {
      axios.get('/api/admin/getUsersPagination?page=' + value).then (x => {
        state.usersPaginate = x.data;
      })
      .catch(err => {
        alert(err.message)
      })
    },

    setProductsPagination (state,value) {
      axios.get('/api/admin/getProductsPagination?page=' + value).then (x => {
        state.productsPaginate = x.data;
      })
      .catch(err => {
        alert(err.message)
      })
    },

    updateProductPagination (state,value) {
      let obj = state.productsPaginate.data.find(x => x.id === value.id);
      obj = value;
    }

  },





  getters: {
    /*
    *************************************
    *************** Orders***************
    *************************************
    */
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
    },

    /*
    *************************************
    *************** MyProducts***************
    *************************************
    */

    getMyProducts : state => {
      return state.myProducts;
    },

    getFilteredProduct : state => {
      return state.filteredProduct;
    },

    getPagination : state => {
      return state.shopPagination;
    },

    getProductLength : state => {
      return state.filteredProduct.length;
    },

    getNumberOfPageLength : state => {
      return Math.ceil( state.filteredProduct.length / state.numberOfProductDisplayed );
    },

    getShopCurrentPage : state => {
      return state.shopCurentPage;
    },
    
    getDisplaySidebar : state => {
      return state.displaySidebar;
    },

    /**********************************
    ******    Order    ****************
    ***********************************/

   getOrdersPagination : state => {
      return state.ordersPaginate;
    },

    getUsersPagination : state => {
      return state.usersPaginate;
    },

    getProductsPagination : state => {
      return state.productsPaginate;
    }

  }
});