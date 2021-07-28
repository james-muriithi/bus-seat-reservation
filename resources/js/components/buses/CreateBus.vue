<template>
  <div class="mx-2 mx-md-3 mt-3">
    <validation-observer ref="createBus">
      <form @submit.prevent="createBus">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <!-- name -->
                  <div class="col-md-6 mb-2">
                    <validation-provider
                      name="Name"
                      :rules="{ required: true, min: 2, max: 55 }"
                      v-slot="validationContext"
                    >
                      <div class="form-group">
                        <label for="name">Bus Name</label>
                        <input
                          type="text"
                          placeholder="Bus Name"
                          id="name"
                          aria-describedby="Name-feedback"
                          v-model.trim="bus.bus_name"
                          :class="`form-control ${getValidationState(
                            validationContext
                          )}`"
                        />
                        <div id="Name-feedback" class="invalid-feedback w-100">
                          {{ validationContext.errors[0] }}
                        </div>
                      </div>
                    </validation-provider>
                  </div>
                  <!-- reg no -->
                  <div class="col-md-6 mb-2">
                    <validation-provider
                      name="Reg No"
                      :rules="{ required: true, min: 3, max: 55 }"
                      v-slot="validationContext"
                    >
                      <div class="form-group">
                        <label for="reg-no">Bus Reg No</label>
                        <input
                          type="text"
                          placeholder="Bus Reg No"
                          id="reg-no"
                          aria-describedby="reg-feedback"
                          v-model.trim="bus.bus_reg_no"
                          :class="`form-control ${getValidationState(
                            validationContext
                          )}`"
                        />
                        <div id="reg-feedback" class="invalid-feedback w-100">
                          {{ validationContext.errors[0] }}
                        </div>
                      </div>
                    </validation-provider>
                  </div>
                  <!-- max seats -->
                  <div class="col-md-6 mb-2">
                    <validation-provider
                      name="Max seats"
                      :rules="{ required: true, min_value: 0, double: true }"
                      v-slot="validationContext"
                    >
                      <div class="form-group">
                        <label for="name">Seats</label>
                        <input
                          type="text"
                          placeholder="Max Seats"
                          id="max-seats"
                          aria-describedby="seats-feedback"
                          v-model.trim="bus.max_seats"
                          :class="`form-control ${getValidationState(
                            validationContext
                          )}`"
                        />
                        <div id="seats-feedback" class="invalid-feedback w-100">
                          {{ validationContext.errors[0] }}
                        </div>
                      </div>
                    </validation-provider>
                  </div>
                  <!-- bus type -->
                  <div class="col-md-6 mb-2">
                    <validation-provider
                      name="Bus Type"
                      :rules="{ required: true }"
                      v-slot="validationContext"
                    >
                      <div class="form-group">
                        <label for="name">Bus Type</label>
                        <select
                          id="max-seats"
                          aria-describedby="bus-type-feedback"
                          v-model.trim="bus.bus_type"
                          :class="`form-control ${getValidationState(
                            validationContext
                          )}`"
                        >
                          <option value="" selected>--Select Bus Type--</option>
                          <option
                            :value="busType.id"
                            v-for="busType in busTypes"
                            :key="busType.id"
                          >
                            {{ busType.bus_type }}
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

                  <!-- bus amenities -->
                  <div class="col-md-6 mb-2">
                    <validation-provider
                      name="Amenities"
                      :rules="{ required: false }"
                      v-slot="validationContext"
                    >
                      <div class="form-group">
                        <label for="name">Bus Amenities</label>
                        <select
                          id="amenities"
                          aria-describedby="bus-amenities-feedback"
                          v-model.trim="bus.amenities"
                          :class="`form-control ${getValidationState(
                            validationContext
                          )}`"
                        >
                          <option value="" selected>--Select Amenities--</option>
                          <option
                            :value="amenity.id"
                            v-for="amenity in amenities"
                            :key="amenity.id"
                          >
                            {{ amenity.name }}
                          </option>
                        </select>
                        <div
                          id="bus-amenities-feedback"
                          class="invalid-feedback w-100"
                        >
                          {{ validationContext.errors[0] }}
                        </div>
                      </div>
                    </validation-provider>
                  </div>

                  <!-- bus status -->
                  <div class="col-md-12 mb-2">
                    <div class="form-group">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="status"
                            v-model="bus.status"
                          />
                          Status
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body"></div>
            </div>
          </div>
          <div class="col-md-12">
            <button class="btn btn-primary" type="submit">Submit</button>
          </div>
        </div>
      </form>
      <validation-provider> </validation-provider>
    </validation-observer>
  </div>
</template>

<script>
import Nprogress from "nprogress";

export default {
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
  },
  data() {
    return {
      isLoading: false,
      busTypes: [],
      amenities: [],
      bus: {
        bus_name: "",
        bus_reg_no: "",
        bus_type: "",
        max_seats: 0,
        status: 1,
      },
    };
  },
  methods: {
    fetchBusTypes() {
      this.$store.dispatch("startLoading");
      this.isLoading = true;
      axios
        .get("/admin/bus-types")
        .then((res) => {
          this.busTypes = res.data.data;
          this.$store.dispatch("stopLoading");
          this.isLoading = false;
        })
        .catch((error) => {
          console.log(error);
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
    createBus() {
      this.$refs.createBus.validate().then((valid) => {
        if (valid) {
        }
      });
    },
  },
  created() {
    this.fetchBusTypes();
  },
};
</script>
