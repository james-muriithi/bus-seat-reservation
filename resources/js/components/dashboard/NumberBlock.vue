<template>
  <div class="card border-right">
    <div class="card-body">
      <div class="d-flex d-lg-flex d-md-block align-items-center">
        <div>
          <div class="d-inline-flex align-items-center">
            <h2 class="text-dark mb-1 font-weight-medium">{{ formatNumber(number) }}</h2>
            <!-- d-lg-block d-md-none d-sm-block -->
            <span
              class="
                badge
                bg-primary
                font-12
                text-white
                font-weight-medium
                badge-pill
                ml-2
                d-none
              "
              >+18.33%</span
            >
          </div>
          <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
            {{ title }}
          </h6>
        </div>
        <div class="ml-auto mt-md-3 mt-lg-0">
          <span class="opacity-7 text-muted icon" v-html="icon"></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    number: {
      required: true,
    },
    icon: {
      type: String,
      default: "",
    },
  },
};
</script>

<style scoped>
.card {
  margin-right: 10px;
}

span.icon {
  font-size: 24px!important;
}
</style>
