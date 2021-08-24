<template>
  <div class="mx-2 mx-md-3">
    <number-blocks></number-blocks>
    <middle-section></middle-section>
    <div class="mt-2">
      <h2>Latest Reservations</h2>
      <booking-table></booking-table>
    </div>
    <div class="mt-2">
      <h2>Today Trips</h2>
      <trips-table :filters="{ travel_date: today }"></trips-table>
    </div>
  </div>
</template>
<script>
import Nprogress from "nprogress";
import NumberBlocks from "./NumberBlocks.vue";
const MiddleSection = () => import("./MiddleSection.vue");
const BookingTable = () => import("../booking/BookingTable.vue");
const TripsTable = () => import("../trips/TripsTable.vue");

export default {
  components: { NumberBlocks, MiddleSection, BookingTable, TripsTable },
  computed: {
    loading() {
      return this.$store.getters.loading;
    },
    today() {
      return moment().format("YYYY-MM-DD");
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
