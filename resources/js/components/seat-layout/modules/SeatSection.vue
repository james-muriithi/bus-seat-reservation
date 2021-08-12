<template>
  <div v-if="cols > 0 && rows > 0">
    <table class="mx-auto">
      <tr>
        <th></th>
        <table-header
          class="pb-2 text-center"
          v-for="(indexc, column) in cols"
          :key="`c-${column}`"
          style="width: 50px"
          :index="indexc"
          type="column"
          @disableSeats="disableSeats"
          @changeSeatsClass="changeSeatsClass"
          :isAisle="isAisleColumn(indexc)"
        >
        </table-header>
      </tr>

      <tr v-for="(indexr, row) in rows" :key="`r-${row}`">
        <table-header
          class="pl-2"
          style="width: 50px"
          :index="indexr"
          @disableSeats="disableSeats"
          @changeSeatsClass="changeSeatsClass"
          :isAisle="isAisleRow(indexr)"
        ></table-header>
        <td
          v-for="(indexc, column) in cols"
          :key="`c-${column}`"
          style="width: 55px; height: 55px; padding: 5px"
        >
          <seat
            :idxc="indexc"
            :idxr="indexr"
            :seat="getSeat(indexr, indexc)"
            :disabled="isDisabled(indexr, indexc)"
            v-if="!isAisle(indexc, indexr)"
          ></seat>
        </td>
      </tr>
    </table>
    <div class="mt-5 pr-3 col-12 text-right">
      <button class="btn btn-success ripple" @click="saveLayout">
        Save Layout
      </button>
    </div>
  </div>
</template>

<script>
import Seat from "./Seat.vue";
import TableHeader from "./TableHeader.vue";
export default {
  components: {
    Seat,
    TableHeader,
  },
  inject: ["disableSeat", "getSeatWithRC", "changeSeatClass", "resetAll"],
  props: {
    seats: {
      required: true,
      type: Array,
    },
    cols: {
      required: true,
      type: Number,
    },
    rows: {
      required: true,
      type: Number,
    },
    seat_prefix: {
      required: true,
    },
    defaultSeatClass: {
      required: true,
    },
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
    bus: {
      required: true,
      type: Object,
    },
  },
  data() {
    return {};
  },
  methods: {
    reset() {
      this.resetAll();
    },
    getSeat(r, c) {
      const seat = this.seats.find((seat) => {
        return seat.position.r == r && seat.position.c == c;
      });

      return seat;
    },
    isAisle(c, r) {
      if (this.gaps.length > 0) {
        if (this.gaps.some(({ row, col }) => row == r && col == c)) {
          return true;
        }
      }

      if (this.aisleColumns.some((column) => column == c)) {
        if (this.aisleRows.some((row) => row == r)) {
          return true;
        }
        if (r >= 1 && r <= this.rows - 1) {
          return true;
        }
      } else if (this.aisleRows.some((row) => row == r)) {
        return true;
      }
      return false;
    },
    isAisleRow(index) {
      return this.aisleRows.some((row) => row == index);
    },
    isAisleColumn(index) {
      return this.aisleColumns.some((col) => col == index);
    },
    isDisabled(row, col) {
      return this.disabledSeats.some(
        ({ row: r, col: c }) => r == row && c == col
      );
    },
    disableSeats({ index, target }) {
      console.log(index, target);
      if (target == "row") {
        for (let i = 1; i <= this.cols; i++) {
          this.disableSeat({ row: index, col: i });
        }
      } else if (target == "column") {
        for (let i = 1; i <= this.rows; i++) {
          this.disableSeat({ row: i, col: index });
        }
      }
    },
    changeSeatsClass({ index, target, seatClassId }) {
      if (target == "row") {
        for (let i = 1; i <= this.cols; i++) {
          const seat = this.getSeatWithRC(index, i);
          if (seat) {
            this.changeSeatClass(seat.seat_number, seatClassId);
          }
        }
      } else if (target == "column") {
        for (let i = 1; i <= this.rows; i++) {
          const seat = this.getSeatWithRC(i, index);
          if (seat) {
            this.changeSeatClass(seat.seat_number, seatClassId);
          }
        }
      }
    },
    saveLayout() {
      this.$store.dispatch("startLoading");
      let Save = true;
      if (!_.isEmpty(this.bus.seat_layout)) {
        Save = confirm("Are you sure you want to update the bus seat layout?");
      }
      if (!Save) {
        this.$store.dispatch("stopLoading");
        return;
      }

      axios
        .post("/admin/seat-layouts", {
          bus_id: this.bus.id,
          rows: this.rows,
          columns: this.cols,
          details: {
            seats: this.seats,
            cols: this.cols,
            rows: this.rows,
            aisleColumns: this.aisleColumns,
            aisleRows: this.aisleRows,
            gaps: this.gaps,
            disabledSeats: this.disabledSeats,
            seat_prefix: this.seat_prefix,
            defaultSeatClass: this.defaultSeatClass.id,
          },
        })
        .then((res) => {
          this.$store.dispatch("stopLoading");
          this.showSuccessToast(
            `${this.bus.bus_reg_no} - ${this.bus.bus_name} Seat Layout created successfully`
          );
          this.reset();
        })
        .catch((err) => {
          this.$store.dispatch("stopLoading");
          console.log(err);
          this.showErrorToast("There was an error creating the seats layout");
        });
    },
  },
};
</script>
