<template>
  <div class="mx-2 mx-md-3 mt-2">
    <pickup-points-table></pickup-points-table>
  </div>
</template>

<script>
import Nprogress from "nprogress";
import PickupPointsTable from "./Table.vue";

export default {
  components: { PickupPointsTable },
  data() {
    return {};
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
  methods: {
    openModal() {},
  },
};
</script>
