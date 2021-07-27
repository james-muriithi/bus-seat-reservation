<template>
  <div class="mx-2 mx-md-3 mt-2">
    <bus-type-table></bus-type-table>
  </div>
</template>

<script>
import Nprogress from "nprogress";
import BusTypeTable from "./Table.vue";

export default {
  components: { BusTypeTable },
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
