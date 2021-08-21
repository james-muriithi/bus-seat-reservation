<template>
  <div class="modal" id="create-price-variation">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Price Variation</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="createPriceVariation">
            <form @submit.prevent="createPriceVariation" ref="form">
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
                        v-model.trim="priceVariation.route_id"
                        :options="routes"
                        :settings="{
                          theme: 'bootstrap',
                          multiple: false,
                          closeOnSelect: true,
                        }"
                      >
                      </select2>
                      <div id="Name-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Pickup Point"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Pickup Point</label>
                      <select2
                        id="pp"
                        aria-describedby="bus-feedback"
                        v-model.trim="priceVariation.pickup_point_id"
                        :options="pickup_points"
                        :settings="{
                          theme: 'bootstrap',
                          multiple: false,
                          closeOnSelect: true,
                        }"
                      >
                      </select2>
                      <div id="Name-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Drop points"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Drop Off Points</label>
                      <select2
                        id="dop"
                        aria-describedby="bus-feedback"
                        v-model.trim="priceVariation.drop_point_id"
                        :options="drop_points"
                        :settings="{
                          theme: 'bootstrap',
                          multiple: false,
                          closeOnSelect: true,
                        }"
                      >
                      </select2>
                      <div id="Name-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <!-- Fare -->
                  <div class="" v-if="!!!setSeatClassesFare">
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
                          v-model.trim="priceVariation.fare"
                          :class="`form-control ${getValidationState(
                            validationContext
                          )}`"
                        />
                        <div id="fare-feedback" class="invalid-feedback w-100">
                          {{ validationContext.errors[0] }}
                        </div>
                      </div>
                    </validation-provider>
                  </div>

                  <!-- set each seat class fare -->
                  <div class="col-md-12 mb-2" v-if="!!routeId">
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
                          v-model="priceVariation.seat_classes[seatClass.id]"
                          :class="`form-control`"
                          required
                        />
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
  emits: ["update"],
  data() {
    return {
      routes: [],
      pickup_points: [],
      drop_points: [],
      setSeatClassesFare: false,
      selectedRouteDetails: {},
      seatClasses: [],
      priceVariation: {
        route_id: "",
        pickup_point_id: "",
        drop_point_id: "",
        fare: '',
        seat_classes: [],
      },
    };
  },
  computed: {
    routeId() {
      return this.priceVariation.route_id;
    },
  },
  watch: {
    routeId(newValue) {
      if (newValue) {
        this.fetchRoute(newValue);
      }
    },
  },
  methods: {
    resetForm() {
      this.priceVariation = {
        route_id: "",
        pickup_point_id: "",
        drop_point_id: "",
        fare: '',
        seat_classes: []
      };
      this.$nextTick(() => {
        this.$refs.createPriceVariation.reset();
      });
    },
    createPriceVariation() {
      this.$refs.createPriceVariation.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post("/admin/route-price-variations", this.priceVariation)
            .then((res) => {
              //   this.$store.dispatch("stopLoading");
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast("Bus seat class created successfully!");
              });
            })
            .catch((res) => {
              this.$store.dispatch("stopLoading");
              this.showErrorToast(
                "There was a problem creating the bus seat class!"
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
              text: `${route.bus.formatted_name} ${route.route_name}`,
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
    fetchRoute(routeId) {
      this.$store.dispatch("startLoading");

      axios
        .get("/admin/routes/" + routeId)
        .then((res) => {
          this.selectedRouteDetails = res.data.data;
          this.populatePickupPoints();
          this.populateDropPoints();
          this.setSeatClasses();
          this.$store.dispatch("stopLoading");
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
        });
    },
    populatePickupPoints() {
      if (!_.isEmpty(this.selectedRouteDetails)) {
        this.pickup_points = [];
        this.selectedRouteDetails.pickup_points.map((point) => {
          this.pickup_points.push({
            id: point.id,
            text: point.pickup_point,
          });
        });
      }
    },
    populateDropPoints() {
      if (!_.isEmpty(this.selectedRouteDetails)) {
        this.drop_points = [];
        this.selectedRouteDetails.drop_off_points.map((point) => {
          this.drop_points.push({
            id: point.id,
            text: point.drop_off_point,
          });
        });
      }
    },
    setSeatClasses(){
      if (!_.isEmpty(this.selectedRouteDetails)) {
        this.seatClasses = this.selectedRouteDetails?.bus?.seat_classes ?? [];
      }
    },
    //---- Validation State Form
    getValidationState({ dirty, validated, valid = null }) {
      if (dirty || validated) {
        return valid ? "is-valid" : "is-invalid";
      }
      return "";
    },
    closeModal() {
      $("#create-price-variation").modal("hide");
    },
  },
  created() {
    const self = this;
    $(function () {
      $("#create-price-variation").on("show.bs.modal", function (e) {
        self.resetForm();
        self.fetchRoutes();
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
