<template>
    <div class="dashboard">
        <div>
            <h2>История операций</h2>
        </div>
        <div class="">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Value</th>
                        <th scope="col">Описание</th>
                        <th scope="col">
                            <a @click="sort" href="#" class="link-primary">Дата</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <row-component v-for="item in items" :item="item" :key="item.data"></row-component>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import RowComponent from "./RowComponent";
export default {
  name: "DashboardComponent",
  props: {
    items: {
      required: true,
      type: Array
    }
  },
  data() {
    return {
      filters: {
        created_at: {
          sort: true
        }
      }
    }
  },
  methods: {
    sort() {
      this.filters.created_at.sort = !this.filters.created_at.sort
      let sortType = this.filters.created_at.sort ? 'ASC' : 'DESC'
      this.$emit('sort', sortType)
    }
  },
  components: {
    RowComponent
  }
}
</script>

<style scoped>
.table tr td{
    width: 20%;
}
.dashboard {
    width: 100%;
}
</style>
