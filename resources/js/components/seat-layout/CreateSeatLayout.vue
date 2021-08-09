<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>
    <div v-else></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isLoading: false,
    };
  },
};
</script>
