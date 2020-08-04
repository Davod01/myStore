<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  props: ['chartdata', 'options'],
  mounted () {
    console.log(this.$refs.canvas)
    this.renderChart(this.chartdata, this.options)
  }
}
</script>

<style>
</style>