<template>
  <div>
    <div class="text-center">
      <h5 v-if="tripsCount > 0" class="mb-3">
        Trips <span>({{ tripsCount }})</span>
      </h5>
      <div class="trips">
        <div class="d-flex justify-content-center" v-if="tripsCount == 0">
          <div class="card">
            <div class="card-body">
              <img :src="asset('images/no_bus.png')" alt="no buses" />
              <div>
                Sorry, we can not find any seat available on the date you have
                requested. Please try another combination.
              </div>
            </div>
          </div>
        </div>
        <div v-else>
          <trip-card v-for="trip in trips" :key="trip.trip_id" :trip="trip" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const TripCard = () => import("./TripCard.vue");
export default {
  name: "TripsSection",
  components: { TripCard },
  props: {
    tripsData: {
      required: true,
    },
  },
  computed: {
    tripsCount() {
      return parseInt(this.tripsData?.trips_count || 0);
    },
    trips() {
      return this.tripsData?.trips || {};
    },
  },
};
</script>