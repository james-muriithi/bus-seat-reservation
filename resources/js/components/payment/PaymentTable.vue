<template>
  <div>
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>

    <vue-good-table
      v-else
      :columns="columns"
      :rows="payments"
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
          <a title="Download Invoice" href="#">
            <i class="ti-download fs-16 text-success"></i>
          </a>
        </span>

        <span v-else-if="props.column.field == 'passenger'">
          <a
            :href="`/admin/passengers/${props.row.reservation.first_passenger.id}`"
            >{{ props.row.reservation.first_passenger.name }}</a
          >
        </span>

        <span v-else-if="props.column.field == 'reservation'">
          <a :href="`/admin/reservations/${props.row.reservation.id}`">{{
            props.row.reservation.ref
          }}</a>
        </span>

        <span v-else-if="props.column.field == 'payment_method'">
          <span>
            {{ props.row.payment_method.name }}
          </span>
        </span>
      </template>
    </vue-good-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isLoading: false,
      payments: [],
      selectedPayment: {},
    };
  },
  computed: {
    columns() {
      return [
        {
          label: "Passenger",
          field: "passenger",
        },
        {
          label: "Reservation",
          field: "reservation",
        },
        {
          label: "Amount",
          field: "amount",
        },
        {
          label: "Payment Method",
          field: "payment_method",
        },
        {
          label: "Receipt",
          field: "receipt",
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
    fetchPayments(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      axios
        .get("/admin/payments")
        .then((res) => {
          this.payments = res.data.data;

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        });
    },
  },
  created() {
    this.fetchPayments();
  },
};
</script>
