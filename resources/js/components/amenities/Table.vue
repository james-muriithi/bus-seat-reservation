<template>
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
    styleClass="vgt-table tableOne table-hover"
  >
    <div slot="selected-row-actions">
      <button class="btn btn-danger btn-sm">Delete</button>
    </div>
    <div slot="table-actions" class="mt-2 mb-3">
      <a
        class="btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple"
        href="#"
      >
        <span class="ul-btn__icon">
          <i data-feather="plus-circle" class="feather-icon"></i>
        </span>
        <span class="ul-btn__text ml-1">Create</span>
      </a>
    </div>

    <template slot="table-row" slot-scope="props">
      <span v-if="props.column.field == 'actions'">
        <a href="#" title="Edit" class="pr-1">
          <i class="fa fa-pencil-alt fs-16 text-success"></i>
        </a>
        <a title="Delete" href="#">
          <i class="fa fa-trash fs-16 text-danger"></i>
        </a>
      </span>
    </template>
  </vue-good-table>
</template>

<script>
export default {
  data() {
    return {
      isLoading: false,
      amenities: [],
    };
  },
  computed: {
    columns() {
      return [
        {
          label: "Amenity",
          field: "amenity",
        },
        {
          label: "Icon",
          field: "icon",
        },
        {
          label: "Cretaed At",
          field: "created_at",
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
    fetchAmenities() {
      this.$store.dispatch("startLoading");
      this.isLoading = true;

      axios
        .get("/admin/amenities")
        .then((res) => {
          console.log(res);
          setTimeout(() => {
            this.$store.dispatch("stopLoading");
            this.isLoading = false;
          }, 1000);
        })
        .catch((res) => {
          setTimeout(() => {
            this.$store.dispatch("stopLoading");
            this.isLoading = false;
          }, 1000);
        });
    },
  },
  created() {
    this.fetchAmenities();
  },
};
</script>
