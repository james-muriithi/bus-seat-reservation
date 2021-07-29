<template>
  <div class="modal" id="edit-currency">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Currency</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="editCurrency">
            <form @submit.prevent="editCurrency" ref="form">
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
  props: {
    currency: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    editCurrency() {
      this.$refs.editCurrency.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post(`/admin/currencies/${this.currency.id}`, {
              ...this.currency,
              _method: "PUT",
            })
            .then((res) => {
              //   this.$store.dispatch("stopLoading");
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
              });
            })
            .catch((res) => {
              this.$store.dispatch("stopLoading");
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
      $("#edit-currency").modal("hide");
    },
  },
};
</script>
<style>
.fade:not(.show) {
  opacity: 1;
}
</style>
