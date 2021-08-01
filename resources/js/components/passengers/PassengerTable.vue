<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="passengers"
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
          href="/admin/passengers/create"
        >
          <span class="ul-btn__icon">
            <i data-feather="plus-circle" class="feather-icon"></i>
          </span>
          <span class="ul-btn__text ml-1">Create</span>
        </a>
      </div>

      <template slot="table-row" slot-scope="props">
        <span v-if="props.column.field == 'actions'">
            <!-- view passenger -->
            <a
            :href="`/admin/passengers/${props.row.id}`"
            title="View"
            class="pr-1"
          >
            <i class="ti-eye fs-16 text-info"></i>
          </a>
          <!-- edit passenger -->

          <!-- delete passenger -->
          <a
            title="Delete"
            href="#"
            @click.prevent="deletePassenger({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>
        <span v-else-if="props.column.field == 'name'">
            <img
              class="img-thumbnail img-fluid"
              height="50"
              width="50"
              :src="props.row.avatar.thumbnail"
              alt="image"
              v-if="props.row.avatar"
            />
            {{ props.row.name }}
          </span>
      </template>
    </vue-good-table>

    <delete-passenger
      @update="fetchPassengers(false)"
      :passenger="selectedPassenger"
    ></delete-passenger>

  </div>
</template>

<script>
const DeletePassenger = () => import("./DeletePassenger.vue");

export default {
  components: { DeletePassenger },
  data() {
    return {
      isLoading: false,
      passengers: [],
      selectedPassenger: {},
    };
  },
  computed: {
    columns() {
      return [
        {
          label: "Name",
          field: "name",
        },
        {
          label: "Mobile",
          field: "mobile",
        },
        {
          label: "Email",
          field: "email",
        },
        {
          label: "Gender",
          field: "gender",
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
    fetchPassengers(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      axios
        .get("/admin/passengers")
        .then((res) => {
          this.passengers = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
    deletePassenger(passenger) {
      this.selectedPassenger = passenger;
      $("#delete-passenger").modal("show");
    },
  },
  created() {
    this.fetchPassengers();
  },
};
</script>
