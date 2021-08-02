<template>
  <div class="mx-2 mx-md-3 mt-3">
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>
    <div v-else>
      <validation-observer ref="createRoute">
        <form @submit.prevent="createRoute">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
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
                          <input
                            type="time"
                            step="30"
                            placeholder="18:00"
                            id="board-time"
                            aria-describedby="board-time-feedback"
                            v-model.trim="route.board_time"
                            :class="`form-control ${getValidationState(
                              validationContext
                            )}`"
                          />
                          <div id="board-time-feedback" class="invalid-feedback w-100">
                            {{ validationContext.errors[0] }}
                          </div>
                        </div>
                      </validation-provider>
                    </div>
                    <!-- Drop Point -->
                    <div class="col-md-6 mb-2">
                      <validation-provider
                        name="Drop Off Point"
                        :rules="{ required: true,}"
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
                          <input
                            type="time"
                            placeholder="18:00"
                            id="drop-time"
                            step="1800"
                            aria-describedby="drop-time-feedback"
                            v-model.trim="route.board_time"
                            :class="`form-control ${getValidationState(
                              validationContext
                            )}`"
                          />
                          <div
                            id="drop-time-feedback"
                            class="invalid-feedback w-100"
                          >
                            {{ validationContext.errors[0] }}
                          </div>
                        </div>
                      </validation-provider>
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
                </div>
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
  </div>
</template>

<script>
import Nprogress from "nprogress";
import Select2 from "v-select2-component";
import "select2-bootstrap-theme/dist/select2-bootstrap.min.css";

export default {
  components: { Select2 },
  data() {
    return {
      isLoading: false,
      seatClasses: [],
      route: {
        status: 1,
      },
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
    createRoute() {
      this.$refs.createRoute
        .validate()
        .then((valid) => {
          if (valid) {
            const self = this;

            //start loading
            self.$store.dispatch("startLoading");

            // post data
            axios
              .post("/admin/routes", self.route)
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

    //---- Validation State Form
    getValidationState({ dirty, validated, valid = null }) {
      if (dirty || validated) {
        return valid ? "is-valid" : "is-invalid";
      }
      return "";
    },
  },
};
</script>
