<template>
  <div class="modal" id="create-currency">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Currency</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="createCurrency">
            <form @submit.prevent="createCurrency" ref="form">
              <div class="form-row">
                <div class="col-md-12">
                  <validation-provider
                    name="Currency Name"
                    :rules="{ required: true, min: 2, max: 20 }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Currency Name</label>
                      <input
                        type="text"
                        placeholder="Enter currency name e.g US Dollar"
                        aria-describedby="Name-feedback"
                        v-model.trim="currency.currency_name"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="Name-feed back" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>
                  <!-- currency code -->
                  <validation-provider
                    name="Currency Code"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Currency Code</label>
                      <input
                        type="text"
                        placeholder="Enter currency Code e.g USD"
                        aria-describedby="Code-feedback"
                        v-model.trim="currency.currency_code"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="Code-feed back" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>

                  <!-- currency symbol -->
                  <validation-provider
                    name="Currency Symbol"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Currency Symbol</label>
                      <input
                        type="text"
                        placeholder="Enter currency name e.g $"
                        aria-describedby="Symbol-feedback"
                        v-model.trim="currency.currency_symbol"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="Symbol-feed back" class="invalid-feedback w-100">
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
                          v-model="currency.status"
                        />
                        Status
                      </label>
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
export default {
  emits: ["update"],
  data() {
    return {
      currency: {
        currency_code: "",
        currency_symbol: "",
        currency_name: "",
        status: 1,
      },
    };
  },
  methods: {
    resetForm() {
      this.currency = {
        currency_code: "",
        currency_symbol: "",
        currency_name: "",
        status: 1,
      };
      this.$nextTick(() => {
        this.$refs.createCurrency.reset();
      });
    },
    createCurrency() {
      this.$refs.createCurrency.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post("/admin/currencies", this.currency)
            .then((res) => {
              //   this.$store.dispatch("stopLoading");
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast('Currency created successfully')
              });
            })
            .catch((res) => {
              this.$store.dispatch("stopLoading");
              this.showErrorToast('There was a problem creating the currency')
            });
        }
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
      $("#create-currency").modal("hide");
    },
  },
  created() {
    const self = this;
    $(function () {
      $("#create-currency").on("show.bs.modal", function (e) {
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
</style>
