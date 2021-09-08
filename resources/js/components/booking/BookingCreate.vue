<template>
  <div class="mx-2 mx-md-3 mt-3">
    <div>
      <div class="row">
        <div class="col-md-5">
          <search-section
            :pickup_points="pickup_points"
            :drop_points="drop_points"
            @search="fetchTrips"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Nprogress from "nprogress";
import SearchSection from "./modules/SearchSection.vue";

export default {
  name: "BookingCreate",
  props: {
    pickup_points: {
      type: Array,
      default: () => [],
    },
    drop_points: {
      type: Array,
      default: () => [],
    },
  },
  components: { SearchSection },
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
  methods: {
    fetchTrips(from, to, travel_date) {
      console.log(from,to,travel_date);
      this.$store.dispatch("startLoading");

      let url = "/admin/trips/search";

      let params = {
        from,
        to,
        travel_date,
      };

      axios
        .get(url, { params })
        .then((res) => {
          // this.trips = res.data.data;
          console.log(res.data.data);
          this.$store.dispatch("stopLoading");
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
        });
    },
  },
};
</script>

