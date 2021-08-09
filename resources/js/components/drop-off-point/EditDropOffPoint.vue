<template>
  <div class="modal" id="edit-dropoff-point">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Dropoff Point</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="editDropoffPoint">
            <form @submit.prevent="editDropoffPoint" ref="form">
              <div class="form-row">
                <div class="col-md-12">
                  <validation-provider
                    name="Bus"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Route</label>
                      <select
                        id="max-seats"
                        aria-describedby="route-feedback"
                        v-model.trim="dropOffPoint.route_id"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      >
                        <option value="" selected>--Select Route--</option>
                        <option
                          :value="route.id"
                          v-for="route in routes"
                          :key="route.id"
                        >
                          {{ route.route_name }}
                        </option>
                      </select>
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
                        v-model.trim="dropOffPoint.drop_off_point"
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
                        v-model.trim="dropOffPoint.address"
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
                        v-model.trim="dropOffPoint.landmark"
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

export default {
  components: { VueTimepicker },
  props: {
    dropOffPoint: {
      type: Object,
      required: true,
    },
  },
  emits: ["update"],
  data() {
    return {
      routes: [],
    };
  },
  methods: {
    editDropoffPoint() {
      this.$refs.editDropoffPoint.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");

          //remove timestamps
          delete this.dropOffPoint.created_at;
          delete this.dropOffPoint.updated_at;
          delete this.dropOffPoint.deleted_at;

          axios
            .post(`/admin/drop-off-points/${this.dropOffPoint.id}`, {
              ...this.dropOffPoint,
              _method: "PUT",
            })
            .then((res) => {
              //   this.$store.dispatch("stopLoading");
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast('Drop off point updated successfully')
              });
            })
            .catch((res) => {
              this.$store.dispatch("stopLoading");
              this.showErrorToast('There was a problem updating the drop off point')
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
          this.routes = res.data.data;

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
      $("#edit-dropoff-point").modal("hide");
    },
  },
  created() {
    const self = this;
    self.fetchRoutes();
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
