<template>
  <div class="mx-2 mx-md-3 mt-3">
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>
    <div v-else>
      <validation-observer ref="editBus">
        <form @submit.prevent="editBus">
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
                          <div
                            id="Name-feedback"
                            class="invalid-feedback w-100"
                          >
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
                        :rules="{ required: true, min_value: 1, integer: true }"
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
                          <div
                            id="seats-feedback"
                            class="invalid-feedback w-100"
                          >
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
                            v-model.trim="bus.bus_type_id"
                            :class="`form-control ${getValidationState(
                              validationContext
                            )}`"
                          >
                            <option value="" selected>
                              --Select Bus Type--
                            </option>
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

                    <!-- bus seat classes -->
                    <div class="col-md-6 mb-2">
                      <validation-provider
                        name="SeatClass"
                        :rules="{ required: true }"
                        v-slot="validationContext"
                      >
                        <div class="form-group">
                          <label for="seat-classes">Bus Seat Classes</label>
                          <select2
                            id="seat-classes"
                            aria-describedby="bus-seat-classes-feedback"
                            v-model.trim="bus.seat_classes"
                            :options="seatClasses"
                            :settings="{
                              theme: 'bootstrap',
                              multiple: true,
                              closeOnSelect: false,
                            }"
                            required
                          >
                          </select2>
                          <div
                            id="bus-seat-classes-feedback"
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
                          <select2
                            id="amenities"
                            aria-describedby="bus-amenities-feedback"
                            v-model.trim="bus.amenities"
                            :options="amenities"
                            :settings="{
                              theme: 'bootstrap',
                              multiple: true,
                              closeOnSelect: false,
                            }"
                          >
                          </select2>
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
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 mb-5 px-0">
                      <div
                        id="my-strictly-unique-vue-upload-multiple-image"
                        class="d-flex justify-content-center"
                      >
                        <vue-upload-multiple-image
                        @upload-success="uploadImageSuccess"
                        @before-remove="beforeRemove" dragText="Drag & Drop
                        multiple images for the bus" dropText="Drag & Drop
                        image" browseText="(or) Select"
                        accept=image/gif,image/jpeg,image/png,image/bmp,image/jpg
                        primaryText='success' markIsPrimaryText='success'
                        popupText='image uploaded successfully!'
                        :data-images="images" idUpload="myIdUpload"
                        :showEdit="false" />
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
import VueUploadMultipleImage from "vue-upload-multiple-image";
import "select2-bootstrap-theme/dist/select2-bootstrap.min.css";

export default {
  components: { Select2, VueUploadMultipleImage },
  props: {
    bus: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      isLoading: false,
      busTypes: [],
      seatClasses: [],
      amenities: [
        {
          disabled: true,
          text: "--Select Amenity--",
        },
      ],
      data: new FormData(),
      images: [],
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
    fetchBusTypes() {
      axios
        .get("/admin/bus-types")
        .then((res) => {
          this.busTypes = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    fetchAmenities() {
      axios
        .get("/admin/amenities")
        .then((res) => {
          this.amenities = [
            {
              text: "--Select Amenity--",
            },
          ];
          res.data.data.forEach((amenity) => {
            this.amenities.push({
              id: amenity.id,
              text: amenity.name,
            });
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    editBus() {
      this.$refs.editBus
        .validate()
        .then((valid) => {
          if (valid) {
            const self = this;
            //start loading
            self.$store.dispatch("startLoading");

            // append objet product
            Object.entries(self.bus).forEach(([key, value]) => {
              if (!Array.isArray(value)) {
                self.data.append(key, value);
              }
            });

            self.data.delete("amenities[]");
            self.data.delete("created_at");
            self.data.delete("deleted_at");
            self.data.delete("updated_at");

            // seat classes
            self.data.delete("seat_classes[]");
            self.bus.seat_classes.forEach((seatClass) =>
              self.data.append("seat_classes[]", seatClass)
            );
            //amenities
            self.bus.amenities.forEach((amenity) =>
              self.data.append("amenities[]", amenity)
            );

            //append array images
            if (self.images.length > 0) {
              self.data.delete("images[]");
              for (var k = 0; k < self.images.length; k++) {
                Object.entries(self.images[k]).forEach(([key, value]) => {
                  self.data.append("images[" + k + "][" + key + "]", value);
                });
              }
            }

            self.data.append("_method", "PUT");

            // post data
            axios
              .post(`/admin/buses/${self.bus.id}`, self.data)
              .then((res) => {
                // self.$store.dispatch("stopLoading");
                self.$nextTick(() => (window.location.href = "/admin/buses"));
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
    //------ Event upload Image Success
    uploadImageSuccess(_, _1, fileList) {
      this.images = fileList;
    },

    //------ Event before Remove Image
    beforeRemove(_, done, fileList) {
      var remove = confirm("remove image");
      if (remove == true) {
        this.images = fileList;
        done();
      } else {
      }
    },
  },
  async created() {
    this.$store.dispatch("startLoading");
    this.isLoading = true;

    await this.fetchBusTypes();
    await this.fetchAmenities();
    await this.fetchSeatClasses();

    this.bus.amenities = this.bus.amenities.map((amenity) => amenity.id);
    this.bus.seat_classes = this.bus.seat_classes.map((seatClass) => seatClass.id);

    this.images = this.bus.images.map((image) => {
      return {
        name: image.file_name,
        path: image.path,
      };
    });

    this.$store.dispatch("stopLoading");
    this.isLoading = false;
  },
};
</script>
