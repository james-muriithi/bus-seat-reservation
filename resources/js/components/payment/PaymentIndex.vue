<template>
  <div class="mx-2 mx-md-3 mt-2">
    <payment-table></payment-table>
  </div>
</template>

<script>
import Nprogress from "nprogress";
import PaymentTable from "./PaymentTable";

export default {
  components: { PaymentTable },
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
