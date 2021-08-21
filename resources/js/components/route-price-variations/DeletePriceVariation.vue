<template>
  <div class="modal" id="delete-price-variation">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Price Variation</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-2">
            <p>
              Are you sure you want to delete price variation?
            </p>
          </div>

          <div class="col-12 mt-3 text-right">
            <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" @click="deletePriceVariation">
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
    seatClass: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    deletePriceVariation() {
      this.$store.dispatch("startLoading");
      axios
        .post(`/admin/route-price-variations/${this.priceVariation.id}`, {
          _method: "DELETE",
        })
        .then((res) => {
          this.closeModal();

          this.$nextTick(() => {
            this.$emit("update");
            this.showSuccessToast('Price variation deleted successfully!')
          });
        })
        .catch((res) => {
          this.closeModal();
          this.$store.dispatch("stopLoading");
          this.showErrorToast('There was an error deleting the price variation!')
        });
    },
    closeModal() {
      $("#delete-price-variation").modal("hide");
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
