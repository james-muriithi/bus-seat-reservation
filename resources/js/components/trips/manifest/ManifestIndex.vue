<template>
  <div class="mx-2 mx-md-3 mt-2">
    <manifest-table :trip_id="1" />
  </div>
</template>

<script>
import Nprogress from "nprogress";
const ManifestTable = () => import("./ManifestTable.vue");

export default {
  components: { ManifestTable },
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
