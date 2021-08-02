<template>
  <div class="mx-2 mx-md-3 mt-3">
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>
    <div v-else>
      <validation-observer ref="editRoute">
        <form @submit.prevent="editRoute">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <!-- bus -->
                    <div class="col-md-6 mb-2">
                      <validation-provider
                        name="Bus"
                        :rules="{ required: true }"
                        v-slot="validationContext"
                      >
                        <div class="form-group">
                          <label for="name">Bus</label>
                          <select
                            id="max-seats"
                            aria-describedby="bus-type-feedback"
                            v-model.trim="selectedBus"
                            :class="`form-control ${getValidationState(
                              validationContext
                            )}`"
                            disabled
                          >
                            <option value="" selected>--Select Bus--</option>
                            <option
                              :value="bus.id"
                              v-for="bus in buses"
                              :key="bus.id"
                            >
                              {{ bus.bus_name }} {{ bus.bus_reg_no }}
                            </option>
                          </select>
                          <div
                            id="bus-type-feedback"
                            class="invalid-feedback w-100"
                          >
                            {{ validationContext.errors[0] }}
                          </div>
                        </div>
                      </validation-provider>
                    </div>

                    <!-- pickup-point -->
                    <div class="col-md-6 mb-2">
                      <validation-provider
                        name="Name"
                        :rules="{ required: true, min: 2, max: 55 }"
                        v-slot="validationContext"
                      >
                        <div class="form-group">
                          <label for="pickup-point">Board Point</label>
                          <input
                            type="text"
                            placeholder="Pickup Point"
                            id="pickup-point"
                            aria-describedby="pickup-point-feedback"
                            v-model.trim="route.board_point"
                            :class="`form-control ${getValidationState(
                              validationContext
                            )}`"
                          />
                          <div
                            id="pickup-point-feedback"
                            class="invalid-feedback w-100"
                          >
                            {{ validationContext.errors[0] }}
                          </div>
                        </div>
                      </validation-provider>
                    </div>
                    <!-- board time -->
                    <div class="col-md-6 mb-2">
                      <validation-provider
                        name="Reg No"
                        :rules="{ required: true }"
                        v-slot="validationContext"
                      >
                        <div class="form-group">
                          <label for="board-time">Board Time</label>
                          <vue-timepicker
                            format="HH:mm"
                            aria-describedby="drop-time-feedback"
                            v-model.trim="route.board_time"
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
                    </div>
                    <!-- Drop Point -->
                    <div class="col-md-6 mb-2">
                      <validation-provider
                        name="Drop Off Point"
                        :rules="{ required: true }"
                        v-slot="validationContext"
                      >
                        <div class="form-group">
                          <label for="drop-point">Drop Off Point</label>
                          <input
                            type="text"
                            placeholder="Drop Off Point"
                            id="drop-point-seats"
                            aria-describedby="drop-point-feedback"
                            v-model.trim="route.drop_point"
                            :class="`form-control ${getValidationState(
                              validationContext
                            )}`"
                          />
                          <div
                            id="drop-point-feedback"
                            class="invalid-feedback w-100"
                          >
                            {{ validationContext.errors[0] }}
                          </div>
                        </div>
                      </validation-provider>
                    </div>
                    <!-- Drop Time -->
                    <div class="col-md-6 mb-2">
                      <validation-provider
                        name="Drop Off Time"
                        :rules="{ required: true }"
                        v-slot="validationContext"
                      >
                        <div class="form-group">
                          <label for="name">Drop Off Time</label>
                          <div>
                            <vue-timepicker
                              format="HH:mm"
                              aria-describedby="drop-time-feedback"
                              v-model.trim="route.drop_time"
                              :input-class="`form-control w-100 ${getValidationState(
                                validationContext
                              )}`"
                              :minute-interval="5"
                              manual-input
                            />
                          </div>
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
                    </div>

                    <!-- Fare -->
                    <div class="col-md-6 mb-2" v-if="!!!setSeatClassesFare">
                      <validation-provider
                        name="Fare"
                        :rules="{ required: true, integer: true, min_value: 0 }"
                        v-slot="validationContext"
                      >
                        <div class="form-group">
                          <label for="drop-point"
                            >Fare (for all seat classes)</label
                          >
                          <input
                            type="text"
                            placeholder="Fare"
                            id="fare"
                            aria-describedby="fare-feedback"
                            v-model.trim="route.fare"
                            :class="`form-control ${getValidationState(
                              validationContext
                            )}`"
                          />
                          <div
                            id="fare-feedback"
                            class="invalid-feedback w-100"
                          >
                            {{ validationContext.errors[0] }}
                          </div>
                        </div>
                      </validation-provider>
                    </div>
                    <!-- set each seat class fare -->
                    <div class="col-md-12 mb-2">
                      <div class="form-group">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="status"
                              v-model="setSeatClassesFare"
                            />
                            Set each seat class fare
                          </label>
                        </div>
                      </div>
                    </div>

                    <!-- each seat class are -->
                    <div class="row col-md-12" v-if="!!setSeatClassesFare">
                      <div
                        class="col-md-6 mb-2"
                        v-for="seatClass in seatClasses"
                        :key="seatClass.id"
                      >
                        <div class="form-group">
                          <label for="drop-point"
                            >Fare for {{ seatClass.name }} Class</label
                          >
                          <input
                            type="number"
                            min="0"
                            placeholder="Fare"
                            :id="`fare${seatClass.id}`"
                            :key="seatClass.id"
                            v-model="route.seat_classes[seatClass.id]"
                            :class="`form-control`"
                            required
                          />
                        </div>
                      </div>
                    </div>

                    <!-- route status -->
                    <div class="col-md-12 mb-2">
                      <div class="form-group">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="status"
                              v-model="route.status"
                            />
                            Status
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 text-right">
                    <button class="btn btn-primary" type="submit">
                      Submit
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <validation-provider> </validation-provider>
      </validation-observer>
    </div>
  </div>
</template>

<script>
import Nprogress from "nprogress";
import VueTimepicker from "vue2-timepicker";
import "vue2-timepicker/dist/VueTimepicker.css";

export default {
  components: { VueTimepicker },
  props: {
    route: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      isLoading: false,
      setSeatClassesFare: false,
      seatClasses: [],
      buses: [],
      selectedBus: "",
      //   route: {
      //     status: 1,
      //     seat_classes: [],
      //     drop_time: "",
      //     board_time: "",
      //   },
    };
  },
  computed: {
    loading() {
      return this.$store.getters.loading;
    },
  },
  watch: {
    loading(newValue) {
      if (newValue) {
        Nprogress.start();
        Nprogress.set(0.1);
      } else {
        Nprogress.done();
      }
    },
    setSeatClassesFare(newValue) {
      if (!newValue) {
        this.route.seat_classes = [];
      }
    },
  },
  methods: {
    fetchSeatClasses() {
      axios
        .get("/admin/bus-seat-classes")
        .then((res) => {
          res.data.data.forEach((seatClass) => {
            this.seatClasses.push({
              id: seatClass.id,
              text: seatClass.name,
            });
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    editRoute() {
      this.$refs.editRoute
        .validate()
        .then((valid) => {
          if (valid) {
            const self = this;

            //start loading
            self.$store.dispatch("startLoading");

            //remove timestamps
            delete self.route.created_at;
            delete self.route.updated_at;
            delete self.route.deleted_at;

            // post data
            axios
              .post(`/admin/routes/${self.route.id}`, {
                ...self.route,
                _method: "PUT",
              })
              .then((res) => {
                self.$store.dispatch("stopLoading");
                self.$nextTick(() => (window.location.href = "/admin/routes"));
              })
              .catch((err) => {
                self.$store.dispatch("stopLoading");
                console.log(err);
              });
          }
        })
        .catch((e) => console.log(e));
    },
    fetchBuses(pageLoad = true) {
      this.$store.dispatch("startLoading");
      this.isLoading = pageLoad;

      axios
        .get("/admin/buses")
        .then((res) => {
          this.buses = res.data.data;

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
  },
  async created() {
    await this.fetchBuses();
    this.route.seat_classes = [];

    if (this.route) {
      this.selectedBus = this.route.bus_id;
      this.seatClasses = this.route.bus.seat_classes;
      this.setSeatClassesFare = this.route.route_seat_classes.length > 0;
    }

    if (this.setSeatClassesFare) {
      this.seatClasses.forEach((seatClass) => {
        const sclass = this.route.route_seat_classes.find(
          (sclass) => sclass.id == seatClass.id
        );

        this.route.seat_classes[seatClass.id] = sclass ? sclass.fare : "";
      });
    }
  },
};
</script>

<style>
.vue__time-picker.time-picker {
  width: 100%;
}
</style>
