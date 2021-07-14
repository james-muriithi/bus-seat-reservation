<template>
  <div></div>
</template>

<script>
import Nprogress from 'nprogress'
import 'nprogress/nprogress.css';

export default {
  props: {
    show: {
      type: Boolean,
      default: false,
    },
  },

};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s;
}

.fade-enter,
.fade-leave-to
/* .fade-leave-active in <2.1.8 */ {
  opacity: 0;
}
</style>
