<template>
  <div class="card-group row">
    <number-block-card
      v-for="block in data.blocks"
      :key="block.title"
      class="col-md-3 col-sm-6 col-12"
      :title="block.title"
      :number="block.number"
      :icon="block.icon"
    ></number-block-card>
  </div>
</template>

<script>
// import axios from 'axios'
import NumberBlockCard from "./NumberBlock.vue";
export default {
  components: {
    NumberBlockCard,
  },
  data() {
    return {
      data: [],
    };
  },
  methods: {
    getData() {
      this.$store.dispatch("startLoading");
      const url = window.location.href.split(/[?#]/)[0];
      window.axios.get(url).then((res) => {
        this.data = res.data;
        // setTimeout(() => {
        //   this.$store.dispatch("stopLoading");
        // }, 1500);
      });
    },
  },
  created() {
    this.getData();
  },
};
</script>
