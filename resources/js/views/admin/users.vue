<template>
  <div class="myTable-panel">
    <h4>لیست سفارشات</h4>
    <div>
      <table class="myTable">
        <thead>
          <tr>
            <th>
              نام
            </th>
            <th>
              ایمیل
            </th>
            <th>
              دسترسی
            </th>
            <th>
              تاریخ عضویت
            </th>
            <th>
              اخرین اپدیت پروفایل
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" v-bind:key="user.id">
            <td> {{ user.name }} </td>
            <td> {{ user.email }} </td>
            <td> {{ user_role ( user.role ) }} </td>
            <td> {{ user.created_at }} </td>
            <td> {{ user.updated_at }} </td>
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
name:'usersTable',
  data () {
    return {}
  },
  methods: {

    user_role (value) {
      if (value === 1) {
        return 'کاربر'
      }
      else {
        return 'ادمین'
      }
    },

    goPage (val) {
      this.$store.commit('setUsersPagination', val );
    },

    nextPage () {
      if (this.current_page < this.last_page) {
        this.$store.commit('setUsersPagination', this.current_page + 1);
      }
      else {
        alert('this is last page');
      }
    },

    prevPage () {
      if (this.current_page > 1) {
        this.$store.commit('setUsersPagination', this.current_page - 1);
      }
      else {
        alert('this is first page');
      }
    }
  },

  created () {
    this.$store.commit('setUsersPagination', 1);
  },

  computed: {
    usersPagination () {
      return this.$store.getters.getUsersPagination;
    },

    users () {
      return this.usersPagination.data;
    },

    current_page () {
      return this.usersPagination.current_page;
    },

    last_page () {
      return this.usersPagination.last_page;
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

</style>