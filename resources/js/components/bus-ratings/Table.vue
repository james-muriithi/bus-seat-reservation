<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="ratings"
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

      </div>

      <template slot="table-row" slot-scope="props">
        <span v-if="props.column.field == 'actions'">
          class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <a
            title="Delete"
            href="#"
            @click.prevent="deleteRating({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>

        <span v-else-if="props.column.field == 'icon'">
          <i :class="props.row.icon"></i>
        </span>
      </template>
    </vue-good-table>
    <delete-rating
      @update="fetchRatings(false)"
      :rating="selctedRating"
    ></delete-rating>
  </div>
</template>

<script>
const DeleteRating = () => import("./DeleteRating.vue");

export default {
  components: { DeleteRating },
  data() {
    return {
      isLoading: false,
      ratings: [],
      selctedRating: {},
    };
  },
  computed: {
    columns() {
      return [
        {
          label: "Passenger",
          field: "rated_by",
        },
        {
          label: "Bus Quality",
          field: "bus_quality",
          html: true,
        },
        {
          label: "Punctuality",
          field: "punctuality",
          html: true,
        },
        {
          label: "Staff Behavior",
          field: "staff_behaviour",
          html: true,
        },
        {
          label: "Comment",
          field: "comment",
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
    fetchRatings(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      axios
        .get("/admin/ratings")
        .then((res) => {
          this.ratings = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
    deleteRating(rating) {
      this.selctedRating = rating;
      $("#delete-rating").modal("show");
    },
  },
  created() {
    this.fetchRatings();
  },
};
</script>
