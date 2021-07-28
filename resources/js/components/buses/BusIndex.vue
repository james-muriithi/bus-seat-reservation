<template>
  <div class="mx-2 mx-md-3 mt-2">
    <bus-table />
  </div>
</template>

<script>
import Nprogress from "nprogress";
const BusTable = () => import("./BusTable.vue");

export default {
  components: { BusTable },
  computed: {
    loading() {
      return this.$store.getters.loading;
    },
  },
  watch: {
    loading(newValue) {
      if (newValue) {
        Nprogress.start();
        Nprogress.set(0.1);
      } else {
        Nprogress.done();
      }
    },
  },
};
</script>
