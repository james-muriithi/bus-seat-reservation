<template>
  <div>
    <div class="m-2">Latest Reservations</div>
    <vue-good-table
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
        selectOnCheckboxOnly: true
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
            >{{seat}}</span
          >
        </span>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
export default {
  props: {
    limit: {
      type: Number,
      default: null,
    },
  },
  data() {
    return {
      reservations: [
        {
          id: 1,
          bus_name: "Rello",
          bus_reg: "KCP 234K",
          pickup_point: "Nairobi",
          pickup_time: "16:30",
          dropoff_point: "Malindi",
          dropoff_time: "11:00",
          seats: "A25",
          date: "2021-07-21",
        },
        {
          id: 2,
          bus_name: "Rello",
          bus_reg: "KCK 234K",
          pickup_point: "Nairobi",
          pickup_time: "16:30",
          dropoff_point: "Malindi",
          dropoff_time: "11:00",
          seats: "5, 9",
          date: "2021-07-21",
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
          label: "Bus Name",
          field: "bus_name",
        },
        {
          label: "Bus Reg",
          field: "bus_reg",
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
          label: "Dropoff Point",
          field: "dropoff_point",
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
          label: "Date",
          field: "date",
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
      this.$store.dispatch("startLoading");
      let url = "/admin/reservations";
      this.limit != null ? `${url}?limit=${this.limit}` : url;

      axios
        .get(url)
        .then((res) => {
          this.$store.dispatch("stopLoading");
        })
        .catch();
    },
  },
  created() {
    this.getBookings();
  },
};
</script>
