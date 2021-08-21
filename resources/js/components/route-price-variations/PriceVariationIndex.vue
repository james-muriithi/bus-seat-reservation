<template>
  <div class="mx-2 mx-md-3 mt-2">
    <price-variations-table></price-variations-table>
  </div>
</template>

<script>
import Nprogress from "nprogress";
import PriceVariationsTable from "./PriceVariationsTable.vue";

export default {
  components: { PriceVariationsTable },
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
