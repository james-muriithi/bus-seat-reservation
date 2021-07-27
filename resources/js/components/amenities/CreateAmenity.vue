<template>
  <div class="modal fade" id="create-amenity">
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
            <form @submit.prevent="createAmenity">
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
                    name="Amenity Name"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="icon">Icon</label>
                      <input
                        type="text"
                        id="icon"
                        placeholder="Select icon"
                        aria-describedby="icon-feedback"
                        v-model.trim="amenity.icon"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="icon-feed back" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                    >
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
export default {
  data() {
    return {
      amenity: {},
    };
  },
  methods: {
    resetForm() {
      this.amenity = {
        name: "",
        icon: "",
      };
    },
    createAmenity() {
      this.$refs.createAmenity.validate().then((valid) => {
        if (valid) {
          console.log(amenity);
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
  },
};
</script>
