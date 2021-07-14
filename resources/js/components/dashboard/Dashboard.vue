<template>
  <div class="container-fluid">
    <number-blocks></number-blocks>
  </div>
</template>
<script>
import Nprogress from "nprogress";
import NumberBlocks from "./NumberBlocks.vue";

export default {
  components: { NumberBlocks },
  computed: {
      loading(){
          return this.$store.getters.loading
      }
  },
  mounted() {
    if (this.loading) {
      Nprogress.start();
      Nprogress.set(0.1);
    //   setTimeout(() => {
    //     Nprogress.done();
    //   }, 1000);
    }
  },
};
</script>

<style scoped>
.page-wrapper {
  display: block;
}
</style>
