<template>
  <div class="mx-2 mx-md-3 mt-2">
    <edit-system-settings :settings="settings"></edit-system-settings>
  </div>
</template>

<script>
import Nprogress from "nprogress";
const EditSystemSettings = () => import("./EditSystemSettings.vue");

export default {
  components: { EditSystemSettings },
  props: {
      settings: {
          type: Object,
          required: true,
      }
  },
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
