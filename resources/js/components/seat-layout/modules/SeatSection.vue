<template>
  <div>
    <table class="mx-auto" v-if="cols > 0 && rows > 0">
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
          style="width: 50px; height: 50px; padding: 3px"
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
  </div>
</template>

<script>
import Seat from "./Seat.vue";
import TableHeader from "./TableHeader.vue";
export default {
  components: {
    Seat,
    TableHeader
  },
  inject: ["disableSeat", "getSeatWithRC", "changeSeatClass"],
  props: {
    seats: {
      required: true,
      type: Array
    },
    cols: {
      required: true,
      type: Number
    },
    rows: {
      required: true,
      type: Number
    },
    aisleColumns: {
      default: () => [],
      type: Array
    },
    aisleRows: {
      default: () => [],
      type: Array
    },
    gaps: {
      type: Array,
      default: () => []
    },
    disabledSeats: {
      default: () => [],
      type: Array
    }
  },
  data() {
    return {};
  },
  methods: {
    getSeat(r, c) {
      const seat = this.seats.find(seat => {
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

      if (this.aisleColumns.some(column => column == c)) {
        if (this.aisleRows.some(row => row == r)) {
          return true;
        }
        if (r >= 1 && r <= this.rows - 1) {
          return true;
        }
      } else if (this.aisleRows.some(row => row == r)) {
        return true;
      }
      return false;
    },
    isAisleRow(index) {
      return this.aisleRows.some(row => row == index);
    },
    isAisleColumn(index) {
      return this.aisleColumns.some(col => col == index);
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
    }
  }
};
</script>
