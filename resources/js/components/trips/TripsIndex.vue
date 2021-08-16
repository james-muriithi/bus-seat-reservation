<template>
  <div class="mx-2 mx-md-3 mt-2">
    <trips-table />
  </div>
</template>

<script>
import Nprogress from "nprogress";
const TripsTable = () => import("./TripsTable.vue");

export default {
  components: { TripsTable },
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
