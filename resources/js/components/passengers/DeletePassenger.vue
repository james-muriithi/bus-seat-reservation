<template>
  <div class="modal" id="delete-passenger">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Passenger</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-2">
            <p>
              Are you sure you want to delete passenger
              <b>{{ `${passenger.name}` }}</b
              >?
            </p>
          </div>

          <div class="col-12 mt-3 text-right">
            <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" @click="deletePassenger">
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
    passenger: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    deletePassenger() {
      this.$store.dispatch("startLoading");
      axios
        .post(`/admin/passengers/${this.passenger.id}`, {
          _method: "DELETE",
        })
        .then((res) => {
          this.closeModal();

          this.$nextTick(() => {
            this.$emit("update");
            this.showSuccessToast("Passenger deleted successfully");
          });
        })
        .catch((res) => {
          this.closeModal();
          this.$store.dispatch("stopLoading");
          this.showErrorToast("There was a problem deleting the passenger");
        });
    },
    closeModal() {
      $("#delete-passenger").modal("hide");
    },
  },
};
</script>
<style>
.fade:not(.show) {
  opacity: 1;
}
</style>
