<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="amenities"
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
          data-target="#create-amenity"
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
            @click.prevent="editAmenity({ ...props.row })"
            title="Edit"
            class="pr-1"
          >
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <a
            title="Delete"
            href="#"
            @click.prevent="deleteAmenity({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>
        <span v-else-if="props.column.field == 'icon'">
          <i :class="props.row.icon"></i>
        </span>
      </template>
    </vue-good-table>

    <create-amenity @update="fetchAmenities(false)"></create-amenity>
    <edit-amenity
      :amenity="selectedAmenity"
      @update="fetchAmenities(false)"
    ></edit-amenity>
    <delete-amenity
      @update="fetchAmenities(false)"
      :amenity="selectedAmenity"
    ></delete-amenity>
  </div>
</template>

<script>
const EditAmenity = () => import("./EditAmenity.vue");
const CreateAmenity = () => import("./CreateAmenity.vue");
const DeleteAmenity = () => import("./DeleteAmenity.vue");

export default {
  components: { CreateAmenity, EditAmenity, DeleteAmenity },
  data() {
    return {
      isLoading: false,
      amenities: [],
      selectedAmenity: {},
    };
  },
  computed: {
    columns() {
      return [
        {
          label: "Amenity",
          field: "name",
        },
        {
          label: "Icon",
          field: "icon",
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
    fetchAmenities(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      axios
        .get("/admin/amenities")
        .then((res) => {
          this.amenities = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
    editAmenity(amenity) {
      this.selectedAmenity = amenity;
      $("#edit-amenity").modal("show");
    },
    deleteAmenity(amenity) {
      this.selectedAmenity = amenity;
      $("#delete-amenity").modal("show");
    },
  },
  created() {
    this.fetchAmenities();
  },
};
</script>
