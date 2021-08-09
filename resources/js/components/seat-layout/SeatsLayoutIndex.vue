<template>
  <div class="mx-2 mx-md-3 mt-2">
      <create-seat-layout />
  </div>
</template>

<script>
import Nprogress from "nprogress";
const CreateSeatLayout = () => import("./CreateSeatLayout.vue");

export default {
  components: { CreateSeatLayout },
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
