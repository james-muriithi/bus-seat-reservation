<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="manifest"
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
        <button
          class="btn btn-sm btn-outline-success ripple m-1"
          @click="Manifests_PDF"
        >
          <i class="fa fa-file-pdf"></i> PDF
        </button>
      </div>

      <template slot="table-row" slot-scope="props">
        <span v-if="props.column.field == 'actions'">
          <!-- view -->
          <a :href="`/admin/trips/${props.row.id}`" title="View" class="pr-1">
            <i class="ti-eye fs-16 text-info"></i>
          </a>
          <!-- download ticket -->
          <a href="/admin/trips/ticket" title="download ticket" class="pr-1">
            <i class="ti-download text-success fs-16"></i>
          </a>
        </span>

        <span v-else-if="props.column.field == 'bus_name'">
          <a :href="`/admin/buses/${props.row.bus.id}`">
            {{ props.row.bus.formatted_name }}
          </a>
        </span>

        <span v-else-if="props.column.field == 'route'">
          <a :href="`/admin/routes/${props.row.route.id}`">
            {{ props.row.route_name }}
          </a>
        </span>
        <span v-else-if="props.column.field == 'travel_date'">
          {{ props.row.travel_date }} {{ props.row.board_time }}
        </span>

        <span v-else-if="props.column.field == 'seat_number'">
          <span class="badge badge-pill badge-primary mx-1 px-10 py-1">{{
            props.row.seat_number
          }}</span>
        </span>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
import jsPDF from "jspdf";
import autoTable from "jspdf-autotable";

export default {
  props: {
    manifest: {
      required: true,
      type: Array,
    },
    trip: {
      type: Object,
      required: true,
    },
    isLoading: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      selectedTrip: {},
    };
  },
  computed: {
    manifestBus() {
      return this.trip?.route?.bus?.bus_reg_no ?? "";
    },
    travelDate() {
      return this.trip?.travel_date ?? "";
    },
    columns() {
      let columns = [
        {
          label: "Passenger",
          field: "passenger_name",
        },
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
          label: "Drop Point",
          field: "drop_point",
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
          thClass: "text-center",
        },
        // {
        //   label: "Amount Paid",
        //   field: "amount_paid",
        // },
        // {
        //   label: "Status",
        //   field: "status",
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

      return columns;
    },
  },
  methods: {
    Manifests_PDF() {
      var self = this;

      let pdf = new jsPDF("p", "pt");
      let columns = [
        {
          title: "Ticket Number",
          dataKey: "ticket_number",
        },
        {
          title: "Bus Name",
          dataKey: "bus_name",
        },
        {
          title: "Route",
          dataKey: "route_name",
        },
        {
          title: "Pickup Point",
          dataKey: "pickup_point",
        },
        {
          title: "Drop Point",
          dataKey: "drop_point",
        },
        {
          title: "Seat Number",
          dataKey: "seat_number",
        },
        {
          title: "Travel Date",
          dataKey: "travel_date",
        },
      ];
      autoTable(pdf, {
        columns,
        body: self.manifest,
        margin: { left: 10, right: 10 },
        didParseCell: function (data) {
          if (data.column.dataKey === "travel_date") {
            if (data.row.raw.bus && typeof data.row.raw.bus === "object") {
              data.cell.text = `${data.row.raw.travel_date} ${data.row.raw.board_time}`;
            }
          } else if (data.column.dataKey === "bus_name") {
            if (data.row.raw.bus && typeof data.row.raw.bus === "object") {
              data.cell.text = `${data.row.raw.bus.formatted_name}`;
            }
          }
        },
      });
      pdf.text(`Passenger Manifest Of ${self.manifestBus}`, 30, 25);
      this.addPdfFooters(pdf);
      pdf.save(
        `Passenger_Manifest_of${self.manifestBus}_on_${self.travelDate}.pdf`
      );
    },
  },
  created() {},
};
</script>
