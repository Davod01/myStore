<template>
    <div class="myTable-panel">
      <crudModal :showModal="showModal" @hideModal="hideModal" :crudData="crudData" :crudModalUpdate ="crudModalUpdate" @DataChange="DataChange"></crudModal>
    <h4>لیست سفارشات</h4>
    <div>
      <table class="myTable">
        <thead>
          <tr>
            <th></th>
            <th>
              نام محصول
            </th>
            <th>
              توضیحات
            </th>
            <th>
              تعداد  
            </th>
            <th>
              قیمت  
            </th>
            <th>
              تاریخ
            </th>
            <th id="new-Product" @click="modal_CrDisplayed()"><div>create new</div></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product,index) in products" v-bind:key="index">
            <td><img class="icon-size-5 rounded" :src="'/' + product.image  + '.jpg'"></td>
            <td> {{ product.name }} </td>
            <td > {{ product.description.slice(0,20) }}... </td>
            <td> {{ product.units }} </td>
            <td> {{ product.price }} </td>
            <td> {{ product.created_at }} </td>
            <td> <img class="icon-size-3 mHover-yellow half-margin-x" src="/svg/edit.svg" @click="modal_UpDisplayed(product)"> <img class="icon-size-3 mHover-red half-margin-x" src="/svg/trash.svg" @click="delete_product(product,index)" ></td>
          </tr>
        </tbody>
      </table>
      <div class="table-pagination">
        <ul>
          <li class="prev" @click.prevent="prevPage" v-bind:class="{ 'disabled': current_page <= 1 }"><a href="#">&gt;</a></li>
          <li v-for="page in Pages" v-bind:key="page.name" @click.prevent="goPage(page.name)" :class="page.isDisabled"><a href="#">{{ page.name }}</a></li>
          <li class="next" @click.prevent="nextPage" v-bind:class="{ 'disabled': current_page >= last_page }"><a href="#">&lt;</a></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import crudModal from '../../components/crudModal';

export default {
 name:'productsTable',

 components: {
   crudModal,
 },

  data () {
    return {
      showModal: false,
      crudModalUpdate : false,
      crudData: {},
    }
  },

  methods: {

    modal_UpDisplayed (val) {
      this.crudData = val
      this.crudModalUpdate = true;
      this.cumShowModal = true ;
    },

    DataChange (value) {
      let obj = this.products.find(x => x.id === value.id);
      obj = value;
      console.log(obj);
      console.log(value);
    },

    modal_CrDisplayed () {
      this.crudModalUpdate = false;
      this.cumShowModal = true ;
    },

    hideModal () {
      this.crudModalUpdate = false;
      this.cumShowModal = false ;
    },

    delete_product (product,index) {
      if( confirm("از حذف محصول اطمینان دارید") ) {
        axios.post("/api/admin/deleteProduct",{
          'productID': product.id
        }).then( response => {
          alert('حذف موفقیت امیز بود');
          this.products.splice(index,1);
        })
        .catch( error => {
          console.log(error)
        })
      };

    },

    goPage (val) {
      this.$store.commit('setProductsPagination', val );
    },

    nextPage () {
      if (this.current_page < this.last_page) {
        this.$store.commit('setProductsPagination', this.current_page + 1);
      }
      else {
        alert('this is last page');
      }
    },

    prevPage () {
      if (this.current_page > 1) {
        this.$store.commit('setProductsPagination', this.current_page - 1);
      }
      else {
        alert('this is first page');
      }
    }
  },

  created () {
    this.$store.commit('setProductsPagination', 1);
  },

  computed: {

    productsPagination () {
      return this.$store.getters.getProductsPagination;
    },

    products () {
      return this.productsPagination.data;
    },

    current_page () {
      return this.productsPagination.current_page;
    },

    last_page () {
      return this.productsPagination.last_page;
    },

     Pages () {
      var range = [];
      if (this.current_page > 1) {
        range.push({
          name: 1,
          isDisabled: 'enable-paginate-page'
        });
      }

      for (let i = this.current_page ;i <= ( this.current_page + 3 );i++) {
        if (i > this.last_page ) {
          break;
        }
        range.push({
          name: i,
          isDisabled: i === this.current_page ? 'active' : ''
        });
      }
      return range;
    },

    cumShowModal: {
      get () {
        return this.showModal;
      },
      set (val) {
        this.showModal = val;
      }
    }

  }
}
</script>

<style>
#new-Product {
  background-color: aqua;
  cursor: pointer;
}
</style>