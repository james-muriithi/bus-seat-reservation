<template>
  <div class="mx-2 mx-md-3 mt-2">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <h4 class="font-weight-bold mb-3">Route Details</h4>

            <table class="table table-hover table-bordered table-md">
              <tbody>
                <tr>
                  <td>Bus Name</td>
                  <th>{{ route.bus.bus_name }} - {{ route.bus.bus_reg_no }}</th>
                </tr>
                <tr>
                  <td>Pickup Point</td>
                  <th>{{ route.board_point }}</th>
                </tr>
                <tr>
                  <td>Pickup Time</td>
                  <th>{{ route.board_time }}</th>
                </tr>
                <tr>
                  <td>Drop Off Point</td>
                  <th>{{ route.drop_point }}</th>
                </tr>
                <tr>
                  <td>Drop Off Time</td>
                  <th>{{ route.drop_time }}</th>
                </tr>
                <tr>
                  <td>Status</td>
                  <th>
                    <span
                      :class="`badge py-1 px-2 badge-outline-${
                        route.status ? 'success' : 'danger'
                      }`"
                    >
                      {{ route.status ? "Active" : "Inactive" }}
                    </span>
                  </th>
                </tr>

                <tr>
                  <td>Fare</td>
                  <th>
                    <span
                      class="badge py-1 px-2 badge-success mr-1"
                      v-for="seatClass in route.seatClassesFare"
                      :key="seatClass.id"
                    >
                      {{ seatClass.name }} - {{ seatClass.currencyCode
                      }}{{ seatClass.fare }}
                    </span>
                  </th>
                </tr>
                <tr>
                  <td>Created At</td>
                  <th>{{ route.created_at }}</th>
                </tr>
                <tr>
                  <td>Updated At</td>
                  <th>{{ route.updated_at }}</th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6">
            <h4 class="mb-3 font-weight-bold">Price Variations</h4>
            <div class="mt-2">
              <price-variations-table :smallTable="true" :route_id="route.id"></price-variations-table>
            </div>
          </div>
          <div class="col-md-6">
            <h4 class="mb-3 font-weight-bold">Trips</h4>
            <div class="mt-2">
              <trips-table :route_id="route.id" />
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-md-6">
            <h4 class="mb-3 font-weight-bold">Drop Off Points</h4>
            <div class="mt-2">
              <drop-off-points-table :smallTable="true" :defaultCreateRoute="route.id"></drop-off-points-table>
            </div>
          </div>
          <div class="col-md-6">
            <h4 class="mb-3 font-weight-bold">Pickup Up Points</h4>
            <div class="mt-2">
              <pickup-points-table :smallTable="true" :defaultCreateRoute="route.id"></pickup-points-table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Nprogress from "nprogress";
const PickupPointsTable = () => import("../pickup/Table.vue");
const DropOffPointsTable = () =>  import("../drop-off-point/DropOffPointsTable.vue");
const PriceVariationsTable = () => import("../route-price-variations/PriceVariationsTable.vue");
const TripsTable = () => import ("../trips/TripsTable.vue");

export default {
  components: { PickupPointsTable, DropOffPointsTable, PriceVariationsTable, TripsTable },
  props: {
    route: {
      type: Object,
      required: true,
    },
  },
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
