<template>

  <div class="shop-container">
    <div class="shop-filter">
      <div class="product-category" v-for="(filter,filterIndex) in filtered" v-bind:key="filterIndex">
        <h4>{{ filter.title }}</h4>
        <ul v-for="(item,index) in filter.items" v-bind:key="index">
          <li class="category-by-genere" v-on:click="modifyFilter(item)">
           {{item.name}} 
           <transition name="fade">
             <div class="color-green display-inline-block" v-if="item.isFiltered"><i class="fas fa-check"></i></div>
            </transition>
          </li>
        </ul>
      </div>
    </div>

    <div class="shop-view">
      <div class="sort">
        <p class="my-inline-block">ترتیب بر اساس</p>
        <select name="sortProduct" v-model="sortedBy">
          <option value="new">جدیدترین</option>
          <option value="old">قدیمی ترین</option>
          <option value="highPrice">بالا ترین قیمت</option>
          <option value="lowPrice">پایین ترین قیمت</option>
        </select>
      </div>
      <div class="product-container">
        <productsComponent v-for="product in Pagination" v-bind:key="product.id" :Product="product"></productsComponent>
      </div>
      <div class="pagination">
        <paginationComponent @clickPage="changePage" @prevPage="prevPage" @nextPage="nextPage"  ></paginationComponent>
      </div>
    </div>
  </div>
</template>
<script>
import productsComponent from '../components/Product'
import paginationComponent from '../components/Pagination'

export default {
  name:'Shop',
  components: {
    productsComponent,
    paginationComponent
  },
  data () {
    return { 
      filterThis: [],
      filters: [
        {
          id: 0,
          title: 'دسته بندی ها',
          field:'category',
          items:[
            {
              itemID:0,
              name: 'مردان',
              fieldName: 'men',
              isFiltered: false
            },
            {
              itemID:1,
              name: 'زنان',
              fieldName: 'womens',
              isFiltered: false
            },
            {
              itemID:2,
              name: 'بچه ها',
              fieldName: 'child',
              isFiltered: false
            }
          ]
        },
        {
          id: 1,
          title: 'سایز',
          field:'size',
          items:[
            {
              'itemID':0,
              'name': 'بزرگ',
              'fieldName': 'large',
              'isFiltered': false
            },
            {
              itemID:1,
              name: 'متوسط',
              fieldName: 'medium',
              isFiltered: false
            },
            {
              itemID:2,
              name: 'کوچک',
              fieldName: 'small',
              isFiltered: false
            }
          ]
        }
      ],
      sortedBy:'new'
    }
  },
  
  methods: {
    changePage (value) {
      this.$store.commit('setCurrentPage',value);
    },
    prevPage () {
      if ( this.$store.getters.getShopCurrentPage > 1 ) {
        this.$store.commit('prevPage');
      }
    },
    nextPage () {
      if ( this.$store.getters.getShopCurrentPage < this.$store.getters.getNumberOfPageLength ) {
        this.$store.commit('nextPage');
      }
    },

    
    modifyFilter (objValue) {
      this.filterThis = [];
      this.$store.commit('setFilteredProductNone');
      objValue.isFiltered = !objValue.isFiltered;
      
      for (let i=0;i < this.filters.length;i++){
        let myFieldName = this.filters[i].field, myItems =[];

        for (let j=0;j < this.filters[i].items.length;j++){
          if(this.filters[i].items[j].isFiltered){
            myItems.push(this.filters[i].items[j].fieldName);
          }
        }
        if (myItems.length !== 0){
          this.filterThis.push({
          fieldName : myFieldName,
          items : myItems
          });
        }
        
      }

      this.Products.forEach(product => {
        if (this.matchesFilter(product)){
          this.$store.commit('pushIntoFilteredProduct',product);
        }
      });
      this.changePage(1);

    },

    matchesFilter (item) {
    let count = 0
    for (var n = 0; n < this.filterThis.length; n++) {
      if (this.filterThis[n].items.indexOf(item[this.filterThis[n].fieldName]) > -1) {
        count++;
      }
    }
    // If TRUE, then the current item in the array meets all the filter criteria
    return count == this.filterThis.length;
    },

  },


  created () {
    this.$store.commit('setMyProducts');
  },
  
  computed: {
    Pagination () {
      this.$store.commit('setPagination');
      return this.$store.getters.getPagination;
    },

    filtered () {
      return this.filters;
    },
    Products () {
      return this.$store.getters.getMyProducts;
    }
  },
  watch: {
    sortedBy:function(val) {
      this.$store.commit('sortProducts', val)
    }
  }
}
</script>

<style>

.shop-container {
  display: flex;
  flex-direction: row;
}

.shop-view {
  display: flex;
  flex-direction: column;
  margin: 0rem 1rem 1rem 1rem;
  flex-grow: 1;
}


.sort {
  border: 1px solid #ebebeb;
  margin-bottom: 1.5rem;
  padding: 0.8rem;
}

.sort select {
  font-size: 1.2rem;
  padding: 0.2rem;
  outline: none;
  -webkit-transition: all 0.5s ease-out 0s;
  transition: all 0.5s ease-out 0s;
}

.product-container {
  display: flex;
  flex-flow: row wrap;
  justify-content: center;
  align-items: baseline;
}

.shop-filter {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;
  margin: 0rem 1.5rem;
}

.product-category {
  border: 1px solid #ebebeb;
  padding: 0.5rem 1rem 0.5rem 0;
  width: 15rem;
  border-radius: 10px;
  margin-bottom: 2rem;
}
.product-category h4
{
  padding: 1rem 0;
}

.product-category ul li {
  padding: 0.5rem 0;
}

.pagination {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: baseline;
  border: 1px solid rgba(20, 20, 20, 0.2);
}

.category-by-genere:hover{
  cursor: pointer;
  color: #f1ac06;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
