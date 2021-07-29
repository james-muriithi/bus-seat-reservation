<template>
  <div class="modal" id="edit-seat-class">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Seat Class</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="editSeatClass">
            <form @submit.prevent="editSeatClass" ref="form">
              <div class="form-row">
                <div class="col-md-12">
                  <validation-provider
                    name="Amenity Name"
                    :rules="{ required: true, min: 2, max: 20 }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input
                        type="text"
                        placeholder="Enter class name"
                        aria-describedby="Name-feedback"
                        v-model.trim="seatClass.name"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="Name-feed back" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Color"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="icon">Color</label>

                      <input
                        type="color"
                        v-model.trim="seatClass.color"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />

                      <div id="icon-feed back" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <div class="form-group">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          id="status"
                          v-model="seatClass.status"
                        />
                        Active
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-12 my-3 text-right">
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>
          </validation-observer>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import iconpicker from "fontawesome-iconpicker";
import "fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css";

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
    editSeatClass() {
      this.$refs.editSeatClass.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post(`/admin/bus-seat-classes/${this.seatClass.id}`, {
              name: this.seatClass.name,
              color: this.seatClass.color,
              status: +this.seatClass.status,
              _method: "PUT",
            })
            .then((res) => {
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
              });
            })
            .catch((res) => {
              console.log(res);
              this.$store.dispatch("stopLoading");
            });
        }
      });
    },
    //---- Validation State Form
    getValidationState({ dirty, validated, valid = null }) {
      if (dirty || validated) {
        return valid ? "is-valid" : "is-invalid";
      }
      return "";
    },
    closeModal() {
      $("#edit-seat-class").modal("hide");
    },
  },
  created() {
    const self = this;
    $(function () {
      $(".iconpicker-container").iconpicker({
        input: ".iconpicker-input", // children input selector
        inputSearch: false, // use the input as a search box too?
        container: false, //  Appends the popover to a specific element. If not set, the selected element or element parent is used
        component: ".input-group-prepend,.iconpicker-element",
        hideOnSelect: true,
      });

      $(".iconpicker-container").on("iconpickerSetValue", function (event) {
        self.amenity.icon = event.iconpickerValue;
      });
    });
  },
};
</script>
<style>
.fade:not(.show) {
  opacity: 1;
}
</style>
