<template>
  <validation-observer ref="searchTrips">
    <form @submit.prevent="">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5>Search buses</h5>
              <div class="form-row">
                <div class="col-md-12">
                  <!-- pickup point -->
                  <validation-provider
                    name="Pickup Point"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group w-100">
                      <label for="name">Pickup Point</label>
                      <select2
                        id="pickup_point"
                        aria-describedby="bus-feedback"
                        v-model.trim="from"
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
              </div>

              <div class="form-row">
                <div class="col-md-12">
                  <!-- drop point -->
                  <validation-provider
                    name="Drop Point"
                    :rules="{ required: true }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Drop Point</label>
                      <select2
                        id="drop_point"
                        v-model.trim="to"
                        :options="drop_points"
                        :settings="{
                          theme: 'bootstrap',
                          multiple: false,
                          closeOnSelect: true,
                        }"
                        required
                      >
                      </select2>
                      <div
                        id="drop-point-feedback"
                        class="invalid-feedback w-100"
                      >
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-12">
                  <!-- drop point -->
                  <validation-provider
                    name="Travel Date"
                    :rules="{
                      required: true,
                    }"
                    v-slot="validationContext"
                  >
                    <div class="form-group">
                      <label for="name">Travel Date</label>
                      <input
                        type="date"
                        class="form-control"
                        name="travel_date"
                        v-model="travel_date"
                      />
                      <div
                        id="travel-date-feedback"
                        class="invalid-feedback w-100"
                      >
                        {{ validationContext.errors[0] }}
                      </div>
                    </div>
                  </validation-provider>
                </div>
              </div>

              <div class="col-md-12 text-right mt-3">
                <button
                  class="btn btn-primary"
                  @click="searchTrips"
                  type="submit"
                >
                  Search
                </button>
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
    emits: ['search'],
    props: {
      pickup_points: {
        type: Array,
        default: () => []
      },
      drop_points: {
        type: Array,
        default: () => [],
      },
    },
    data() {
        return {
            from: '',
            to: '',
            travel_date: ''
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
        searchTrips(){
          this.$refs.searchTrips.validate().then((valid) => {
            if (valid) {
              this.$emit('search', this.from, this.to, this.travel_date);
            }else{
              console.log('kkkk');
            }
          });
        }
    },
    created() {
      this.travel_date = this.today;
    },
}
</script>
