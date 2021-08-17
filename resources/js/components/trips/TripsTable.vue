<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="trips"
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
      :sort-options="{
        enabled: true,
      }"
      styleClass="vgt-table tableOne table-hover"
    >
      <div slot="selected-row-actions">
        <button class="btn btn-danger btn-sm">Delete</button>
      </div>
      <div slot="table-actions" class="mt-2 mb-3">
        <button class="btn btn-sm btn-outline-success ripple m-1">
          <i class="fa fa-file-pdf"></i> PDF
        </button>
        <button
          class="btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple"
          data-toggle="modal"
          data-target="#create-trip"
        >
          <span class="ul-btn__icon">
            <i data-feather="plus-circle" class="feather-icon"></i>
          </span>
          <span class="ul-btn__text ml-1">Create</span>
        </button>
      </div>

      <template slot="table-row" slot-scope="props">
        <span v-if="props.column.field == 'actions'">
          <!-- view bus -->
          <a :href="`/admin/routes/${props.row.id}`" title="View" class="pr-1">
            <i class="ti-eye fs-16 text-info"></i>
          </a>
          <!-- edit bus -->
          <a
            :href="`/admin/routes/${props.row.id}/edit`"
            title="Edit"
            class="pr-1"
          >
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <!-- delete bus -->
          <a
            title="Delete"
            href="#"
            @click.prevent="deleteRoute({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>

        <span v-else-if="props.column.field == 'bus_name'">
          {{ props.row.bus.bus_name }}
        </span>

        <span v-else-if="props.column.field == 'fare'">
          <span
            class="badge py-1 px-2 badge-success mr-1"
            v-for="seatClass in props.row.seatClassesFare"
            :key="seatClass.id"
          >
            {{ seatClass.name }} - {{ seatClass.currencyCode
            }}{{ seatClass.fare }}
          </span>
        </span>

        <span v-else-if="props.column.field == 'status'">
          <span
            :class="`badge py-1 px-2 badge-outline-${
              props.row.status ? 'success' : 'danger'
            }`"
          >
            {{ props.row.status ? "Active" : "Inactive" }}
          </span>
        </span>
      </template>
    </vue-good-table>

    <create-trip
      :default-route="defaultCreateRoute"
      @update="fetchTrips(false)"
    ></create-trip>
  </div>
</template>

<script>
const CreateTrip = () => import("./CreateTrip.vue");

export default {
  components: { CreateTrip },
  props: {
    bus_id: {
      default: null,
    },
  },
  data() {
    return {
      isLoading: false,
      trips: [],
      selectedTrips: {},
      defaultCreateRoute: "",
    };
  },
  computed: {
    columns() {
      let columns = [
        {
          label: "Trip Id",
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
          label: "Travel Date",
          field: "travel_date",
        },
        {
          label: "Pickup Time",
          field: "board_time",
        },
        {
          label: "Reservations",
          field: "reservations",
        },
        {
          label: "Status",
          field: "status",
        },
        // {
        //   label: "Cretaed At",
        //   field: "created_at",
        //   type: "date",
        //   thClass: "text-left",
        //   tdClass: "text-left",
        //   dateInputFormat: "yyyy-MM-dd HH:mm:ss",
        //   dateOutputFormat: "MMM do yyyy HH:mm",
        // },
        {
          label: "Actions",
          field: "actions",
          html: true,
          tdClass: "text-center",
          thClass: "text-center",
          sortable: false,
        },
      ];
      if (this.bus_id) {
        columns.shift();
      }
      return columns;
    },
  },
  methods: {
    fetchTrips(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      let url = "/admin/trips";

      let params = {};

      if (this.bus_id) {
        params.bus = this.bus_id;
      }

      axios
        .get(url, { params })
        .then((res) => {
          this.trips = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
    deleteRoute(route) {
      this.selecteRoute = route;
      $("#delete-route").modal("show");
    },
  },
  created() {
    this.fetchTrips();
  },
};
</script>
