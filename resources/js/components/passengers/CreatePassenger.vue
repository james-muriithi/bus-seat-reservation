<template>
  <div class="modal" id="create-passenger">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Passenger</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="createPassenger">
            <form @submit.prevent="createPassenger" ref="form">
              <div class="form-row">
                <div class="col-md-12">
                  <validation-provider
                    name="Name"
                    :rules="{ required: true, min: 2, max: 20 }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input
                        type="text"
                        placeholder="Enter passenger name"
                        aria-describedby="Name-feedback"
                        v-model.trim="passenger.name"
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
                    name="Email"
                    :rules="{ required: true, email: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="icon">Email</label>

                      <input
                        type="text"
                        placeholder="Enter passenger email"
                        aria-describedby="Email-feedback"
                        v-model.trim="passenger.email"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />

                      <div id="Email-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Mobile"
                    :rules="{ required: true, regex: /^(0|\+?254)(\d){9}$/ }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="icon">Mobile</label>

                      <input
                        type="text"
                        placeholder="Enter passenger email"
                        aria-describedby="Mobile-feedback"
                        v-model.trim="passenger.mobile"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />

                      <div id="Mobile-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Age"
                    :rules="{ required: false, integer: true, min_value: 10 }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="icon">Age</label>

                      <input
                        type="text"
                        placeholder="Enter passenger age"
                        aria-describedby="Age-feedback"
                        v-model.trim="passenger.age"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />

                      <div id="Age-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Age"
                    :rules="{ required: false }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="icon">Gender</label>

                      <select
                        aria-describedby="Gender-feedback"
                        v-model.trim="passenger.gender"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      >
                        <option
                          :value="gender.value"
                          v-for="gender in genders"
                          :key="gender.value"
                        >
                          {{ gender.title }}
                        </option>
                      </select>
                      <div id="Gender-feedback" class="invalid-feedback w-100">
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
export default {
  emits: ["update"],
  data() {
    return {
      passenger: {
        name: "",
        gender: "",
        age: "",
        email: "",
        mobile: "",
      },
      genders: [
        {
          title: "--Select Gender--",
          value: "",
        },
        {
          title: "Male",
          value: "male",
        },
        {
          title: "Female",
          value: "female",
        },
        {
          title: "Prefer not to say",
          value: "pnts",
        },
      ],
    };
  },
  methods: {
    resetForm() {
      this.passenger = {
        name: "",
        gender: "",
        age: "",
        email: "",
        mobile: "",
      };
      this.$nextTick(() => {
        this.$refs.createPassenger.reset();
      });
    },
    createPassenger() {
      this.$refs.createPassenger.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post("/admin/passengers", this.passenger)
            .then((res) => {
              //   this.$store.dispatch("stopLoading");
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast("Passenger created successfully");
              });
            })
            .catch((res) => {
              this.$store.dispatch("stopLoading");
              this.showErrorToast("There was an error creating the passenger");
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
      $("#create-passenger").modal("hide");
    },
  },
  created() {
    const self = this;
    $(function () {
      $("#create-passenger").on("show.bs.modal", function (e) {
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
