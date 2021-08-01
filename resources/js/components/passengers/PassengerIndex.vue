<template>
  <div class="mx-2 mx-md-3 mt-2">
    <passenger-table />
  </div>
</template>

<script>
import Nprogress from "nprogress";
const PassengerTable = () => import("./PassengerTable.vue");

export default {
  components: { PassengerTable },
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
