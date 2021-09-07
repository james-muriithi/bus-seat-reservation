<template>
  <div>
    <div class="text-center">
      <h5>Trips</h5>
      <div class="trips mt-3">
        <trip-card />
      </div>
    </div>
  </div>
</template>

<script>
const TripCard = () => import("./TripCard.vue");
export default {
  name: "TripsSection",
  components: { TripCard },
};
</script>