<template>
  <ul class="pagination-ul">
    <li class="pagination-prev" @click="prevPage" v-if="showPrev">قبلی</li>
    <li v-for="page in Pages" v-bind:key="page.name" @click="goPage(page.name)" :class="page.isDisabled">{{ page.name }}</li>
    <li class="pagination-next" @click="nextPage" v-if="showNext">بعدی</li>
  </ul>
</template>

<script>
export default {
  name:'Pagination',
  props: {
    maxVisibleButtons: {
      type: Number,
      required: false,
      default: 3
    },
    totalPages: {
      type: Number,
      required: true
    },
    total: {
      type: Number,
      required: true
    },
    currentPage: {
      type: Number,
      required: true
    }
  },
  computed: {
    Pages () {
      var range = [];
      if (this.currentPage > 1) {
        range.push({
          name: this.currentPage - 1,
          isDisabled: 'enable-paginate-page'
        });
      }

      for (let i = this.currentPage ;i <= (this.maxVisibleButtons + this.currentPage);i++) {
        if (i > this.totalPages) {
          break;
        }
        range.push({
          name: i,
          isDisabled: i === this.currentPage ? 'disable-paginate-page' : 'enable-paginate-page'
        });
      }
      return range;
    },
    showPrev () {
      if (this.currentPage === 1) {
        return false;
      }
      return true;
    },
    showNext () {
      if (this.currentPage === this.totalPages) {
        return false;
      }
      return true;
    }
  },
  methods: {
    goPage (value) {
      this.$emit('clickPage',value);
    },
    prevPage () {
      this.$emit('prevPage');
    },
    nextPage () {
      this.$emit('nextPage');
    },
  }
};
</script>

<style>
.pagination-ul {
  display: flex;
  flex-direction: row;
  padding: 0.5rem;
}
.pagination-ul li{
  margin: 0 0.5rem;
  padding: 0.5rem 0.6rem;
  cursor: pointer;
}
.enable-paginate-page{
  border: 1px solid rgba(0, 0, 0, 0.1);
}
.enable-paginate-page:hover {
  background-color: #f1ac06;
  color: #fff;
}
.pagination-prev{
  background-color: #FF5733;
  color: #fff;
}
.pagination-next{
  background-color: #FF5733;
  color: #fff;
}
.disable-paginate-page{
  color:#f1ac06;
  border: 1px solid #f1ac06;
}
.disable-paginate-page:hover{
  background-color: #fff;
  color:#f1ac06;
}
</style>