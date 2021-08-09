<template>
  <div class="modal" id="edit-payment-method">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Payment Method</h4>
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <validation-observer ref="editPaymentMethod">
            <form @submit.prevent="editPaymentMethod" ref="form">
              <div class="form-row">
                <div class="col-md-12">
                  <validation-provider
                    name="Method Name"
                    :rules="{ required: true, min: 2, max: 20 }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Method Name</label>
                      <input
                        type="text"
                        placeholder="Enter payment method name"
                        aria-describedby="Name-feedback"
                        v-model.trim="paymentMethod.name"
                        :class="`form-control ${getValidationState(
                          validationContext
                        )}`"
                      />
                      <div id="Name-feed back" class="invalid-feedback w-100">
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>
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
    paymentMethod: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    editPaymentMethod() {
      this.$refs.editPaymentMethod.validate().then((valid) => {
        if (valid) {
          //submit data
          this.$store.dispatch("startLoading");
          axios
            .post(`/admin/payment-methods/${this.paymentMethod.id}`, {
              ...this.paymentMethod,
              _method: "PUT",
            })
            .then((res) => {
              //   this.$store.dispatch("stopLoading");
              this.closeModal();

              this.$nextTick(() => {
                this.$emit("update");
                this.showSuccessToast('Payment method updated successfully')
              });
            })
            .catch((res) => {
              this.$store.dispatch("stopLoading");
              this.showErrorToast('There was a problem updating the payment method')
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
      $("#edit-payment-method").modal("hide");
    },
  },
};
</script>
<style>
.fade:not(.show) {
  opacity: 1;
}
</style>
