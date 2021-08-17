<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>
    <vue-good-table
      v-else
      :columns="columns"
      :rows="reservations"
      :search-options="{
        placeholder: 'Search this table',
        enabled: true,
      }"
      :pagination-options="{
        enabled: true,
        mode: 'records',
        nextLabel: 'next',
        prevLabel: 'prev',
      }"
      :select-options="{
        enabled: true,
        clearSelectionText: 'clear',
        selectOnCheckboxOnly: true,
      }"
      styleClass="vgt-table tableOne table-hover"
    >
      <div slot="selected-row-actions">
        <button class="btn btn-danger btn-sm">Delete</button>
      </div>
      <div slot="table-actions" class="mt-2 mb-3">
        <button
          class="btn btn-sm btn-outline-info ripple m-1"
          @click="openFilter"
        >
          <i class="ti-filter"></i> Filter
        </button>
        <button
          class="btn btn-sm btn-outline-success ripple m-1"
          @click="Reservations_PDF"
        >
          <i class="fa fa-file-pdf"></i> PDF
        </button>
        <button class="btn btn-sm btn-outline-danger ripple m-1">
          <i class="fa fa-file-excel"></i> EXCEL
        </button>
        <a class="btn-sm btn btn-primary btn-icon m-1 ripple" href="#">
          <span class="ul-btn__icon">
            <i data-feather="plus-circle" class="feather-icon"></i>
          </span>
          <span class="ul-btn__text ml-1">Create</span>
        </a>
      </div>

      <template slot="table-row" slot-scope="props">
        <span v-if="props.column.field == 'actions'">
          <a title="View" :href="reservationViewUrl(props.row.id)" class="pr-1">
            <i class="fa fa-eye fs-16 text-info"></i>
          </a>
          <a href="#" title="Edit" class="pr-1">
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <a title="Delete" href="#">
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>
        <span v-else-if="props.column.field == 'seats'">
          <span
            class="badge badge-pill badge-primary mx-1 px-10 py-1"
            v-for="seat in props.row.seats.split(',')"
            :key="seat"
            >{{ seat }}</span
          >
        </span>
      </template>
    </vue-good-table>

    <!-- filter -->
    <filter-sidebar :open="filterOpen" @close="closeFilter">
      <div class="px-3 py-2">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="Bus">Bus</label>
              <select2
                id="Bus"
                aria-describedby="bus-feedback"
                :options="buses"
                v-model="filter.bus"
                :settings="{
                  theme: 'bootstrap',
                  multiple: false,
                  closeOnSelect: true,
                }"
              >
              </select2>
            </div>

            <div class="form-group">
              <label for="Bus">Pickup Point</label>
              <select2
                id="pp"
                aria-describedby="bus-feedback"
                :options="pickup_points"
                v-model="filter.pickup_point"
                :settings="{
                  theme: 'bootstrap',
                  multiple: false,
                  closeOnSelect: true,
                }"
              >
              </select2>
            </div>
            <div class="form-group">
              <label for="Bus">Travel Date</label>
              <input
                type="date"
                name="travel-date"
                id="travel-date"
                class="form-control"
                v-model="filter.travel_date"
              />
            </div>
            <div class="form-group">
              <label for="Bus">Reservation Date</label>
              <input
                type="date"
                name="reserve-date"
                id="reserve-date"
                class="form-control"
                v-model="filter.reservation_date"
              />
            </div>
          </div>
          <div class="col-md-12 mt-3">
            <div class="row">
              <div
                class="col-md-6 mt-md-0 mt-3 order-md-first"
                @click="resetFilter"
              >
                <button class="btn btn-danger btn-block ripple">Reset</button>
              </div>
              <div class="col-md-6 mt-md-0 mt-3 order-first">
                <button
                  class="btn btn-primary btn-block ripple"
                  @click="filterReservations"
                >
                  <i class="ti-filter"></i>Filter
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </filter-sidebar>
  </div>
</template>

<script>
import jsPDF from "jspdf";
import autoTable from "jspdf-autotable";
import Select2 from "v-select2-component";
import "select2-bootstrap-theme/dist/select2-bootstrap.min.css";

export default {
  components: { Select2 },
  props: {
    limit: {
      type: Number,
      default: null,
    },
    trip_id: {
      default: null,
    },
  },
  data() {
    return {
      isLoading: false,
      filterOpen: false,
      buses: [],
      pickup_points: [],
      filter: {
        bus: "",
        drop_point: "",
        pickup_point: "",
        travel_date: "",
        reservation_date: "",
      },
      reservations: [
        {
          id: 1,
          passenger: "James Muriithi",
          trip_id: "TR-23SJ349",
          bus_name: "Rello - KCP 234K",
          route: "Nairobi - Malindi",
          pickup_time: "16:30",
          seats: "A25",
          travel_date: "2021-07-21",
          reservation_date: "2021-07-21",
        },
      ],
    };
  },
  computed: {
    reservationViewUrl() {
      return function (reservationId) {
        return `/reservations/${reservationId}/view`;
      };
    },
    columns() {
      return [
        {
          label: "Passenger",
          field: "passenger",
        },
        {
          label: "Trip",
          field: "trip_id",
        },
        {
          label: "Bus Name",
          field: "bus_name",
        },
        {
          label: "Route",
          field: "route",
        },
        {
          label: "Pickup Time",
          field: "pickup_time",
        },
        {
          label: "Seats",
          field: "seats",
        },
        // {
        //   label: "Dropoff Time",
        //   field: "dropoff_time",
        // },
        {
          label: "Travel Date",
          field: "travel_date",
          type: "date",
          thClass: "text-left",
          tdClass: "text-left",
          dateInputFormat: "yyyy-MM-dd",
          dateOutputFormat: "MMM do yyyy",
        },
        {
          label: "Reservation Date",
          field: "reservation_date",
          type: "date",
          thClass: "text-left",
          tdClass: "text-left",
          dateInputFormat: "yyyy-MM-dd",
          dateOutputFormat: "MMM do yyyy",
        },
        {
          label: "Actions",
          field: "actions",
          html: true,
          tdClass: "text-center",
          thClass: "text-center",
          sortable: false,
        },
      ];
    },
  },
  methods: {
    getBookings() {
      let url = "/admin/reservations";

      const params = {
        limit: this.limit,
        trip: this.trip_id,
        ...this.filter,
      };

      axios
        .get(url, { params })
        .then((res) => {
          console.log(res);
        })
        .catch((err) => console.log(err));
    },
    fetchBuses() {
      axios
        .get("/admin/buses", { params: { active: 1 } })
        .then((res) => {
          res.data.data.forEach((bus) => {
            this.buses.push({
              id: bus.id,
              text: `${bus.bus_reg_no} - ${bus.bus_name}`,
            });
          });
        })
        .catch((res) => {
          console.log(res);
        });
    },
    fetchPickupPoints() {
      let url = "/admin/pickup-points";

      axios
        .get(url, { params: { active: 1 } })
        .then((res) => {
          this.pickup_points = [];

          res.data.data.forEach((pickup_point) => {
            this.pickup_points.push({
              id: pickup_point.id,
              text: pickup_point.pickup_point,
            });
          });
        })
        .catch((err) => {
          console.log(err);
        });
    },

    Reservations_PDF() {
      var self = this;

      let pdf = new jsPDF("p", "pt");
      let columns = [
        {
          title: "Bus Name",
          dataKey: "bus_name",
        },
        {
          title: "Bus Reg",
          dataKey: "bus_reg",
        },
        {
          title: "Pickup Point",
          dataKey: "pickup_point",
        },
        {
          title: "Pickup Time",
          dataKey: "pickup_time",
        },
        {
          title: "Dropoff Point",
          dataKey: "dropoff_point",
        },
        {
          title: "Seats",
          dataKey: "seats",
        },
        {
          title: "Travel At",
          dataKey: "travel_date",
        },
        {
          title: "Created At",
          dataKey: "reservation_date",
        },
      ];
      autoTable(pdf, {
        columns,
        body: self.reservations,
      });
      pdf.text("Reservations List", 40, 25);
      this.addPdfFooters(pdf);
      pdf.save(
        `Reservations_List-${moment().format("YYYY-MM-DD HH_mm_ss")}.pdf`
      );
    },
    openFilter() {
      this.filterOpen = true;
    },
    closeFilter() {
      this.filterOpen = false;
    },
    async resetFilter() {
      this.filter = {
        bus: "",
        drop_point: "",
        pickup_point: "",
        travel_date: "",
        reservation_date: "",
      };

      this.$store.dispatch("startLoading");
      await this.getBookings();
      this.$store.dispatch("stopLoading");
    },
    async filterReservations() {
      this.$store.dispatch("startLoading");
      await this.getBookings();
      this.$store.dispatch("stopLoading");
    },
  },
  async created() {
    this.$store.dispatch("startLoading");
    this.isLoading = true;

    await this.getBookings();
    this.fetchBuses();
    this.fetchPickupPoints();

    this.$store.dispatch("stopLoading");
    this.isLoading = false;
  },
};
</script>
