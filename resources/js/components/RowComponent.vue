<template>
    <tr>
        <th scope="row">{{ item.id }}</th>
        <td>{{item.value}}</td>
        <td>{{item.description}}</td>
        <td>{{item.created_at}}</td>
    </tr>
</template>

<script>
export default {
  name: "DashBoardRowComponent",
  props: {
    item: {
      type: Array,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
