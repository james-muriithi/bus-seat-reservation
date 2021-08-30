<template>
  <validation-observer ref="createRoute">
    <form @submit.prevent="">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <!-- pickup point -->
                <validation-provider
                  name="Pickup Point"
                  :rules="{ required: true }"
                  v-slot="validationContext"
                >
                  <div class="form-group">
                    <label for="name">Pickup Point</label>
                    <select2
                      id="pickup_point"
                      aria-describedby="bus-feedback"
                      v-model.trim="pickup_point"
                      :options="pickup_points"
                      :settings="{
                        theme: 'bootstrap',
                        multiple: false,
                        closeOnSelect: true,
                      }"
                      required
                    >
                    </select2>
                    <div id="route-feedback" class="invalid-feedback w-100">
                      {{ validationContext.errors[0] }}
                    </div>
                  </div>
                </validation-provider>

                <!-- drop point -->
                <validation-provider
                  name="Drop Point"
                  :rules="{ required: true }"
                  v-slot="validationContext"
                >
                  <div class="form-group">
                    <label for="name">Pickup Point</label>
                    <select2
                      id="pickup_point"
                      aria-describedby="bus-feedback"
                      v-model.trim="pickup_point"
                      :options="pickup_points"
                      :settings="{
                        theme: 'bootstrap',
                        multiple: false,
                        closeOnSelect: true,
                      }"
                      required
                    >
                    </select2>
                    <div id="route-feedback" class="invalid-feedback w-100">
                      {{ validationContext.errors[0] }}
                    </div>
                  </div>
                </validation-provider>

              </div>

              <div class="col-md-12 text-right">
                <button class="btn btn-primary" type="submit">Search</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </validation-observer>
</template>

<
<script>
import Select2 from "v-select2-component";
import "select2-bootstrap-theme/dist/select2-bootstrap.min.css";

export default {
    name: "SearchSection",
    components: { Select2 },
    data() {
        return {
            pickup_points: [],
            pickup_point: '',
            drop_point: '',
            travel_date: this->today
        }
    },
    computed: {
      today() {
        return moment().format("YYYY-MM-DD");
      },
    },
    methods: {
        //---- Validation State Form
        getValidationState({ dirty, validated, valid = null }) {
        if (dirty || validated) {
            return valid ? "is-valid" : "is-invalid";
        }
        return "";
        },
    },
}
</script>
