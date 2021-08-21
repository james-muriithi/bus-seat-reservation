<template>
  <div class="mx-2 mx-md-3 mt-2">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <h4 class="font-weight-bold mb-3">Bus Details</h4>

            <table class="table table-hover table-bordered table-md">
              <tbody>
                <tr>
                  <td>Bus Name</td>
                  <th>{{ bus.bus_name }}</th>
                </tr>
                <tr>
                  <td>Bus Reg No</td>
                  <th>{{ bus.bus_reg_no }}</th>
                </tr>
                <tr>
                  <td>Bus Type</td>
                  <th>{{ bus.bus_type.bus_type }}</th>
                </tr>
                <tr>
                  <td>Max Seats</td>
                  <th>{{ bus.max_seats }}</th>
                </tr>
                <tr>
                  <td>Seats</td>
                  <th>{{ busSeats }}</th>
                </tr>
                <tr>
                  <td>Status</td>
                  <th>
                    <span
                      :class="`badge py-1 px-2 badge-outline-${
                        bus.status ? 'success' : 'danger'
                      }`"
                    >
                      {{ bus.status ? "Active" : "Inactive" }}
                    </span>
                  </th>
                </tr>

                <tr>
                  <td>Amenities</td>
                  <th>
                    <span
                      class="badge py-1 px-2 badge-primary m-1"
                      v-for="amenity in bus.amenities"
                      :key="amenity.name"
                    >
                      {{ amenity.name }}
                    </span>
                  </th>
                </tr>
                <tr>
                  <td>Seat Classes</td>
                  <th>
                    <span
                      class="badge py-1 px-2 badge-success m-1"
                      v-for="seatClass in bus.seat_classes"
                      :key="seatClass.id"
                    >
                      {{ seatClass.name }}
                    </span>
                  </th>
                </tr>
                <tr>
                  <td>Created By</td>
                  <th>{{ bus.created_by.name }}</th>
                </tr>
                <tr>
                  <td>Created At</td>
                  <th>{{ bus.created_at }}</th>
                </tr>
                <tr>
                  <td>Updated At</td>
                  <th>{{ bus.updated_at }}</th>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-md-4">
            <div class="mb-3 mt-md-0 mt-3">
              <h4 class="mb-2 font-weight-bold">Ratings and reviews</h4>
              <rating-histogram
                :rating="bus['average-rating']"
              ></rating-histogram>
            </div>
            <h4 class="my-3 font-weight-bold">Bus Images</h4>

            <div class="row">
              <div
                class="col-md-6 mb-3"
                v-for="image in bus.images"
                :key="image.file_name"
              >
                <img
                  :src="image.preview"
                  alt="image"
                  class="image-cover w-100 img-fluid"
                />
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-lg-8">
            <h4 class="mb-3 font-weight-bold">Bus Trips</h4>
            <div class="mt-2">
              <trips-table :bus_id="bus.id"></trips-table>
            </div>
          </div>
          <div class="col-lg-4">
            <h4 class="mb-3 font-weight-bold">Something</h4>
            <div class="mt-2">
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-lg-8">
            <h4 class="mb-3 font-weight-bold">Bus Routes</h4>
            <div class="mt-2">
              <routes-table :bus_id="bus.id"></routes-table>
            </div>
          </div>
          <div class="col-lg-4">
            <h4 class="mb-3 font-weight-bold">Seats Layout</h4>
            <div class="mt-2">
              <seat-layout
                v-if="showBusSeatLayout"
                :seats="bus.seat_layout.details.seats"
                :cols="bus.seat_layout.columns"
                :rows="bus.seat_layout.rows"
                :aisleColumns="bus.seat_layout.details.aisleColumns"
                :aisleRows="bus.seat_layout.details.aisleRows"
                :disabledSeats="bus.seat_layout.details.disabledSeats"
                :gaps="bus.seat_layout.details.gaps"
                :seat_prefix="bus.seat_layout.details.seat_prefix"
              ></seat-layout>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Nprogress from "nprogress";
const RatingHistogram = () => import("./modules/RatingHistogram.vue");
const RoutesTable = () => import("../routes/RoutesTable.vue");
const SeatLayout = () => import("./modules/SeatLayout.vue");
const TripsTable = () => import ("../trips/TripsTable.vue");

export default {
  components: { RatingHistogram, RoutesTable, SeatLayout, TripsTable },
  provide() {
    return {
      seatClasses: this.bus.seat_classes,
    };
  },
  props: {
    bus: {
      type: Object,
      required: true,
    },
  },
  computed: {
    loading() {
      return this.$store.getters.loading;
    },
    busSeats() {
      return this.bus.seats.length ?? 0;
    },
    showBusSeatLayout() {
      return !_.isEmpty(this.bus.seat_layout);
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
<style scoped>
th {
  font-size: 14px;
  font-weight: 700;
}
.image-cover {
  border-radius: 8px !important;
  object-fit: cover;
}
</style>
