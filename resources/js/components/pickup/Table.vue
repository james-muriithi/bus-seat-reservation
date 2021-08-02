<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="pickupPoints"
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
          data-target="#create-pickup-point"
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
            @click.prevent="editPickupPoint({ ...props.row })"
            title="Edit"
            class="pr-1"
          >
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <a
            title="Delete"
            href="#"
            @click.prevent="deletePickupPoint({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>
        <span v-else-if="props.column.field == 'route'">
          {{ props.row.route.route_name }}
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

    <create-pickup-point
        :default-route="defaultCreateRoute"
      @update="fetchPickupPoints(false)"
    ></create-pickup-point>
    <!-- <edit-pickup-point
      :amenity="selectedAmenity"
      @update="fetchAmenities(false)"
    ></edit-pickup-point> -->
    <!-- <delete-pickup-point
      @update="fetchAmenities(false)"
      :amenity="selectedAmenity"
    ></delete-pickup-point> -->
  </div>
</template>

<script>
const EditPickupPoint = () => import("./EditPickupPoint.vue");
const CreatePickupPoint = () => import("./CreatePickupPoint.vue");
const DeletePickupPoint = () => import("./DeletePickupPoint.vue");

export default {
  components: { CreatePickupPoint, EditPickupPoint, DeletePickupPoint },
  props: {
    smallTable: {
      type: Boolean,
    },
    defaultCreateRoute: {
      type: Number,
      default: "",
    },
  },
  data() {
    return {
      isLoading: false,
      pickupPoints: [],
      selectedPickupPoint: {},
    };
  },
  computed: {
    columns() {
      if (this.smallTable) {
        return [
          {
            label: "Pickup Point",
            field: "pickup_point",
          },
          {
            label: "Pickup Time",
            field: "pickup_time",
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
          label: "Pickup Point",
          field: "pickup_point",
        },
        {
          label: "Pickup Time",
          field: "pickup_time",
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
    fetchPickupPoints(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      let url = "/admin/pickup-points"

      if (this.defaultCreateRoute) {
          url += `?route=${this.defaultCreateRoute}`
      }

      axios
        .get(url)
        .then((res) => {
          this.pickupPoints = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
    editPickupPoint(amenity) {
      this.selectedAmenity = amenity;
      $("#edit-amenity").modal("show");
    },
    deletePickupPoint(amenity) {
      this.selectedAmenity = amenity;
      $("#delete-amenity").modal("show");
    },
  },
  created() {
    this.fetchPickupPoints();
  },
};
</script>
