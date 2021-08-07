<template>
  <div class="modal" id="edit-amenity">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Amenity</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="editAmenity">
            <form @submit.prevent="editAmenity" ref="form">
              <div class="form-row">
                <div class="col-md-12">
                  <validation-provider
                    name="Amenity Name"
                    :rules="{ required: true, min: 3, max: 20 }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input
                        type="text"
                        placeholder="Enter amenity name"
                        aria-describedby="Name-feedback"
                        v-model.trim="amenity.name"
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
                    name="Amenity Icon"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="icon">Icon</label>

                      <div class="input-group iconpicker-container">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i :class="amenity.icon"></i>
                          </div>
                        </div>
                        <input
                          data-placement="bottomRight"
                          class="
                            form-control
                            iconpicker-element iconpicker-input
                          "
                          id="icon"
                          placeholder="Select icon"
                          aria-describedby="icon-feedback"
                          v-model.trim="amenity.icon"
                          :class="`form-control ${getValidationState(
                            validationContext
                          )}`"
                          readonly
                        />
                      </div>

                      <div id="icon-feed back" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>
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
    amenity: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    editAmenity() {
      this.$refs.editAmenity.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post(`/admin/amenities/${this.amenity.id}`, {
              name: this.amenity.name,
              icon: this.amenity.icon,
              _method: "PUT",
            })
            .then((res) => {
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast(`${this.amenity.name} updated successfully.`);
              });
            })
            .catch((res) => {
              console.log(res);
              this.$store.dispatch("stopLoading");
              this.showErrorToast("There was error editing the amenity");
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
      $("#edit-amenity").modal("hide");
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
