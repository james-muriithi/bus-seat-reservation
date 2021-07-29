<template>
  <div class="modal" id="delete-rating">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Rating</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-2">
            <p>
              Are you sure you want to delete the rating?
            </p>
          </div>

          <div class="col-12 mt-3 text-right">
            <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" @click="deleteRating">
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
    rating: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    deleteRating() {
      this.$store.dispatch("startLoading");
      axios
        .post(`/admin/ratings/${this.rating.id}`, {
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
      $("#delete-rating").modal("hide");
    },
  },
};
</script>
<style>
.fade:not(.show) {
  opacity: 1;
}
</style>
