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
            @click.prevent="editPriceVariation({ ...props.row })"
            title="Edit"
            class="pr-1"
          >
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <a
            title="Delete"
            href="#"
            @click.prevent="deletePriceVariation({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>

        <span v-else-if="props.column.field == 'route'">
          {{ props.row.route.bus.formatted_name }}
          {{ props.row.route.route_name }}
        </span>

        <span v-else-if="props.column.field == 'pickup_point'">
          {{ props.row.pickup_point.pickup_point }}
        </span>

        <span v-else-if="props.column.field == 'drop_point'">
          {{ props.row.drop_point.drop_off_point }}
        </span>

        <span v-else-if="props.column.field == 'fare'">
          <span v-if="props.row.seatClassesFare.length > 0">
            <span
              class="badge py-1 px-2 badge-success mr-1"
              v-for="seatClass in props.row.seatClassesFare"
              :key="seatClass.id"
            >
              {{ seatClass.name }} - {{ seatClass.currencyCode
              }}{{ seatClass.fare }}
            </span>
          </span>
          <span v-else>
            {{ props.row.fare }}
          </span>
        </span>
      </template>
    </vue-good-table>

    <create-price-variation
      @update="fetchPriceVariations(false)"
    ></create-price-variation>

    <edit-price-variation
      :priceVariation="selectedPriceVariation"
      @update="fetchPriceVariations(false)"
    ></edit-price-variation>

    <delete-price-variation
      @update="fetchPriceVariations(false)"
      :seatClass="selectedPriceVariation"
    ></delete-price-variation>
  </div>
</template>

<script>
const EditPriceVariation = () => import("./EditPriceVariation.vue");
const CreatePriceVariation = () => import("./CreatePriceVariation.vue");
const DeletePriceVariation = () => import("./DeletePriceVariation.vue");

export default {
  components: { CreatePriceVariation, EditPriceVariation, DeletePriceVariation },
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
