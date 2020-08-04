<template>
  <div class="myTable-panel">
    <h4>لیست سفارشات</h4>
    <div>
      <table class="myTable">
        <thead>
          <tr>
            <th>
              محصول
            </th>
            <th>
              نام محصول
            </th>
            <th>
              سفارش دهنده
            </th>
            <th>
              قیمت
            </th>
            <th>
              ادرس سفارش دهنده
            </th>
            <th>
              وضعیت
            </th>
            <th>
              تاریخ سفارش
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders" v-bind:key="order.id">
            <td><img class="icon-size-5 rounded" :src="'/' + order.product.image  + '.jpg'"></td>
            <td> {{ order.product.name }} </td>
            <td> {{ order.user.email }} </td>
            <td> {{ order.product.price }} </td>
            <td> {{ order.address }} </td>
            <td> {{ deliver_status(order.is_delivered) }} </td>
            <td> {{ order.created_at }} </td>
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
export default {
  name:'orderTable',
  data () {
    return {}
  },
  methods: {

    deliver_status (value) {
      if (value === 1) {
        return 'ارسال شده'
      }
      else {
        return 'انتظار'
      }
    },

    goPage (val) {
      this.$store.commit('setOrdersPagination', val );
    },

    nextPage () {
      if (this.current_page < this.last_page) {
        this.$store.commit('setOrdersPagination', this.current_page + 1);
      }
      else {
        alert('this is last page');
      }
    },

    prevPage () {
      if (this.current_page > 1) {
        this.$store.commit('setOrdersPagination', this.current_page - 1);
      }
      else {
        alert('this is first page');
      }
    }
  },

  created () {
    this.$store.commit('setOrdersPagination', 1);
  },

  computed: {
    ordersPagination () {
      return this.$store.getters.getOrdersPagination;
    },

    orders () {
      return this.ordersPagination.data;
    },

    current_page () {
      return this.ordersPagination.current_page;
    },

    last_page () {
      return this.ordersPagination.last_page;
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

  }
}
</script>

<style>

.myTable-panel {
  border-radius: .25rem;
  border: 1px solid #eceff5;
  font-size: 20px;
}


.myTable-panel h4 {
  margin : 2rem 1rem;
}

.myTable {
  width: 100%;
  border-collapse: collapse;
}

.myTable thead tr th{
  padding: 10px 15px;
  vertical-align: bottom;
  font-family: Lato-Bold;
  font-size: 16px;
  color: #fff;
  line-height: 1.4;
  background-color: #6c7ae0;
}

.myTable tbody {
  text-align: center;
}

.myTable tbody tr:nth-child(even) {
  background-color: #f8f6ff;
}

.myTable tbody tr td {
  max-width: 150px;
  height: 80px;
  overflow: hidden;
}


a {
  -webkit-transition: all .2s linear;
  -moz-transition: all .2s linear;
  transition: all .2s linear;
}

.table-pagination {
  display: block;
  margin-top: 1em;
  padding-top: 1em;
}


.table-pagination ul li {
  border-top-color: #282828;
  border-bottom-color: #282828;
}

.table-pagination  li:before,
.table-pagination  .active:after,
.table-pagination  .active:before,
.table-pagination  .active ~ li:before {
  border-left-color: #282828;
  border-right-color: #282828;
}

.table-pagination  a {
  color: #888;
  font-family: "Edmondsans";
  font-size: 15px;
  font-weight: bold;
  text-decoration: none;
}

.table-pagination  .active a { color: #ccc;  }
.table-pagination  .disabled a,
.table-pagination  .disabled:hover a { color: #333; cursor: default;  }
.table-pagination  li:hover a { color: #c9282d; }

.table-pagination { text-align: center; }
.table-pagination ul {
  display: inline-block;
  list-style-type: none;
  margin: 0;
  padding: 0;
  text-align: center;
}

.table-pagination li {
  border-right:10px solid transparent;
  border-bottom-width: 17px;
  border-top-width: 17px;
  border-style: solid;
 
  transform:rotate(360deg);
  border-left: 0;
  height: 0;
  float: left;
  margin-right: 3px;
  position: relative;
}
.table-pagination li:before {
  border-bottom-color: transparent;
  border-left-color: transparent;
  border-top-color: transparent;
  border-width: 17px 10px 17px 0;
  border-style: solid;
  position: absolute;
  content: '';
  left: -10px;
  height: 0px;
  top: -17px;
  width: 0px;
}
.table-pagination .active ~ li:before {
  border-bottom-color: transparent;
  border-top-color: transparent;
  border-width: 17px 0 17px 10px;
  right: -10px;
  left: auto;
}
.table-pagination .active ~ li {
  border-left:10px solid transparent;
  border-right: 0;
}
.table-pagination .active  {
  border-right: 0;
  border-left: 0;
}
.table-pagination .active:after,
.table-pagination .active:before {
  border-bottom-color: transparent;
  border-top-color: transparent;
  border-width: 17px 10px 17px 0;
  border-style: solid;
  position: absolute;
  content: '';
  height: 0px;
  width: 0px;
  top: -17px;
  left: -10px;
}
.table-pagination .active:after {
  border-bottom-color: transparent;
  border-right-color: transparent;
  border-top-color: transparent;
  border-width: 17px 0 17px 10px;
  left: 100%;
}
.table-pagination a {
  line-height: 36px;
  margin-top: -17px;
  display: block;
  height: 34px;
  width: 30px;
}
.table-pagination .prev {
  -webkit-border-radius: 20px 0 0 20px;
  -moz-border-radius: 20px 0 0 20px;
  border-radius: 20px 0 0 20px;
}
.table-pagination .next {
  -webkit-border-radius: 0 20px 20px 0;
  -moz-border-radius: 0 20px 20px 0;
  border-radius: 0 20px 20px 0;
  border-right: 0;
}
.table-pagination .prev a,
.table-pagination .next a {
  text-indent: -4px;
  line-height: 38px;
  font-size: 30px;
}
.table-pagination .prev a { text-indent: 4px; }
.table-pagination .prev:before,
.table-pagination .next:before { content: none; }

</style>