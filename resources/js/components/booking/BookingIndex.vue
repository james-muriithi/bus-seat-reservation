<template>
  <div class="mx-2 mx-md-3 mt-2">
      <booking-table :limit="limit" />
  </div>
</template>

<script>
import Nprogress from "nprogress";
import BookingTable from "./BookingTable.vue";
export default {
  components: { BookingTable },
  props: {
    limit: {
      type: Number,
      default: null,
    },
  },
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
