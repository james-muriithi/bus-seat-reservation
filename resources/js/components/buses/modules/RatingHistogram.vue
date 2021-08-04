<template>
  <div class="row">
    <div class="col-6 justify-content-center d-flex align-items-center">
      <div class="d-block">
        <h1 class="font-weight-bold">{{ rating.avg_bus_rating }}</h1>
        <div>
          <star-rating
            :rating="rating.avg_bus_rating"
            :read-only="true"
            :increment="0.1"
            :star-size="20"
            active-color="var(--primary)"
            :show-rating="false"
          ></star-rating>
        </div>
        <span>{{ rating.total_ratings }}</span>
      </div>
    </div>
    <div class="col-6">
      <div class="histo w-100">
        <div
          class="histo-rate"
          :key="index"
          v-for="(rating_group, index) of rating.bus_rating_groups"
        >
          <span class="histo-star"> {{ index }} </span>
          <span class="bar-block">
            <span
              :id="`bar-${index}`"
              class="bar"
              :style="{ width: rating_group.percent }"
            ></span>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";

export default {
  components: { StarRating },
  props: {
    rating: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style scoped>
.font-weight-bold {
  font-weight: 580;
}
.bar-block {
  margin-left: 5px;
  display: inline-block;
  width: 75%;
  position: relative;
}

.bar {
  padding: 3px 4px;
  display: block;
  width: 0;
  border-radius: 7px;
  margin-bottom: 3px;
  background-color: var(--success);
}
</style>
