<template>
  <div class="modal" id="delete-currency">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Currency</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-2">
            <p>
              Are you sure you want to delete currency <b>{{ currency.currency_name }}</b>?
            </p>
          </div>

          <div class="col-12 mt-3 text-right">
            <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" @click="deleteCurrency">
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
    currency: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    deleteCurrency() {
      this.$store.dispatch("startLoading");
      axios
        .post(`/admin/currencies/${this.busType.id}`, {
          _method: "DELETE",
        })
        .then((res) => {
          this.closeModal();

          this.$nextTick(() => {
            this.$emit("update");
            this.showSuccessToast('Currency deleted successfully')
          });
        })
        .catch((res) => {
          this.closeModal();
          this.$store.dispatch("stopLoading");
          this.showErorrToast('There was a problem deleting the currency')
        });
    },
    closeModal() {
      $("#delete-currency").modal("hide");
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
