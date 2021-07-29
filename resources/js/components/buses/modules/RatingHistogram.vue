<template>
  <div class="row">
    <div class="col-6 justify-content-center d-flex align-items-center">
      <div class="d-block">
        <h1 class="font-weight-bold">4.2</h1>
        <div>
            <star-rating
            :rating="4.5"
            :read-only="true"
            :increment="0.5"
            :star-size="20"
            active-color="var(--primary)"
            :show-rating="false"
          ></star-rating>
        </div>
        <span>5,200</span>
      </div>
    </div>
    <div class="col-6">
      <div class="histo w-100">
        <div class="five histo-rate">
          <span class="histo-star"> 5 </span>
          <span class="bar-block">
            <span id="bar-five" class="bar w-75"></span>
          </span>
        </div>

        <div class="four histo-rate">
          <span class="histo-star"> 4 </span>
          <span class="bar-block">
            <span id="bar-four" class="bar w-50"> </span>
          </span>
        </div>

        <div class="three histo-rate">
          <span class="histo-star"> 3 </span>
          <span class="bar-block">
            <span id="bar-three" class="bar w-25"> </span>
          </span>
        </div>

        <div class="two histo-rate">
          <span class="histo-star"> 2 </span>
          <span class="bar-block">
            <span id="bar-two" class="bar w-0"> </span>
          </span>
        </div>

        <div class="one histo-rate">
          <span class="histo-star"> 1 </span>
          <span class="bar-block">
            <span id="bar-one" class="bar w-0"> </span>
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
};
</script>

<style scoped>
.font-weight-bold{
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
