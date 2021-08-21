<template>
  <div class="modal" id="edit-price-variation">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Price Variation</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="editPriceVariation">
            <form @submit.prevent="editPriceVariation" ref="form">
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
                      :rules="{ required: true, min_value: 0 }"
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
  props: {
    priceVariation: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      routes: [],
      pickup_points: [],
      drop_points: [],
      setSeatClassesFare: false,
      selectedRouteDetails: {},
      seatClasses: [],
    };
  },
  computed: {
    routeId() {
      return this.priceVariation.route_id;
    },
    pickupPointId() {
      return this.priceVariation.pickup_point_id;
    },
  },
  watch: {
    routeId(newValue) {
      if (newValue) {
        this.fetchRoute(newValue);
      }
    },
    pickupPointId(newValue) {
      if (newValue) {
        this.populateDropPoints();
      }
    },
    priceVariation(newValue) {
      if (!_.isEmpty(newValue)) {
        this.setSeatClassesFare = false;
        this.fillData();
      }
    },
  },
  methods: {
    editPriceVariation() {
      this.$refs.editPriceVariation.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");

          //remove timestamps
          delete this.editPriceVariation.created_at;
          delete this.editPriceVariation.updated_at;
          delete this.editPriceVariation.deleted_at;

          axios
            .post(`/admin/route-price-variations/${this.priceVariation.id}`, {
              ...this.priceVariation,
              _method: "PUT",
            })
            .then((res) => {
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast("Price variation edited successfully!");
              });
            })
            .catch((res) => {
              console.log(res);
              this.$store.dispatch("stopLoading");
              this.showErrorToast(
                "There was a problem editing the price variation class!"
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
      if (!_.isEmpty(this.selectedRouteDetails) && !!this.pickupPointId) {
        this.drop_points = [];
        const selectedPickup = this.selectedRouteDetails.pickup_points.find(
          (point) => point.id == this.pickupPointId
        );

        let drop_off_points = this.selectedRouteDetails.drop_off_points;

        drop_off_points = drop_off_points.filter(
          (point) =>
            selectedPickup.pickup_point.toLowerCase() !=
            point.drop_off_point.toLowerCase()
        );

        if (!!(selectedPickup?.main ?? null)) {
          drop_off_points = drop_off_points.filter((point) => !point.main);
        }

        drop_off_points.map((point) => {
          this.drop_points.push({
            id: point.id,
            text: point.drop_off_point,
          });
        });
      }
    },
    setSeatClasses() {
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
    async fillData() {
      if (!_.isEmpty(this.priceVariation)) {
        await this.fetchRoute(this.routeId);
        // this.selectedBus = this.route.bus_id;
        this.seatClasses = this.priceVariation?.route?.bus?.seat_classes;
        this.setSeatClassesFare =
          this.priceVariation.variation_seat_classes.length > 0;
      }

      if (this.setSeatClassesFare && this.seatClasses.length > 0) {
        this.priceVariation.seat_classes = [];
        this.seatClasses.forEach((seatClass) => {
          const sclass = this.priceVariation.variation_seat_classes.find(
            (sclass) => sclass.id == seatClass.id
          );

          this.priceVariation.seat_classes[seatClass.id] = sclass
            ? sclass.fare
            : "";
        });
      }
    },
    closeModal() {
      $("#edit-price-variation").modal("hide");
    },
  },
  async created() {
    await this.fetchRoutes();
  },
};
</script>
<style>
.fade:not(.show) {
  opacity: 1;
}
</style>
