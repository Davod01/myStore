import { Bar, mixins } from 'vue-chartjs'
const { reactiveData } = mixins

export default {
  extends: Bar,
  mixins: [reactiveData],
  props: ['options'],
  data () {
    return{
      chartData:{
        labels:  ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets:[
          {
            label: '',
            backgroundColor: '',
            data: [0,0,0,0,0,0,0,0,0,0,0,0]
          }
        ]
      }
    }
  },
  mounted () {
    // this.chartData is created in the mixin.
    // If you want to pass options please create a local options object
    this.renderChart(this.chartData, this.options);
  },

  created () {
    axios.get('/api/admin/getOrderDataChart').then (x => {
        this.chartData.datasets[0].label = x.data.chartName;
        this.chartData.datasets[0].backgroundColor = x.data.backgroundColor;

        this.setChartDataSet(x.data.datasets);
      })
      .catch(err => {
        console.log(err)
    });
  },
  watch: {
    chartData () {
      this.$data._chart.update()
    }
  },

  methods: {
    
    setChartDataSet (value) {
      value.forEach(x => {
        let month = x.created_at.slice(5,7);
        switch(month) {
          case '01':
            this.chartData.datasets[0].data[0]++;
            break;
          case '02':
            this.chartData.datasets[0].data[1]++;
            break;
          case '03':
            this.chartData.datasets[0].data[2]++;
            break;
          case '04':
            this.chartData.datasets[0].data[3]++;
            break;
          case '05':
            this.chartData.datasets[0].data[4]++;
            break;
          case '06':
            this.chartData.datasets[0].data[5]++;
            break;
          case '07':
            this.chartData.datasets[0].data[6]++;
            break;
          case '08':
            this.chartData.datasets[0].data[7]++;
            break;
          case '09':
            this.chartData.datasets[0].data[8]++;
            break;
          case '10':
            this.chartData.datasets[0].data[9]++;
            break;
          case '11':
            this.chartData.datasets[0].data[10]++;
            break;
          case '12':
            this.chartData.datasets[0].data[11]++;
            break;
          default:
            alert('some data is wrong');
        }
      });
    }
  }
}