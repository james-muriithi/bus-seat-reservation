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
          <a title="Delete" href="#" class="pr-1">
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
          <!-- download ticket -->
          <a
            :href="`/admin/reservations/${props.row.id}/tickets`"
            title="download ticket"
          >
            <i class="ti-download text-success fs-16"></i>
          </a>
        </span>

        <span v-else-if="props.column.field == 'passenger'">
          {{ firstPassenger(props.row.seats) }}
        </span>

        <span v-else-if="props.column.field == 'trip_id'">
          <a :href="`/admin/trips/${props.row.trip.id}`">
            {{ props.row.trip.trip_id }}
          </a>
        </span>

        <span v-else-if="props.column.field == 'bus_name'">
          <a :href="`/admin/buses/${props.row.trip.route.bus.id}`">
            {{ props.row.trip.route.bus.bus_name }} -
            {{ props.row.trip.route.bus.bus_reg_no }}
          </a>
        </span>

        <span v-else-if="props.column.field == 'route'">
          <a :href="`/admin/routes/${props.row.trip.route.id}`">
            {{ props.row.trip.route.board_point }} -
            {{ props.row.trip.route.drop_point }}
          </a>
        </span>

        <span v-else-if="props.column.field == 'pickup_point'">
          {{ props.row.pickup_point.pickup_point }}
        </span>

        <span v-else-if="props.column.field == 'drop_off_point'">
          {{ props.row.drop_point.drop_off_point }}
        </span>

        <span v-else-if="props.column.field == 'pickup_time'">
          {{ props.row.trip.route.board_time }}
        </span>

        <span v-else-if="props.column.field == 'seats'">
          <span
            class="badge badge-pill badge-primary mx-1 px-10 py-1"
            v-for="seat in props.row.seats"
            :key="seat.id"
            >{{ seat.name }}</span
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
      reservations: [],
    };
  },
  computed: {
    reservationViewUrl() {
      return function (reservationId) {
        return `/reservations/${reservationId}/view`;
      };
    },
    columns() {
      let columns = [
        {
          label: "Ref",
          field: "ref",
        },
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
          label: "Pickup Point",
          field: "pickup_point",
        },
        {
          label: "Pickup Time",
          field: "pickup_time",
        },
        {
          label: "Seats",
          field: "seats",
        },
        {
          label: "Dropoff Point",
          field: "drop_off_point",
        },
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
          field: "created_at",
          type: "date",
          thClass: "text-left",
          tdClass: "text-left",
          dateInputFormat: "yyyy-MM-dd HH:mm:ss",
          dateOutputFormat: "MMM do yyyy HH:mm",
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
      if (!!this.trip_id) {
        columns = columns.filter((col) => !["route"].includes(col.field));
      }
      return columns;
    },
  },
  methods: {
    firstPassenger(reservation) {
      return reservation[0]?.reservation?.passenger.name;
    },
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
          this.reservations = res.data.data;
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
          title: "Passenger",
          dataKey: "passenger",
        },
        {
          title: "Trip",
          dataKey: "trip_id",
        },
        {
          title: "Bus Name",
          dataKey: "bus_name",
        },
        {
          title: "Route",
          dataKey: "route",
        },
        {
          title: "Pickup/Time",
          dataKey: "pickup_point",
        },
        // {
        //   title: "Pickup Time",
        //   dataKey: "pickup_time",
        // },
        {
          title: "Drop Point",
          dataKey: "drop_point",
        },
        {
          title: "Seats",
          dataKey: "seats",
        },
        {
          title: "Travel Date",
          dataKey: "travel_date",
        },
        {
          title: "Created At",
          dataKey: "created_at",
        },
      ];
      autoTable(pdf, {
        columns,
        startX: 0,
        margin: {left: 5, right: 5},
        body: self.reservations,
        bodyStyles: {
            fontSize: 9,
        },
        didParseCell: function (data) {
          if (data.column.dataKey === "passenger") {
            if (data.row.raw.seats && typeof data.row.raw.seats === "object") {
              data.cell.text = self.firstPassenger(data.row.raw.seats) || "";
            }
          } else if (data.column.dataKey === "trip_id") {
            if (data.row.raw.trip && typeof data.row.raw.trip === "object") {
              data.cell.text = data.row.raw.trip.trip_id;
            }
          } else if (data.column.dataKey === "route") {
            if (data.row.raw.trip && typeof data.row.raw.trip === "object") {
              data.cell.text = `${data.row.raw.trip.route.board_point} - ${data.row.raw.trip.route.drop_point}`;
            }
          } else if (data.column.dataKey === "bus_name") {
            if (data.row.raw.trip && typeof data.row.raw.trip === "object") {
              data.cell.text = `${data.row.raw.trip.route.bus.bus_reg_no}`;
            }
          } else if (data.column.dataKey === "pickup_point") {
            if (
              data.row.raw.pickup_point &&
              typeof data.row.raw.pickup_point === "object"
            ) {
              data.cell.text = `${data.row.raw.pickup_point.pickup_point} ${data.row.raw.trip.route.board_time}`;
            }
          }else if (data.column.dataKey === "drop_point") {
            if (
              data.row.raw.drop_point &&
              typeof data.row.raw.drop_point === "object"
            ) {
              data.cell.text = `${data.row.raw.drop_point.drop_off_point}`;
            }
          } 
          // else if (data.column.dataKey === "pickup_time") {
          //   if (data.row.raw.trip && typeof data.row.raw.trip === "object") {
          //     data.cell.text = `${data.row.raw.trip.route.board_time}`;
          //   }
          // } 
          else if (data.column.dataKey === "seats") {
            if (data.row.raw.seats && Array.isArray(data.row.raw.seats)) {
              data.cell.text = data.row.raw.seats
                .map((seat) => seat.name)
                .join(", ");
            }
          } else if (data.column.dataKey === "status") {
            if (data.cell.raw == 1 || data.cell.raw == 0) {
              data.cell.text = data.cell.raw ? "Active" : "Inactive";
            }
          }
        },
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
