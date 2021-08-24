<template>
  <div class="modal" id="edit-trip">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Trip</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="editTrip">
            <form @submit.prevent="editTrip" ref="form">
              <div class="form-row">
                <div class="col-md-12">
                  <validation-provider
                    name="Route"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Route</label>

                      <select2
                        id="route"
                        aria-describedby="bus-feedback"
                        v-model.trim="trip.route_id"
                        :options="routes"
                        :settings="{
                          theme: 'bootstrap',
                          multiple: false,
                          closeOnSelect: true,
                        }"
                      >
                      </select2>

                      <div id="route-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Travel Date"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Travel Date</label>
                      <input
                        type="date"
                        placeholder="Enter travel Date"
                        aria-describedby="Pickup-Point-feedback"
                        v-model.trim="trip.travel_date"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                        :min="today"
                      />
                      <div
                        id="Pickup-Point-feedback"
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
                          v-model="trip.status"
                        />
                        Status
                      </label>
                    </div>
                  </div>

                  <div v-if="!!routeId">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          v-model="editFare"
                        />
                        Change Trip fare </label
                      ><br />
                      <small
                        >Check this if you want to change trip fare. Leave as it
                        is if the fare is the same as indicated in route
                        fare.</small
                      >
                    </div>

                    <!-- Fare -->
                    <div class="" v-if="!!!setSeatClassesFare && editFare">
                      <validation-provider
                        name="Fare"
                        :rules="{
                          required: true,
                          integer: true,
                          min_value: 0,
                        }"
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
                            v-model.trim="trip.fare"
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
                    <div class="mb-2" v-if="!!editFare">
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
                    <div class="row" v-if="!!setSeatClassesFare && editFare">
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
                            v-model="trip.seat_classes[seatClass.id]"
                            :class="`form-control`"
                            required
                          />
                        </div>
                      </div>
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
import Select2 from "v-select2-component";
import "select2-bootstrap-theme/dist/select2-bootstrap.min.css";

export default {
  components: { Select2 },
  props: {
    defaultRoute: {
      default: "",
    },
    trip: {
      required: true,
      type: Object,
    },
  },
  emits: ["update"],
  data() {
    return {
      editFare: false,
      setSeatClassesFare: false,
      seatClasses: [],
      selectedRouteDetails: {},
      routes: [],
    };
  },
  computed: {
    today() {
      return moment().format("YYYY-MM-DD");
    },
    routeId() {
      return this.trip.route_id;
    },
  },
  watch: {
    trip(newValue) {
      this.seatClasses = newValue?.route?.bus?.seat_classes ?? [];
      if (newValue?.trip_seat_classes?.length > 0) {
        this.fetchRoute(newValue.route_id);
        this.editFare = this.setSeatClassesFare = true;
      } else if (parseInt(newValue.fare) != parseInt(newValue.route.fare)) {
        this.editFare = true;
      }
    },
    routeId(newValue) {
      if (newValue) {
        this.fetchRoute(newValue);
      }
    },
    selectedRouteDetails(newValue) {
      if (newValue) {
        if (newValue.id && newValue.id != this.trip.route_id) {
          this.trip.fare = newValue.fare ?? "";
        }
        this.seatClasses = newValue?.bus?.seat_classes ?? [];
      }
    },
    setSeatClassesFare(newValue) {
      this.trip.seat_classes = [];
      if (newValue) {
        this.trip.trip_seat_classes.forEach((sclass) => {
          this.trip.seat_classes[sclass.id] = sclass.fare;
        });
      }
    },
  },
  methods: {
    editTrip() {
      this.$refs.editTrip.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");

          //remove timestamps
          delete this.trip.created_at;
          delete this.trip.updated_at;
          delete this.trip.deleted_at;

          //remove fare
          if (!this.editFare && !!this.trip.fare) {
            delete this.trip.fare;
          }

          //remove seat classes
          if (
            !this.editFare &&
            this.setSeatClassesFare &&
            !!this.trip.seat_classes
          ) {
            this.trip.seat_classes = [];
          }

          axios
            .post(`/admin/trips/${this.trip.id}`, {
              _method: "PUT",
              ...this.trip,
            })
            .then((res) => {
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast("Trip Edited successfully");
              });
            })
            .catch((res) => {
              this.$store.dispatch("stopLoading");
              this.showErrorToast("There was an error editing the trip");
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

          res.data.data.forEach((route) => {
            this.routes.push({
              id: route.id,
              text: `${route.bus.bus_reg_no} ${route.board_point} - ${route.drop_point} ${route.board_time}`,
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
      $("#edit-trip").modal("hide");
    },
    fetchRoute(routeId) {
      this.$store.dispatch("startLoading");

      axios
        .get("/admin/routes/" + routeId)
        .then((res) => {
          this.selectedRouteDetails = res.data.data;
          this.$store.dispatch("stopLoading");
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
        });
    },
    resetForm() {
      this.editFare = false;
      this.setSeatClassesFare = false;

      this.$nextTick(() => {
        this.$refs.editTrip.reset();
      });
    },
  },
  created() {
    const self = this;
    self.fetchRoutes();
    $(function () {
      $("#edit-trip").on("show.bs.modal", function (e) {
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
