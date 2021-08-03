<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="dropoffPoints"
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
          class="btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple"
          data-toggle="modal"
          data-target="#create-dropoff-point"
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
            @click.prevent="editDropoffPoint({ ...props.row })"
            title="Edit"
            class="pr-1"
          >
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <a
            title="Delete"
            href="#"
            @click.prevent="deleteDropoffPoint({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>
        <span v-else-if="props.column.field == 'route'">
          <a :href="`/admin/routes/${props.row.route.id}`">{{
            props.row.route.route_name
          }}</a>
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

    <create-drop-off-point
      :default-route="defaultCreateRoute"
      @update="fetchDropoffPoints(false)"
    ></create-drop-off-point>

    <edit-drop-off-point
      :dropOffPoint="selectedDropoffPoint"
      @update="fetchDropoffPoints(false)"
    ></edit-drop-off-point>

    <delete-drop-off-point
      @update="fetchDropoffPoints(false)"
      :dropOffPoint="selectedDropoffPoint"
    ></delete-drop-off-point>
  </div>
</template>

<script>
const EditDropOffPoint = () => import("./EditDropOffPoint.vue");
const CreateDropOffPoint  = () => import("./CreateDropOffPoint.vue");
const DeleteDropOffPoint = () => import("./DeleteDropOffPoint.vue");

export default {
  components: { CreateDropOffPoint, EditDropOffPoint, DeleteDropOffPoint },
  props: {
    smallTable: {
      type: Boolean,
    },
    defaultCreateRoute: {
      default: "",
    },
  },
  data() {
    return {
      isLoading: false,
      dropoffPoints: [],
      selectedDropoffPoint: {},
    };
  },
  computed: {
    columns() {
      if (this.smallTable) {
        return [
          {
            label: "Dropoff Point",
            field: "drop_off_point",
          },
          {
            label: "Dropoff Time",
            field: "drop_time",
          },
          {
            label: "Status",
            field: "status",
            html: true,
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
      }
      return [
        {
          label: "Route",
          field: "route",
        },
        {
          label: "Dropoff Point",
          field: "drop_off_point",
        },
        {
          label: "Dropoff Time",
          field: "drop_time",
        },
        {
          label: "Address",
          field: "address",
        },
        {
          label: "Landmark",
          field: "landmark",
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
    fetchDropoffPoints(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      let url = "/admin/drop-off-points";

      if (this.defaultCreateRoute) {
        url += `?route=${this.defaultCreateRoute}`;
      }

      axios
        .get(url)
        .then((res) => {
          this.dropoffPoints = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
    editDropoffPoint(DropoffPoint) {
      this.selectedDropoffPoint = DropoffPoint;
      $("#edit-dropoff-point").modal("show");
    },
    deleteDropoffPoint(DropoffPoint) {
      this.selectedDropoffPoint= DropoffPoint;
      $("#delete-dropoff-point").modal("show");
    },
  },
  created() {
    this.fetchDropoffPoints();
  },
};
</script>
