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
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    data-toggle="pill"
                    href="#trips-table"
                    >Table</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#seat-layout"
                    >Seat Layout</a
                  >
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane active" id="trips-table">
                  <manifest-table
                    :isLoading="manifestTableLoading"
                    :manifest="manifest"
                    :trip="trip"
                  />
                </div>
                <div class="tab-pane fade" id="seat-layout">
                  <seat-layout
                    v-if="showBusSeatLayout"
                    :seats="trip.route.bus.seat_layout.details.seats"
                    :bookedSeats="bookedSeats"
                    :cols="trip.route.bus.seat_layout.columns"
                    :rows="trip.route.bus.seat_layout.rows"
                    :aisleColumns="
                      trip.route.bus.seat_layout.details.aisleColumns
                    "
                    :aisleRows="trip.route.bus.seat_layout.details.aisleRows"
                    :disabledSeats="
                      trip.route.bus.seat_layout.details.disabledSeats
                    "
                    :gaps="trip.route.bus.seat_layout.details.gaps"
                    :seat_prefix="
                      trip.route.bus.seat_layout.details.seat_prefix
                    "
                  ></seat-layout>
                </div>
              </div>
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
const SeatLayout = () => import("./manifest/SeatLayout.vue");

export default {
  components: { BookingTable, ManifestTable, SeatLayout },
  provide() {
    return {
      seatClasses: this.trip.route.bus.seat_classes,
    };
  },
  props: {
    trip: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      manifest: [],
      manifestTableLoading: false,
    };
  },
  computed: {
    loading() {
      return this.$store.getters.loading;
    },
    createdBy() {
      return this.trip.created_by?.name;
    },
    showBusSeatLayout() {
      return !_.isEmpty(this.trip.route.bus.seat_layout);
    },
    bookedSeats() {
      let booked = [];
      this.manifest.forEach((reserve) => {
        booked.push({
          seat_number: reserve.seat_number,
          passenger_name: reserve.passenger_name,
        });
      });
      return booked;
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
    fetchManifest(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.manifestTableLoading = pageLoad;

      let url = `/admin/trips/${this.trip.id}/manifest`;

      let params = {};

      axios
        .get(url, { params })
        .then((res) => {
          this.manifest = res.data.data;

          this.$store.dispatch("stopLoading");
          this.manifestTableLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.manifestTableLoading = false;
        });
    },
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
  created() {
    this.fetchManifest();
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
