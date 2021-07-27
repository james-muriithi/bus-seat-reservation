<template>
  <div class="mx-2 mx-md-3 mt-2">
    <amenities-table></amenities-table>
  </div>
</template>

<script>
import Nprogress from "nprogress";
import AmenitiesTable from "./Table.vue";

export default {
  components: { AmenitiesTable },
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
