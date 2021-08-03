<template>
  <div class="modal" id="delete-dropoff-point">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Pickup Point</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-2">
            <p>
              Are you sure you want to delete <b>{{ pickupPoint.pickup_point }}</b> pickup point?
            </p>
          </div>

          <div class="col-12 mt-3 text-right">
            <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" @click="deletePickupPoint">
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
    pickupPoint: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    deletePickupPoint() {
      this.$store.dispatch("startLoading");
      axios
        .post(`/admin/pickup-points/${this.pickupPoint.id}`, {
          _method: "DELETE",
        })
        .then((res) => {
          this.closeModal();

          this.$nextTick(() => {
            this.$emit("update");
          });
        })
        .catch((res) => {
          this.closeModal();
          this.$store.dispatch("stopLoading");
        });
    },
    closeModal() {
      $("#delete-pickup-point").modal("hide");
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
