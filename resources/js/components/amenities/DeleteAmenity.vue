<template>
  <div class="modal" id="delete-amenity">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Amenity</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-2">
            <p>
              Are you sure you want to delete <b>{{ amenity.name }}</b> amenity?
            </p>
          </div>

          <div class="col-12 mt-3 text-right">
            <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" @click="deleteAmenity">
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
    amenity: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    deleteAmenity() {
      this.$store.dispatch("startLoading");
      axios
        .post(`/admin/amenities/${this.amenity.id}`, {
          _method: "DELETE",
        })
        .then((res) => {
          this.closeModal();

          this.$nextTick(() => {
            this.$emit("update");
            this.showSuccessToast(`Amenity was deleted successfully`);
          });
        })
        .catch((res) => {
          this.closeModal();
          this.$store.dispatch("stopLoading");
          this.showErrorToast("There was error deleting the amenity");
        });
    },
    closeModal() {
      $("#delete-amenity").modal("hide");
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
