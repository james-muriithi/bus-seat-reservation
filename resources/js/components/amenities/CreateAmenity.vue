<template>
  <div class="modal" id="create-amenity">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Amenity</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="createAmenity">
            <form @submit.prevent="createAmenity" ref="form">
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
                            <i class="fas fa-archive"></i>
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
  data() {
    return {
      amenity: {
        name: "",
        icon: "fas fa-wifi",
      },
    };
  },
  methods: {
    resetForm() {
      this.amenity = {
        name: "",
        icon: "fas fa-wifi",
      };
      this.$nextTick(() => {
        this.$refs.createAmenity.reset();
      });
    },
    createAmenity() {
      this.$refs.createAmenity.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post("/admin/amenities", this.amenity)
            .then((res) => {
              //   this.$store.dispatch("stopLoading");
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast("Amenity was created successfully");
              });
            })
            .catch((res) => {
              this.$store.dispatch("stopLoading");
              this.showErrorToast("There was error creating the amenity");
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
      $("#create-amenity").modal("hide");
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

      $("#create-amenity").on("show.bs.modal", function (e) {
        self.resetForm();
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
