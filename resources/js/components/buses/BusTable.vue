<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="buses"
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
        initialSortBy: { field: 'created_at', type: 'desc' },
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
          @click="Buses_PDF"
        >
          <i class="fa fa-file-pdf"></i> PDF
        </button>
        <a
          class="btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple"
          href="/admin/buses/create"
        >
          <span class="ul-btn__icon">
            <i data-feather="plus-circle" class="feather-icon"></i>
          </span>
          <span class="ul-btn__text ml-1">Create</span>
        </a>
      </div>

      <template slot="table-row" slot-scope="props">
        <span v-if="props.column.field == 'actions'">
          <!-- view bus -->
          <a :href="`/admin/buses/${props.row.id}`" title="View" class="pr-1">
            <i class="ti-eye fs-16 text-info"></i>
          </a>
          <!-- edit bus -->
          <a
            :href="`/admin/buses/${props.row.id}/edit`"
            title="Edit"
            class="pr-1"
          >
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <!-- delete bus -->
          <a
            title="Delete"
            href="#"
            @click.prevent="deleteBus({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>

        <span v-else-if="props.column.field == 'bus_type'">
          {{ props.row.bus_type.bus_type }}
        </span>

        <span v-else-if="props.column.field == 'amenities'">
          <span
            class="badge py-1 px-2 badge-primary m-1"
            v-for="amenity in props.row.amenities"
            :key="amenity.name"
          >
            {{ amenity.name }}
          </span>
        </span>

        <span v-else-if="props.column.field == 'seat_classes'">
          <span
            class="badge py-1 px-2 badge-success m-1"
            v-for="seatClass in props.row.seat_classes"
            :key="seatClass.id"
          >
            {{ seatClass.name }}
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

    <delete-bus @update="fetchBuses(false)" :bus="selectedBus"></delete-bus>

    <!-- filter -->
    <filter-sidebar :open="filterOpen" @close="closeFilter">
      <div class="px-3 py-2">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="Bus">Bus Name</label>
              <input
                type="text"
                name="bus_reg"
                v-model="filter.bus_name"
                class="form-control"
                placeholder="Filter by bus name"
              />
            </div>

            <div class="form-group">
              <label for="Bus">Bus Reg No</label>
              <input
                type="text"
                name="bus_reg"
                v-model="filter.bus_reg_no"
                class="form-control"
                placeholder="Filter by bus registration"
              />
            </div>

            <div class="form-group">
              <label for="Bus">Bus Type</label>
              <select2
                id="pp"
                aria-describedby="bus-feedback"
                :options="bus_types"
                v-model="filter.bus_type"
                :settings="{
                  theme: 'bootstrap',
                  multiple: false,
                  closeOnSelect: true,
                }"
              >
              </select2>
            </div>
            <div class="form-group">
              <label for="Bus">Status</label>
              <select class="form-control" v-model="filter.status">
                <option value="">--Filter by status--</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
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
const DeleteBus = () => import("./DeleteBus.vue");
import Select2 from "v-select2-component";
import "select2-bootstrap-theme/dist/select2-bootstrap.min.css";

export default {
  components: { DeleteBus, Select2 },
  data() {
    return {
      isLoading: false,
      buses: [],
      selectedBus: {},
      filterOpen: false,
      bus_types: [],
      filter: {
        bus_name: "",
        bus_reg_no: "",
        bus_type: "",
        status: "",
      },
    };
  },
  computed: {
    columns() {
      return [
        {
          label: "Bus Name",
          field: "bus_name",
        },
        {
          label: "Bus Reg No",
          field: "bus_reg_no",
        },
        {
          label: "Bus Type",
          field: "bus_type",
        },
        {
          label: "Max Seats",
          field: "max_seats",
        },
        {
          label: "Amenities",
          field: "amenities",
        },
        {
          label: "Seat Classes",
          field: "seat_classes",
        },
        {
          label: "Status",
          field: "status",
        },
        {
          label: "Cretaed At",
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
    },
  },
  methods: {
    fetchBuses(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      const params = {
        ...this.filter,
      };

      axios
        .get("/admin/buses", { params })
        .then((res) => {
          this.buses = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
    fetchBusTypes() {
      axios
        .get("/admin/bus-types", { params: { active: 1 } })
        .then((res) => {
          res.data.data.forEach((bus_type) => {
            this.bus_types.push({
              id: bus_type.id,
              text: bus_type.bus_type,
            });
          });
        })
        .catch((res) => {
          console.log(res);
        });
    },
    deleteBus(bus) {
      this.selectedBus = bus;
      $("#delete-bus").modal("show");
    },
    Buses_PDF() {
      var self = this;

      let pdf = new jsPDF("p", "pt");
      let columns = [
        {
          title: "Bus Name",
          dataKey: "bus_name",
        },
        {
          title: "Bus Reg",
          dataKey: "bus_reg_no",
        },
        {
          title: "Bus Type",
          dataKey: "bus_type",
        },
        {
          title: "Max Seats",
          dataKey: "max_seats",
        },
        {
          title: "Amenities",
          dataKey: "amenities",
        },
        {
          title: "Seat Classes",
          dataKey: "seat_classes",
        },
        {
          title: "Status",
          dataKey: "status",
        },
      ];
      autoTable(pdf, {
        columns,
        body: self.buses,
        didParseCell: function (data) {
          if (data.column.dataKey === "bus_type") {
            if (data.cell.raw.bus_type) {
              data.cell.text = data.cell.raw.bus_type || "";
            }
          } else if (data.column.dataKey === "amenities") {
            if (data.cell.raw && Array.isArray(data.cell.raw)) {
              data.cell.text =
                data.cell.raw.map((amenity) => amenity.name).join(", ") || "";
            }
          } else if (data.column.dataKey === "seat_classes") {
            if (data.cell.raw && Array.isArray(data.cell.raw)) {
              data.cell.text =
                data.cell.raw.map((seatClass) => seatClass.name).join(", ") ||
                "";
            }
          } else if (data.column.dataKey === "status") {
            if (data.cell.raw == 1 || data.cell.raw == 0) {
              data.cell.text = data.cell.raw ? "Active" : "Inactive";
            }
          }
        },
      });
      pdf.text("All Buses", 40, 25);
      this.addPdfFooters(pdf);
      pdf.save(`Buses_List-${moment().format("YYYY-MM-DD HH_mm_ss")}.pdf`);
    },
    openFilter() {
      this.filterOpen = true;
    },
    closeFilter() {
      this.filterOpen = false;
    },
    async resetFilter() {
      this.filter = {
        bus_name: "",
        bus_reg_no: "",
        bus_type: "",
        status: "",
      };

      this.$store.dispatch("startLoading");
      await this.fetchBuses();
      this.$store.dispatch("stopLoading");
    },
    async filterReservations() {
      this.$store.dispatch("startLoading");
      await this.fetchBuses();
      this.$store.dispatch("stopLoading");
    },
  },
  created() {
    this.fetchBuses();
    this.fetchBusTypes();
  },
};
</script>
