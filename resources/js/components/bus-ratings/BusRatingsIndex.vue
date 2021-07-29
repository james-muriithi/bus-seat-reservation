<template>
  <div class="mx-2 mx-md-3 mt-2">
    <ratings-table></ratings-table>
  </div>
</template>

<script>
import Nprogress from "nprogress";
import RatingsTable from "./Table.vue";

export default {
  components: { RatingsTable },
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
};
</script>
