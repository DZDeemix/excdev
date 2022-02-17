<template>
    <div class="container">
        <div class="d-flex justify-content-between mb-3 mt-5" style="width: 100%">
            <div>
                <h4>Пользователь: {{user.name}}</h4>
                <h4>Баланс: {{balance.value}}</h4>
            </div>
            <div>
                <h4>Счетчик запросов: {{counter}}</h4>
                <a :href="link" class="link-primary">Все транзакции</a>
            </div>
        </div>
        <DashboardComponent :items="transactions"></DashboardComponent>
    </div>
</template>

<script>
import DashboardComponent from "./DashboardComponent";
import SearchComponent from "./SearchComponent";
export default {
  props: {
    link: String
  },
  name: "UserComponent",
  data() {
    return {
      user: {},
      balance: 0,
      transactions: [],
      counter: 0
    }
  },
  components: {
    DashboardComponent,
    SearchComponent
  },
  methods: {
    getTransactions() {
      let payload = {
        limit: 5,
      }
      axios.get('/user/transactions', {params: payload})
        .then((response)=>{
          console.log(response.data)
          this.user = response.data
          this.balance = response.data.balance
          this.transactions = response.data.balance.transactions
          this.counter++
        })
        .catch((response) => {
          console.log(response)
        })
    },
    startTimer() {
      this.interval = window.setInterval(() => {
        this.getTransactions()
      }, 5000)
    }
  },
  created() {
    this.getTransactions()
    this.startTimer()
  }

}
</script>

<style scoped>

</style>
