<template>
  <div class="mx-2 mx-md-3 mt-3">
    <div v-if="isLoading" class="mb-5" style="height: 300px">
      <spinner class="loading_page" :lg="true"></spinner>
    </div>
    <div v-else>
      <validation-observer ref="editSystemSettings">
        <form @submit.prevent="editSystemSettings">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <validation-provider
                        name="companyName"
                        :rules="{ required: true, min: 2 }"
                        v-slot="validationContext"
                      >
                        <div class="form-group">
                          <label for="name">Company Name</label>
                          <input
                            type="text"
                            placeholder="Company Name"
                            id="name"
                            aria-describedby="Name-feedback"
                            v-model.trim="settings.company_name"
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
                    <!-- default currency id -->
                    <div class="col-md-6">
                      <validation-provider
                        name="defaultCurrency"
                        :rules="{ required: true }"
                        v-slot="validationContext"
                      >
                        <div class="form-group">
                          <label for="currency">Default Currency</label>
                          <select
                            id="currency"
                            aria-describedby="currency-feedback"
                            v-model.trim="settings.default_currency_id"
                            :class="`form-control ${getValidationState(
                              validationContext
                            )}`"
                          >
                            <option value="">--Select Currency--</option>
                            <option
                              :value="currency.id"
                              v-for="currency in currencies"
                              :key="currency.id"
                            >
                              {{ currency.currency_name }}
                            </option>
                          </select>
                          <div
                            id="currency-feedback"
                            class="invalid-feedback w-100"
                          >
                            {{ validationContext.errors[0] }}
                          </div>
                        </div>
                      </validation-provider>
                    </div>
                    <!-- company logo -->
                    <div class="col-md-6 mt-1">
                      <div class="form-group">
                        <label for="name">Logo</label>
                        <div
                          id="my-strictly-unique-vue-upload-multiple-image"
                          class="d-flex justify-content-center"
                        >
                          <vue-upload-multiple-image
                          @upload-success="uploadImageSuccess"
                          @before-remove="beforeRemove" dragText="Drag & Drop
                          the company logo" dropText="Drag & Drop image"
                          browseText="(or) Select"
                          accept=image/gif,image/jpeg,image/png,image/webp,image/jpg
                          primaryText='success' markIsPrimaryText='success'
                          popupText='image uploaded successfully!'
                          :data-images="logo" idUpload="myIdUpload"
                          :showEdit="false" :multiple="false"
                          aria-describedby="logo-feedback" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 text-right">
                      <button class="btn btn-primary" type="submit">
                        Submit
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </validation-observer>
    </div>
  </div>
</template>

<script>
import VueUploadMultipleImage from "vue-upload-multiple-image";

export default {
  components: { VueUploadMultipleImage },
  props: {
    settings: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      isLoading: false,
      currencies: [],
      logo: [],
      data: new FormData(),
    };
  },
  methods: {
    editSystemSettings() {
      this.$refs.editSystemSettings
        .validate()
        .then((valid) => {
          if (valid) {
            const self = this;
            //start loading
            self.$store.dispatch("startLoading");

            // append objet product
            Object.entries(self.settings).forEach(([key, value]) => {
              if (!Array.isArray(value)) {
                self.data.append(key, value);
              }
            });

            self.data.delete("created_at");
            self.data.delete("default_currency");
            self.data.delete("deleted_at");
            self.data.delete("updated_at");

            //append array images
            if (self.logo.length > 0) {
              self.data.delete("company_logo");
              for (var k = 0; k < self.logo.length; k++) {
                  self.data.append("company_logo[name]", self.logo[0].name);
                  self.data.append("company_logo[path]", self.logo[0].path);
              }
            }

            self.data.append("_method", "PUT");

            axios
              .post(`/admin/system-settings/${self.settings.id}`, self.data)
              .then((res) => {
                self.$store.dispatch("stopLoading");
                self.$nextTick(() => (window.location.href = "/admin/system-settings"));
              })
              .catch((err) => {
                self.$store.dispatch("stopLoading");
                console.log(err);
              });

          } else {
            console.log("kkkk");
          }
        })
        .catch((e) => console.log(e));
    },
    fetchCurrencies() {
      axios
        .get("/admin/currencies")
        .then((res) => {
          this.currencies = res.data.data;
        })
        .catch((res) => {
          console.log(res);
        });
    },
    //---- Validation State Form
    getValidationState({ dirty, validated, valid = null }) {
      if (dirty || validated) {
        return valid ? "is-valid" : "is-invalid";
      }
      return "";
    },
    //------ Event upload Image Success
    uploadImageSuccess(formData, _1, fileList) {
      this.logo = fileList;
    },

    //------ Event before Remove Image
    beforeRemove(_, done, fileList) {
      var remove = confirm("remove image");
      if (remove == true) {
        this.logo = fileList;
        done();
      } else {
      }
    },
  },
  async created() {
    this.$store.dispatch("startLoading");
    this.isLoading = true;

    await this.fetchCurrencies();
    // await this.fetchAmenities();

    // this.bus.amenities = this.bus.amenities.map((amenity) => amenity.id);

    this.logo = [];

    if (this.settings.company_logo) {
      this.logo = [
        {
          name: this.settings.company_logo.file_name,
          path: this.settings.company_logo.path,
        },
      ];
    }

    this.$store.dispatch("stopLoading");
    this.isLoading = false;
  },
};
</script>
