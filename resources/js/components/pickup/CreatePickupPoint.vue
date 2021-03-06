<template>
  <div class="modal" id="create-pickup-point">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Pickup Point</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="createPickupPoint">
            <form @submit.prevent="createPickupPoint" ref="form">
              <div class="form-row">
                <div class="col-md-12">
                  <validation-provider
                    name="Bus"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Route</label>
                      <select2
                        id="amenities"
                        aria-describedby="bus-feedback"
                        v-model.trim="pickupPoint.route_id"
                        :options="routes"
                        :settings="{
                          theme: 'bootstrap',
                          multiple: false,
                          closeOnSelect: true,
                        }"
                        required
                      >
                      </select2>
                      <div id="route-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Pickup Point"
                    :rules="{ required: true, min: 2, max: 20 }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Pickup Point</label>
                      <input
                        type="text"
                        placeholder="Enter pickup point"
                        aria-describedby="Pickup-Point-feedback"
                        v-model.trim="pickupPoint.pickup_point"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div
                        id="Pickup-Point-feedback"
                        class="invalid-feedback w-100"
                      >
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Pickup Time"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="board-time">Pickup Time</label>
                      <vue-timepicker
                        format="HH:mm"
                        aria-describedby="drop-time-feedback"
                        v-model.trim="pickupPoint.pickup_time"
                        :input-class="`form-control w-100 ${getValidationState(
                          validationContext
                        )}`"
                        :minute-interval="5"
                        manual-input
                      />

                      <div
                        id="board-time-feedback"
                        :class="`invalid-feedback w-100 ${
                          validationContext.errors[0] ? 'd-block' : ''
                        }`"
                      >
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Address"
                    :rules="{ required: false }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Address</label>
                      <input
                        type="text"
                        placeholder="Enter pickup point address"
                        aria-describedby="Pickup-Point-feedback"
                        v-model.trim="pickupPoint.address"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="address-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Landmark"
                    :rules="{ required: false }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Landmark</label>
                      <input
                        type="text"
                        placeholder="Enter pickup point nearest landmark"
                        aria-describedby="Pickup-Point-feedback"
                        v-model.trim="pickupPoint.landmark"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div
                        id="landmark-feedback"
                        class="invalid-feedback w-100"
                      >
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
                          v-model="pickupPoint.status"
                        />
                        Status
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
import VueTimepicker from "vue2-timepicker";
import "vue2-timepicker/dist/VueTimepicker.css";
import Select2 from "v-select2-component";
import "select2-bootstrap-theme/dist/select2-bootstrap.min.css";

export default {
  components: { VueTimepicker, Select2 },
  props: {
    defaultRoute: {
      default: "",
    },
  },
  emits: ["update"],
  data() {
    return {
      pickupPoint: {
        route_id: this.defaultRoute,
        status: 1,
        pickup_time: "",
      },
      routes: [],
    };
  },
  methods: {
    resetForm() {
      this.pickupPoint = {
        route_id: this.defaultRoute,
        status: 1,
        pickup_time: "",
      };
      this.$nextTick(() => {
        this.$refs.createPickupPoint.reset();
      });
    },
    createPickupPoint() {
      this.$refs.createPickupPoint.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post("/admin/pickup-points", this.pickupPoint)
            .then((res) => {
              //   this.$store.dispatch("stopLoading");
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast("Pickup point created successfully");
              });
            })
            .catch((res) => {
              this.$store.dispatch("stopLoading");
              this.showErrorToast(
                "There was an error creating the pickup point"
              );
            });
        }
      });
    },
    fetchRoutes(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      axios
        .get("/admin/routes")
        .then((res) => {
          this.routes = [];

          res.data.data.map((route) => {
            this.routes.push({
              id: route.id,
              text: `${route.bus.formatted_name} ${route.route_name}`
            });
          });

          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
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
      $("#create-pickup-point").modal("hide");
    },
  },
  created() {
    const self = this;
    self.fetchRoutes();
    $(function () {
      $("#create-pickup-point").on("show.bs.modal", function (e) {
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
.vue__time-picker.time-picker {
  width: 100%;
}
</style>
