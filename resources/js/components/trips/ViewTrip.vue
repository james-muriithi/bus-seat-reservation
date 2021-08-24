<template>
  <div class="mx-2 mx-md-3 mt-2">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <h4 class="font-weight-bold mb-3">Trip Details</h4>

            <table class="table table-hover table-bordered table-md">
              <tbody>
                <tr>
                  <td>Trip Id</td>
                  <th>{{ trip.trip_id }}</th>
                </tr>
                <tr>
                  <td>Bus Name</td>
                  <th>{{ trip.route.bus.bus_name }}</th>
                </tr>
                <tr>
                  <td>Bus Reg No</td>
                  <th>{{ trip.route.bus.bus_reg_no }}</th>
                </tr>
                <tr>
                  <td>Route</td>
                  <th>
                    {{ trip.route.board_point }} -
                    {{ trip.route.drop_point }}
                  </th>
                </tr>
                <tr>
                  <td>Pickup Time</td>
                  <th>{{ trip.route.board_time }}</th>
                </tr>
                <tr>
                  <td>Reservations</td>
                  <th>{{ trip.reservations.length }}</th>
                </tr>
                <tr>
                  <td>Status</td>
                  <th>
                    <span>
                      <span
                        :class="`badge py-1 px-2 badge-outline-${tripStatusClass(
                          trip.status
                        )}`"
                      >
                        {{ tripStatus(trip.status) }}
                      </span>
                    </span>
                  </th>
                </tr>
                <tr>
                  <td>Created By</td>
                  <th>{{ createdBy }}</th>
                </tr>
                <tr>
                  <td>Created At</td>
                  <th>{{ trip.created_at }}</th>
                </tr>
                <tr>
                  <td>Updated At</td>
                  <th>{{ trip.updated_at }}</th>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-md-4">
            <div class="mb-3 mt-md-0 mt-3">
              <h4 class="mb-2 font-weight-bold">Ratings and reviews</h4>
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-lg-12">
            <h4 class="mb-3 font-weight-bold">Trip Manifest</h4>
            <div class="mt-2">
              <manifest-table :trip_id="1" />
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-lg-12">
            <h4 class="mb-3 font-weight-bold">Reservations</h4>
            <div class="mt-2">
              <booking-table :trip_id="trip.id" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Nprogress from "nprogress";
const BookingTable = () => import("../booking/BookingTable.vue");
const ManifestTable = () => import("../trips/manifest/ManifestTable");

export default {
  components: { BookingTable, ManifestTable },
  props: {
    trip: {
      type: Object,
      required: true,
    },
  },
  computed: {
    loading() {
      return this.$store.getters.loading;
    },
    createdBy() {
      return this.trip.created_by?.name;
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
    tripStatus(status) {
      if (status == 1) {
        return "Active";
      } else if (status == 2) {
        return "Departured";
      }
      return "Cancelled";
    },
    tripStatusClass(status) {
      if (status == 1) {
        return "success";
      } else if (status == 2) {
        return "info";
      }
      return "danger";
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
