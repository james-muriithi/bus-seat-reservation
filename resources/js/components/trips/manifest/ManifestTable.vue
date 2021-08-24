<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="booked"
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
      </div>

      <template slot="table-row" slot-scope="props">
        <span v-if="props.column.field == 'actions'">
          <!-- view bus -->
          <a :href="`/admin/trips/${props.row.id}`" title="View" class="pr-1">
            <i class="ti-eye fs-16 text-info"></i>
          </a>
          <!-- edit bus -->
          <a
            href="#"
            @click.prevent="editTrip({ ...props.row })"
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
          <a :href="`/admin/buses/${props.row.route.bus.id}`">
            {{ props.row.route.bus.bus_name }} -
            {{ props.row.route.bus.bus_reg_no }}
          </a>
        </span>

        <span v-else-if="props.column.field == 'route'">
          <a :href="`/admin/routes/${props.row.route.id}`">
            {{ props.row.route.board_point }} -
            {{ props.row.route.drop_point }}
          </a>
        </span>

        <span v-else-if="props.column.field == 'board_time'">
          {{ props.row.route.board_time }}
        </span>

        <span v-else-if="props.column.field == 'reservations'">
          {{ props.row.reservations.length }}
        </span>

        <span v-else-if="props.column.field == 'fare'">
          <span v-if="props.row.seat_classes_fare.length > 0">
            <span
              class="badge py-1 px-2 badge-success mr-1"
              v-for="seatClass in props.row.seat_classes_fare"
              :key="seatClass.id"
            >
              {{ seatClass.name }} - {{ seatClass.currencyCode
              }}{{ seatClass.fare }}
            </span>
          </span>
          <span v-else>
            {{ props.row.fare }}
          </span>
        </span>

        <span v-else-if="props.column.field == 'status'">
          <span
            :class="`badge py-1 px-2 badge-outline-${tripStatusClass(
              props.row.status
            )}`"
          >
            {{ tripStatus(props.row.status) }}
          </span>
        </span>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
export default {
  props: {
    bus_id: {
      default: null,
    },
    route_id: {
      default: null,
    },
  },
  data() {
    return {
      isLoading: false,
      booked: [],
      selectedTrip: {},
    };
  },
  computed: {
    columns() {
      let columns = [
        {
          label: "Ticket Number",
          field: "ticket_number",
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
          label: "Seat Number",
          field: "seat_number",
        },
        {
          label: "Travel Date",
          field: "travel_date",
          type: "date",
          dateInputFormat: "yyyy-MM-dd",
          dateOutputFormat: "MMM do yyyy",
        },
        {
          label: "Start Time",
          field: "board_time",
        },
        {
          label: "Amount Paid",
          field: "fare",
        },
        {
          label: "Status",
          field: "status",
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
      if (this.route_id) {
        return columns.filter(
          (col) => !["bus_name", "route"].includes(col.field)
        );
      } else if (this.bus_id) {
        return columns.filter((col) => !["bus_name"].includes(col.field));
      }
      return columns;
    },
  },
  methods: {},
  created() {},
};
</script>
