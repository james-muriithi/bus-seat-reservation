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
                v-model.trim="defaultSeatClass"
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
            :key="`Col ${gap.col} Row ${gap.row}`"
            @remove="removeGap(gap)"
          />
        </div>
        <div class="mb-1" v-if="aisleColumns.length > 0">
          <p class="mb-1">Aisle Columns</p>
          <material-chip
            v-for="col in aisleColumns"
            :text="`Column ${col}`"
            :key="`Column ${col}`"
            @remove="removeAisleColumn(col)"
          />
        </div>

        <!-- aisle rows -->
        <div class="" v-if="aisleRows.length > 0">
          <p class="mb-1">Aisle Rows</p>
          <material-chip
            v-for="row in aisleRows"
            :text="`Row ${row}`"
            :key="`Row ${row}`"
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
  inject: [
    "removeAisleColumn",
    "removeAisleRow",
    "removeGap",
    "makeAisle",
    "makeGap",
    "disableSeat",
  ],
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
    resetFormFlag: {
      type: Boolean,
      default: false,
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
      seats: [],
    };
  },
  watch: {
    resetFormFlag(newValue) {
      if (newValue) {
        this.resetForm();
      }
    },
    selectedBus(newValue) {
      if (newValue) {
        this.fetchBus(+newValue);
      } else {
        this.selectedBusDetails = {};
      }
    },
    selectedBusDetails(newValue) {
      if (newValue) {
        if (!_.isEmpty(newValue.seat_layout)) {
          this.showOldLayout(newValue);
        }
      }
    },
  },
  methods: {
    resetForm() {
      this.rows = "";
      this.seat_prefix = "";
      this.cols = "";
      this.defaultSeatClass = "1";
      this.selectedBus = "";
    },
    generate() {
      this.$refs.createSeatLayout.validate().then((valid) => {
        if (valid) {
          this.$emit(
            "generate",
            {
              rows: this.rows,
              cols: this.cols,
              seat_prefix: this.seat_prefix,
              defaultSeatClass: this.getSeatClass(this.defaultSeatClass),
              selectedBusDetails: this.selectedBusDetails,
            },
            this.seats
          );
        //   this.seats = [];
        }
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

    showOldLayout(newValue) {
      let useOldLayout = confirm(
        "The bus has a layout already, would you like to display the old layout?"
      );
      if (!useOldLayout) {
        return;
      }
      //form details
      this.rows = newValue.seat_layout.rows;
      this.cols = newValue.seat_layout.columns;
      this.seat_prefix = newValue.seat_layout.details.seat_prefix ?? "";
      this.defaultSeatClass = newValue.seat_layout.details.defaultSeatClass;
      this.seats = newValue.seat_layout.details.seats;

      // other details
      this.makeAisles(newValue.seat_layout.details.aisleColumns, "column");
      this.makeAisles(newValue.seat_layout.details.aisleRows, "row");
      this.disableSeats(newValue.seat_layout.details.disabledSeats);
      this.makeGaps(newValue.seat_layout.details.gaps);

      this.$nextTick(() => {
        this.generate();
      });
    },

    disableSeats(seats) {
      seats.forEach(({ col, row }) => {
        this.disableSeat({
          row,
          col,
        });
      });
    },
    makeGaps(seats) {
      seats.forEach((seat) => {
        seat.position = {
          r: seat.row,
          c: seat.col,
        };
        this.makeGap(seat);
      });
    },
    makeAisles(aisles, target) {
      aisles.forEach((index) => {
        let data = {
          index,
          target,
        };

        this.makeAisle(data);
      });
    },
  },
};
</script>
