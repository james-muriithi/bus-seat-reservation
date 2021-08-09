<template>
  <div class="modal" id="delete-payment-method">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Payment Method</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-2">
            <p>
              Are you sure you want to delete <b>{{ paymentMethod.name }}</b>?
            </p>
          </div>

          <div class="col-12 mt-3 text-right">
            <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" @click="deletePaymentMethod">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  emits: ["update"],
  props: {
    paymentMethod: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    deletePaymentMethod() {
      this.$store.dispatch("startLoading");
      axios
        .post(`/admin/payment-methods/${this.paymentMethod.id}`, {
          _method: "DELETE",
        })
        .then((res) => {
          this.closeModal();

          this.$nextTick(() => {
            this.$emit("update");
            this.showSuccessToast('Payment method deleted successfully')
          });
        })
        .catch((res) => {
          this.closeModal();
          this.$store.dispatch("stopLoading");
          this.showErrorToast('There was a problem deleting the payment method')
        });
    },
    closeModal() {
      $("#delete-payment-method").modal("hide");
    },
  },
  created() {
    const self = this;
  },
};
</script>
<style>
.fade:not(.show) {
  opacity: 1;
}
</style>
