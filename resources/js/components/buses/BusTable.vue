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
          <a
            href="#"
            title="Edit"
            class="pr-1"
          >
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <a
            title="Delete"
            href="#"
            @click.prevent="deleteBus({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>
        <!-- <span v-else-if="props.column.field == 'icon'">
          <i :class="props.row.icon"></i>
        </span> -->
      </template>
    </vue-good-table>

    <delete-bus
      @update="fetchAmenities(false)"
      :bus="selectedAmenity"
    ></delete-bus>

  </div>
</template>

<script>
const DeleteBus = () => import("./DeleteBus.vue");

export default {
  components: { DeleteBus },
  data() {
    return {
      isLoading: false,
      buses: [],
      selectedBus: {},
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

      axios
        .get("/admin/buses")
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
    deleteBus(bus) {
      this.selectedBus = bus;
    //   $("#delete-bus").modal("show");
    },
  },
  created() {
    this.fetchBuses();
  },
};
</script>
