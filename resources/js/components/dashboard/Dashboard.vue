<template>
  <div class="mx-2 mx-md-3">
    <number-blocks></number-blocks>
    <middle-section></middle-section>
    <booking-index></booking-index>
  </div>
</template>
<script>
import Nprogress from "nprogress";
import NumberBlocks from "./NumberBlocks.vue";
const MiddleSection = () => import("./MiddleSection.vue");
const BookingTable = () => import("../booking/BookingTable.vue");
// import MiddleSection from './MiddleSection.vue';

export default {
  components: { NumberBlocks, MiddleSection, BookingTable },
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
