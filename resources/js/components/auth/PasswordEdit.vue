<template>
  <div class="mx-2 mx-md-3 mt-3">
    <div class="row">
      <div class="col-md-6">
        <div v-if="isLoading" class="mb-5" style="height: 300px">
          <spinner class="loading_page" :lg="true"></spinner>
        </div>
        <div v-else>
          <validation-observer ref="updateUserDetails">
            <form @submit.prevent="updateUserDetails">
              <div class="card">
                <div class="card-body">
                  <validation-provider
                    name="Name"
                    :rules="{ required: true, min: 2, max: 55 }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input
                        type="text"
                        placeholder="Name"
                        id="name"
                        aria-describedby="Name-feedback"
                        v-model.trim="user.name"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="Name-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Name"
                    :rules="{ required: true, email: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Email</label>
                      <input
                        type="email"
                        placeholder="Email"
                        id="email"
                        aria-describedby="email-feedback"
                        v-model.trim="user.email"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="email-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Phone"
                    :rules="{ required: true, regex: /^(0|\+?254)(\d){9}$/ }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Phone</label>
                      <input
                        type="text"
                        placeholder="Phone number"
                        id="name"
                        aria-describedby="phone-feedback"
                        v-model.trim="user.phone"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="phone-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>
                  <div class="col-md-12 text-right mt-4">
                    <button class="btn btn-primary" type="submit">
                      Update
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </validation-observer>
        </div>
      </div>
      <div class="col-md-6">
        <div v-if="isLoading" class="mb-5" style="height: 300px">
          <spinner class="loading_page" :lg="true"></spinner>
        </div>
        <div v-else>
          <validation-observer ref="updatePassword">
            <form @submit.prevent="updatePassword">
              <div class="card">
                <div class="card-body">
                  <validation-provider
                    name="Password"
                    :rules="{ required: true, min: 8 }"
                    v-slot="validationContext"
                    vid="password"
                  >
                    <div class="form-group">
                      <label for="name">Password</label>
                      <input
                        type="password"
                        placeholder="Password"
                        id="password"
                        aria-describedby="password-feedback"
                        v-model.trim="user.password"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div
                        id="password-feedback"
                        class="invalid-feedback w-100"
                      >
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <validation-provider
                    name="Confirm Password"
                    :rules="{ required: true, confirmed: 'password' }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Confirm Password</label>
                      <input
                        type="password"
                        placeholder="Confirm Password"
                        id="r-password"
                        aria-describedby="rp-feedback"
                        v-model.trim="user.password_confirmation"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="rp-feedback" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <div class="col-md-12 text-right mt-4">
                    <button class="btn btn-primary" type="submit">
                      Update
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </validation-observer>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Nprogress from "nprogress";

export default {
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      isLoading: false,
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
    updatePassword() {
      this.$store.dispatch("startLoading");

      this.$refs.updateUserDetails
        .validate()
        .then((valid) => {
          axios
            .post("/profile/password", {
              password: this.user.password,
              password_confirmation: this.user.password_confirmation,
            })
            .then((res) => {
                this.user.password = this.user.password_confirmation = null;
              this.$store.dispatch("stopLoading");
            })
            .catch((res) => {
              console.log(res);
              this.$store.dispatch("stopLoading");
            });
        })
        .catch((res) => console.log(res));
    },
    updateUserDetails() {
      this.$store.dispatch("startLoading");

      this.$refs.updateUserDetails
        .validate()
        .then((valid) => {
          axios
            .post("/profile/profile", {
              name: this.user.name,
              email: this.user.email,
              phone: this.user.phone,
            })
            .then((res) => {
              console.log(res.data);
              this.$store.dispatch("stopLoading");
            })
            .catch((res) => {
              console.log(res);
              this.$store.dispatch("stopLoading");
            });
        })
        .catch((res) => console.log(res));
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
