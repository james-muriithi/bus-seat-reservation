<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="priceVariations"
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
          data-target="#create-price-variation"
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
            @click.prevent="editSeatClass({ ...props.row })"
            title="Edit"
            class="pr-1"
          >
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <a
            title="Delete"
            href="#"
            @click.prevent="deleteSeatClass({ ...props.row })"
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

        <span v-else-if="props.column.field == 'color'">
          <div
            :style="{
              background: props.row.color,
              width: '30px',
              height: '30px',
              borderRadius: '5px'
            }"
          ></div>
        </span>
      </template>
    </vue-good-table>

    <create-price-variation @update="fetchPriceVariations(false)"></create-price-variation>

    <!-- <edit-seat-class
      :seatClass="selectedSeatClass"
      @update="fetchPriceVariations(false)"
    ></edit-seat-class> -->

    <!-- <delete-seat-class
      @update="fetchPriceVariations(false)"
      :seatClass="selectedSeatClass"
    ></delete-seat-class> -->
  </div>
</template>

<script>
// const EditSeatClass = () => import("./EditSeatClass.vue");
const CreatePriceVariation = () => import("./CreatePriceVariation.vue");
// const DeleteSeatClass = () => import("./DeleteSeatClass.vue");

export default {
  components: { CreatePriceVariation },
  data() {
    return {
      isLoading: false,
      priceVariations: [],
      selectedPriceVariation: {},
    };
  },
  computed: {
    columns() {
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
          label: "Drop Off Point",
          field: "drop_point",
        },
        {
          label: "fare",
          field: "fare",
          html: true,
        },
        {
          label: "Created At",
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
    fetchPriceVariations(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      axios
        .get("/admin/route-price-variations")
        .then((res) => {
          this.priceVariations = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
    editPriceVariation(priceVariation) {
      this.selectedPriceVariation = priceVariation;
      $("#edit-price-variation").modal("show");
    },
    deletePriceVariation(priceVariation) {
      this.selectedPriceVariation = priceVariation;
      $("#delete-price-variation").modal("show");
    },
  },
  created() {
    this.fetchPriceVariations();
  },
};
</script>
