<template>
  <validation-observer ref="createSeatLayout">
    <form class="text-start" @submit.prevent="">
      <div class="row mb-4">
        <!-- bus -->
        <div class="col-md-12 mb-2">
          <validation-provider
            name="Bus"
            :rules="{ required: false }"
            v-slot="validationContext"
          >
            <div class="form-group">
              <label for="name">Bus</label>
              <select2
                id="amenities"
                aria-describedby="bus-feedback"
                v-model.trim="selectedBus"
                :options="buses"
                :settings="{
                  theme: 'bootstrap',
                  multiple: false,
                  closeOnSelect: true,
                }"
              >
              </select2>
              <div id="bus-feedback" class="invalid-feedback w-100">
                {{ validationContext.errors[0] }}
              </div>
            </div>
          </validation-provider>
        </div>

        <div class="col-12 mb-2">
          <validation-provider
            name="Rows"
            v-slot="validationContext"
            :rules="{ required: true, min_value: 1, integer: true }"
          >
            <div class="form-group">
              <label for="" class="form-label">Rows</label>
              <input
                type="number"
                :class="`form-control ${getValidationState(validationContext)}`"
                aria-describedby="row-help"
                autocomplete="off"
                v-model="rows"
              />
              <div id="row-help" class="invalid-feedback w-100">
                {{ validationContext.errors[0] }}
              </div>
            </div>
          </validation-provider>
        </div>
        <div class="col-12 mb-2">
          <validation-provider
            name="columns"
            v-slot="validationContext"
            :rules="{ required: true, min_value: 1, integer: true }"
          >
            <div class="form-group">
              <label for="" class="form-label">Columns</label>
              <input
                type="number"
                :class="`form-control ${getValidationState(validationContext)}`"
                aria-describedby="emailHelp"
                autocomplete="off"
                v-model="cols"
              />
              <div id="bus-feedback" class="invalid-feedback w-100">
                {{ validationContext.errors[0] }}
              </div>
            </div>
          </validation-provider>
        </div>

        <div class="col-12 mb-2">
          <validation-provider
            name="seat class"
            v-slot="validationContext"
            :rules="{ required: true }"
          >
            <div class="form-group">
              <label for="" class="form-label">Default Seat class</label>
              <select
                :class="`form-control ${getValidationState(validationContext)}`"
                v-model="defaultSeatClass"
              >
                <option
                  :value="seatClass.id"
                  v-for="seatClass in seatClasses"
                  :key="seatClass.id"
                >
                  {{ seatClass.name }}
                </option>
              </select>
              <div id="bus-feedback" class="invalid-feedback w-100">
                {{ validationContext.errors[0] }}
              </div>
            </div>
          </validation-provider>
        </div>
        <div class="col-12 mb-2">
          <validation-provider
            name="prefix"
            :rules="{ max: 1 }"
            v-slot="validationContext"
          >
            <div class="form-group">
              <label for="" class="form-label"
                >Seat Number Prefix (optional)</label
              >
              <input
                type="text"
                :class="`form-control ${getValidationState(validationContext)}`"
                v-model="seat_prefix"
                autocomplete="off"
              />
              <div id="bus-feedback" class="invalid-feedback w-100">
                {{ validationContext.errors[0] }}
              </div>
            </div>
          </validation-provider>
        </div>
      </div>

      <div class="col-md-12 text-right">
        <button
          type="button"
          :disabled="!!!selectedBus"
          class="btn btn-primary"
          @click="generate"
        >
          Preview
        </button>
      </div>

      <div class="mt-3">
        <div class="mb-1" v-if="gaps.length > 0">
          <p class="mb-1">Removed Seats</p>
          <material-chip
            v-for="gap in gaps"
            :text="`Col ${gap.col} Row ${gap.row}`"
            :index="gap"
            :key="gap"
            @remove="removeGap(gap)"
          />
        </div>
        <div class="mb-1" v-if="aisleColumns.length > 0">
          <p class="mb-1">Aisle Columns</p>
          <material-chip
            v-for="col in aisleColumns"
            :text="`Column ${col}`"
            :index="col"
            :key="col"
            @remove="removeAisleColumn(col)"
          />
        </div>

        <!-- aisle rows -->
        <div class="" v-if="aisleRows.length > 0">
          <p class="mb-1">Aisle Rows</p>
          <material-chip
            v-for="row in aisleRows"
            :text="`Row ${row}`"
            :index="row"
            :key="row"
            @remove="removeAisleRow(row)"
          />
        </div>
      </div>
    </form>
  </validation-observer>
</template>

<script>
import Select2 from "v-select2-component";
import MaterialChip from "./UI/MaterialChip.vue";
import "select2-bootstrap-theme/dist/select2-bootstrap.min.css";
export default {
  components: { MaterialChip, Select2 },
  emits: ["generate"],
  inject: ["removeAisleColumn", "removeAisleRow", "removeGap"],
  props: {
    aisleColumns: {
      default: () => [],
      type: Array,
    },
    aisleRows: {
      default: () => [],
      type: Array,
    },
    gaps: {
      type: Array,
      default: () => [],
    },
    disabledSeats: {
      default: () => [],
      type: Array,
    },
    seatClasses: {
      type: Array,
      default: () => [],
    },
    buses: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      rows: "",
      cols: "",
      seat_prefix: "",
      defaultSeatClass: "1",
      selectedBus: "",
      selectedBusDetails: {},
    };
  },
  watch: {
    selectedBus(newValue) {
      if (newValue) {
        this.fetchBus(+newValue);
      }
    },
  },
  methods: {
    generate() {
      this.$emit("generate", {
        rows: this.rows,
        cols: this.cols,
        seat_prefix: this.seat_prefix,
        defaultSeatClass: this.getSeatClass(this.defaultSeatClass),
        selectedBusDetails: this.selectedBusDetails,
      });
    },
    getSeatClass(id) {
      return this.seatClasses.find((seatClass) => seatClass.id == id);
    },

    fetchBus(busId) {
      this.$store.dispatch("startLoading");

      axios
        .get("/admin/buses/" + busId)
        .then((res) => {
          this.selectedBusDetails = res.data.data;

          this.$store.dispatch("stopLoading");
        })
        .catch((res) => {
          this.$store.dispatch("stopLoading");
        });
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
