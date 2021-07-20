<template>
  <div class="container-fluid">
    <number-blocks></number-blocks>
    <booking-index></booking-index>
  </div>
</template>
<script>
import Nprogress from "nprogress";
import NumberBlocks from "./NumberBlocks.vue";
import BookingIndex from "../booking/BookingIndex.vue";

export default {
  components: { NumberBlocks, BookingIndex },
  computed: {
    loading() {
      return this.$store.getters.loading;
    },
  },
  watch: {
    loading() {
      if (this.loading) {
        Nprogress.start();
        Nprogress.set(0.1);
      } else {
        Nprogress.done();
      }
    },
  },
};
</script>

<style scoped>
.page-wrapper {
  display: block;
}
</style>
