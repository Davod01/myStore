<template>
  <div>
    <h1>پنل مدیریت</h1>
    <div class="Dash-panel-container">
      <div class="big-panel">
        <div class="my-panel">
          <h2 v-on:click="chartUpdate">درامد</h2>
          <div>مجموع درامد 8950430 ریال</div>
          <Bar-chart  :options="chartoptions" v-on:update="chartUpdate"></Bar-chart>
        </div>
      </div>
      <div class="small-panel">
        <div class="my-panel">
          <div class="panel-pic">
            <img src="/svg/witness.svg" class="icon-size-4" alt="online vistor">
          </div>
          <div class="panel-info">
            <div>{{onlineVisits}}</div>
            <div>بازدید کندگان انلاین</div>
          </div>
        </div>
        <div class="my-panel">
          <div class="panel-pic">
            <img src="/svg/visitors.svg" class="icon-size-4" alt="today visits">
          </div>
          <div class="panel-info">
            <div>{{toDayVisits}}</div>
            <div>بازدیدکنندگان امروز</div>
          </div>
        </div>
        <div class="my-panel">
          <div class="panel-pic">
            <img src="/svg/visitors.svg" class="icon-size-4" alt="profile icon">
          </div>
          <div class="panel-info">
            <div>{{monthVisits}}</div>
            <div>بازدیدکنندگان این ماه</div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <orderTable></orderTable>
    </div>
    
  </div>
  
</template>

<script>
import BarChart  from '../components/charts/barChart'
import orderTable from '../components/orderTable'

export default {

  components: {
    BarChart,
    orderTable
  },

  name:"dashboard",
  data () {
    return{
      onlineVisits : '',

      toDayVisits : '',

      monthVisits : '',

      chartoptions: {
        responsive: true,
        maintainAspectRatio: false,
      },
    }
  },
  mounted () {
    
  },
  computed: {
  },

  created () {

    axios.get('/api/admin/getStatics').then (x => {
        this.onlineVisits = x.data[0];
        this.toDayVisits = x.data[1];
        this.monthVisits = x.data[2];
      })
      .catch(err => {
        alert(err.message)
    });
    
  },
  methods: {
    chartUpdate () {
      console.log('update')
    }
  }
}
</script>

<style>
  h1 {
    margin: 0.5rem 0 1rem 0;
  }
  .Dash-panel-container {
    display: flex;
    flex-direction: row;
  }

  .big-panel {
    width: 75%;
  }
  .big-panel .my-panel {
    height: 100%;
  }

  .small-panel {
    width: 20%;
  }

  .small-panel .my-panel{
    margin: 0rem 1rem 1rem 1rem;
    width: 100%;
    height: 5rem;
    display: flex;
    flex-direction: row;
    align-items: center;
  }
  .small-panel .my-panel:last-child {
    margin-bottom: 0;
  }

  .my-panel {
    border-radius: .25rem;
    border: 1px solid #eceff5;
    flex-grow: 1;
  }

  .panel-info {
    flex-grow: 1;
    margin-right: 0.5rem;
  }

  .panel-info div {
    text-align: center;
  }

  .panel-info div:last-child {
    color: #a4abc5 !important;
    font-size: 10px;
  }

  .panel-pic {
    padding: 0 1rem;
  }

#bar-chart{
  width: 100% !important;
  height: 70vh !important;
}


.orders-panel h4 {
  margin: 1rem;
  color: #303e67;
  letter-spacing: .02em;
  text-shadow: 0 0 1px rgba(241,245,250,.1);
}

</style>