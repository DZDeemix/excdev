<template>
    <div class="container">
        <div class="d-flex justify-content-between mb-3 mt-5">
            <div>
                <search-component v-model="search"></search-component>
            </div>
            <div>
                <a :href="link" class="link-primary">Главная</a>
            </div>
        </div>
        <DashboardComponent :items="transactions" v-on:sort="setSortDirection($event)"></DashboardComponent>
    </div>
</template>

<script>
import DashboardComponent from "./DashboardComponent";
import SearchComponent from "./SearchComponent";

export default {
  name: "TransactionComponent",
  props: {
    link: String
  },
  data() {
    return {
      transactions: [],
      sortBy: 'created_at',
      sortDirection: 'ASC',
      search: ''
    }
  },
  components: {
    DashboardComponent,
    SearchComponent
  },
  watch: {
    search: function () {
      this.getTransactions()
    },
    sortDirection: function () {
      this.getTransactions()
    }
  },
  methods: {
    getTransactions() {
      let payload = {
        sortBy: this.sortBy,
        sortDirection: this.sortDirection,
        search: this.search,
      }
      axios.get('/transactions', { params: payload })
        .then((response)=>{
          this.transactions = response.data
        })
        .catch((response) => {
          console.log(response)
        })
    },
    setSortDirection(e){
      this.sortDirection = e
    },
  },
  created() {
    this.getTransactions()
  }
}
</script>

<style scoped>

</style>
