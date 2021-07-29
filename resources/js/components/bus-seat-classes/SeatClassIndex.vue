<template>
  <div class="mx-2 mx-md-3 mt-2">
    <seat-classes-table></seat-classes-table>
  </div>
</template>

<script>
import Nprogress from "nprogress";
import SeatClassesTable from "./Table.vue";

export default {
  components: { SeatClassesTable },
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
