<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="busTypes"
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
          class="btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple"
          data-toggle="modal"
          data-target="#create-bus-type"
        >
          <span class="ul-btn__icon">
            <i data-feather="plus-circle" class="feather-icon"></i>
          </span>
          <span class="ul-btn__text ml-1">Create</span>
        </button>
      </div>

      <template slot="table-row" slot-scope="props">
        <span v-if="props.column.field == 'actions'">
          <a
            href="#"
            @click.prevent="editBusType({ ...props.row })"
            title="Edit"
            class="pr-1"
          >
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <a
            title="Delete"
            href="#"
            @click.prevent="deleteBusType({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
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

    <create-bus-type @update="fetchBusTypes(false)"></create-bus-type>
    <edit-bus-type
      :busType="selectedBusType"
      @update="fetchBusTypes(false)"
    ></edit-bus-type>
    <delete-bus-type
      @update="fetchBusTypes(false)"
      :busType="selectedBusType"
    ></delete-bus-type>
  </div>
</template>

<script>
const EditBusType = () => import("./EditBusType.vue");
const CreateBusType = () => import("./CreateBusType.vue");
const DeleteBusType = () => import("./DeleteBusType.vue");

export default {
  components: { CreateBusType, EditBusType, DeleteBusType },
  data() {
    return {
      isLoading: false,
      busTypes: [],
      selectedBusType: {},
    };
  },
  computed: {
    columns() {
      return [
        {
          label: "Bus Type",
          field: "bus_type",
        },
        {
          label: "Status",
          field: "status",
          html: true,
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
    fetchBusTypes(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      axios
        .get("/admin/bus-types")
        .then((res) => {
          this.busTypes = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
    editBusType(busType) {
      this.selectedBusType = busType;
      $("#edit-bus-type").modal("show");
    },
    deleteBusType(busType) {
      this.selectedBusType = busType;
      $("#delete-bus-type").modal("show");
    },
  },
  created() {
    this.fetchBusTypes();
  },
};
</script>
