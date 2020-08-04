<template>
  <div class="dashboard-orders">
    <orderTable></orderTable>
  </div>
</template>

<script>
import orderTable from '../../components/orderTable'

export default {
  name: 'orders',
  components: {
    orderTable
  }
}
</script>

<style scoped>

.dashboard-orders {
  min-height: 100%;
  min-width: 100%;
}

</style>