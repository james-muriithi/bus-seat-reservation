<template>
  <div class="modal" id="create-dropoff-point">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Dropoff Point</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="createDropoffPoint">
            <form @submit.prevent="createDropoffPoint" ref="form">
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
                        v-model.trim="dropOffPoint.route_id"
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
                      <label for="name">Dropoff Point</label>
                      <input
                        type="text"
                        placeholder="Enter dropoff point"
                        aria-describedby="Pickup-Point-feedback"
                        v-model.trim="dropOffPoint.drop_off_point"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div
                        id="Dropoff-Point-feedback"
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
                      <label for="board-time">Dropoff Time</label>
                      <vue-timepicker
                        format="HH:mm"
                        aria-describedby="drop-time-feedback"
                        v-model.trim="dropOffPoint.drop_time"
                        :input-class="`form-control w-100 ${getValidationState(
                          validationContext
                        )}`"
                        :minute-interval="5"
                        manual-input
                      />

                      <div
                        id="drop-time-feedback"
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
                        placeholder="Enter dropoff point address"
                        aria-describedby="daddress-feedback"
                        v-model.trim="dropOffPoint.address"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div
                        id="daddress-feedback"
                        class="invalid-feedback w-100"
                      >
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
                        placeholder="Enter dropoff nearest landmark"
                        aria-describedby="dlandmark-feedback"
                        v-model.trim="dropOffPoint.landmark"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div
                        id="dlandmark-feedback"
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
                          id="d-status"
                          v-model="dropOffPoint.status"
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
  props:{
      defaultRoute: {
          default: ""
      },
  },
  emits: ["update"],
  data() {
    return {
      dropOffPoint: {
        route_id: this.defaultRoute,
        status: 1,
        drop_time: ""
      },
      routes: [],
    };
  },
  methods: {
    resetForm() {
      this.dropOffPoint = {
        route_id: this.defaultRoute,
        status: 1,
        drop_time: ""
      };
      this.$nextTick(() => {
        this.$refs.createDropoffPoint.reset();
      });
    },
    createDropoffPoint() {
      this.$refs.createDropoffPoint.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post("/admin/drop-off-points", this.dropOffPoint)
            .then((res) => {
              //   this.$store.dispatch("stopLoading");
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast('Drop off point created successfully')
              });
            })
            .catch((res) => {
              this.$store.dispatch("stopLoading");
              this.showErrorToast('There was a problem creating the drop point!')
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
      $("#create-dropoff-point").modal("hide");
    },
  },
  created() {
    const self = this;
    self.fetchRoutes();
    $(function () {
      $("#create-dropoff-point").on("show.bs.modal", function (e) {
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
