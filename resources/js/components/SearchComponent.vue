<template>
    <div class="input-group">
        <div class="form-outline">
            <input v-model="text" type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </div>
    </div>
</template>

<script>
export default {
  name: "SearchComponent",
  props: {
    search: String
  },
  computed: {
    text: {
      get() {
        return this.search;
      },
      set(val) {
        this.$emit('input', val);
      }
    }
  }
}
</script>

<style scoped>

</style>
