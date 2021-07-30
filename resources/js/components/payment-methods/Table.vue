<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="paymentMethods"
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
          data-target="#create-payment-method"
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
            @click.prevent="editPaymentMethod({ ...props.row })"
            title="Edit"
            class="pr-1"
          >
            <i class="fa fa-pencil-alt fs-16 text-success"></i>
          </a>
          <a
            title="Delete"
            href="#"
            @click.prevent="deletePaymentMethod({ ...props.row })"
          >
            <i class="fa fa-trash fs-16 text-danger"></i>
          </a>
        </span>
        <span v-else-if="props.column.field == 'icon'">
          <i :class="props.row.icon"></i>
        </span>
      </template>
    </vue-good-table>

    <create-payment-method @update="fetchPaymentMethods(false)"></create-payment-method>
    <edit-payment-method
      :paymentMethod="selectedPaymentMethod"
      @update="fetchPaymentMethods(false)"
    ></edit-payment-method>
    <delete-payment-method
      @update="fetchPaymentMethods(false)"
      :paymentMethod="selectedPaymentMethod"
    ></delete-payment-method>
  </div>
</template>

<script>
const EditPaymentMethod = () => import("./EditPaymentMethod.vue");
const CreatePaymentMethod = () => import("./CreatePaymentMethod.vue");
const DeletePaymentMethod = () => import("./DeletePaymentMethod.vue");

export default {
  components: { CreatePaymentMethod, EditPaymentMethod, DeletePaymentMethod },
  data() {
    return {
      isLoading: false,
      paymentMethods: [],
      selectedPaymentMethod: {},
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
    fetchPaymentMethods(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      axios
        .get("/admin/payment-methods")
        .then((res) => {
          this.paymentMethods = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
    editPaymentMethod(paymentMethod) {
      this.selectedPaymentMethod = paymentMethod;
      $("#edit-payment-method").modal("show");
    },
    deletePaymentMethod(paymentMethod) {
      this.selectedPaymentMethod = paymentMethod;
      $("#delete-payment-method").modal("show");
    },
  },
  created() {
    this.fetchPaymentMethods();
  },
};
</script>
