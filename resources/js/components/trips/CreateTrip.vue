<template>
  <div class="modal" id="create-trip">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Trip</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="createTrip">
            <form @submit.prevent="createTrip" ref="form">
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
                        id="route-c"
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
  },
  emits: ["update"],
  data() {
    return {
      editFare: false,
      setSeatClassesFare: false,
      seatClasses: [],
      selectedRouteDetails: {},
      trip: {
        route_id: this.defaultRoute,
        status: 1,
        travel_date: "",
        fare: "",
        seat_classes: []
      },
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
  watch:{
    routeId(newValue){
      if (newValue) {
        this.fetchRoute(newValue);
      }
    },
    selectedRouteDetails(newValue){
      if (newValue) {
        this.trip.fare = newValue.fare ?? '';
        this.seatClasses = newValue?.bus?.seat_classes ?? [];
      }
    },
    setSeatClassesFare(newValue){
      this.trip.seat_classes = [];
      if (newValue && this.selectedRouteDetails.seatClassesFare.length > 0) {
        this.selectedRouteDetails.seatClassesFare.forEach((sclass) => {
          this.trip.seat_classes[sclass.id] = sclass.fare;
        })
      }
    }
  },
  methods: {
    resetForm() {
      this.trip = {
        route_id: this.defaultRoute,
        status: 1,
        travel_date: "",
        fare: "",
        seat_classes: []
      };

      this.editFare= false
      this.setSeatClassesFare = false
      this.seatClasses = []
      this.selectedRouteDetails = {}

      this.$nextTick(() => {
        this.$refs.createTrip.reset();
      });
    },
    createTrip() {
      this.$refs.createTrip.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post("/admin/trips", this.trip)
            .then((res) => {
              this.closeModal();

              console.log(res.data);

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast("Trip created successfully");
              });
            })
            .catch((error) => {
              this.$store.dispatch("stopLoading");
              if (error?.response?.data?.error) {
                this.showErrorToast(error.response.data.message);
              }else{
                this.showErrorToast("There was an error creating the trip");
              }
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
      $("#create-trip").modal("hide");
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
  },
  created() {
    const self = this;
    self.fetchRoutes();
    $(function () {
      $("#create-trip").on("show.bs.modal", function (e) {
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
