<template>
  <div class="container-fluid">
    <number-blocks></number-blocks>
  </div>
</template>
<script>
import Nprogress from 'nprogress';
import NumberBlocks from './NumberBlocks.vue';

export default {
  components: { NumberBlocks },
  data() {
    return {
      loading: true,
    };
  },
  mounted() {
    if (this.loading) {
      Nprogress.start();
      Nprogress.set(0.1);
      setTimeout(() => {
          this.loading = false;
          Nprogress.done();
      }, 1000);
    }
  },
};
</script>

<style scoped>
.page-wrapper {
  display: block;
}
</style>
