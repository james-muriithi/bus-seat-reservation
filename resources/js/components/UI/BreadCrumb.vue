<template>
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-7 align-self-center">
        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1" v-if="title">
          {{ title }}
        </h3>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li :class="`breadcrumb-item ${item.current ? 'text-muted active': '' }`" v-for="item in items" :key="item.title">
                <a :href=" item.url || '#'" v-if="!item.current">{{ item.title }}</a>
                <span v-else>{{ item.title }}</span>
              </li>
            </ol>
          </nav>
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
      default: null,
    },
    items: {
      type: Array,
      default: () => [],
    },
  },
};
</script>

<style scoped>
.page-breadcrumb .breadcrumb .breadcrumb-item+.breadcrumb-item::before {
    float: none;
}
</style>
