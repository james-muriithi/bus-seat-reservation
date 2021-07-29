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

      <div slot="table-actions" class="mt-2 mb-3"></div>

      <template slot="table-row" slot-scope="props">
        <span v-if="props.column.field == 'actions'">
          <a
            title="Delete"
            href="#"
            @click.prevent="deleteRating({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>

        <span v-else-if="props.column.field == 'rated_by'">
          <span>{{ props.row.rated_by.name }}</span>
        </span>

        <span v-else-if="props.column.field == 'bus'">
          <a :href="`/admin/buses/${props.row.bus.id}`">{{
            props.row.bus.bus_reg_no
          }}</a>
        </span>

        <span v-else-if="props.column.field == 'bus_quality'">
          <star-rating
            :rating="+props.row.bus_quality"
            :read-only="true"
            :increment="0.5"
            :star-size="20"
            active-color="var(--primary)"
          ></star-rating>
        </span>
        <span v-else-if="props.column.field == 'punctuality'">
          <star-rating
            v-if="props.row.punctuality"
            :rating="+props.row.punctuality"
            :read-only="true"
            :increment="0.5"
            :star-size="20"
            active-color="var(--primary)"
          ></star-rating>
        </span>

        <span v-else-if="props.column.field == 'staff_behaviour'">
          <star-rating
            v-if="props.row.staff_behaviour"
            :rating="+props.row.staff_behaviour"
            :read-only="true"
            :increment="0.5"
            :star-size="20"
            active-color="var(--primary)"
          ></star-rating>
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
import StarRating from "vue-star-rating";
const DeleteRating = () => import("./DeleteRating.vue");

export default {
  components: { DeleteRating, StarRating },
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
          label: "Bus",
          field: "bus",
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
        .get("/admin/bus-ratings")
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
