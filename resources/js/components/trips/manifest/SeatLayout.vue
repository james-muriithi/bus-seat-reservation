<template>
  <div v-if="cols > 0 && rows > 0">
    <table class="mx-auto">
      <tr v-for="(indexr, row) in rows" :key="`r-${row}`">
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
  </div>
</template>

<script>
import Seat from "../../buses/modules/Seat.vue";
export default {
  components: {
    Seat,
  },
  provide() {
    return {
      getSeat: this.getSeatWithSeatNumber,
      getSeatWithRC: this.getSeat,
    };
  },
  props: {
    seats: {
      required: true,
      type: Array,
    },
    bookedSeats: {
      type: Array,
      default: () => [],
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
  },
  data() {
    return {};
  },
  methods: {
    getSeat(r, c) {
      const seat = this.seats.find((seat) => {
        return seat.position.r == r && seat.position.c == c;
      });
      const bookedSeat = this.bookedSeats.find(s => s.seat_number == seat.seat_number);
      if (bookedSeat) {
        seat.booked = true;
        seat.passenger = `${bookedSeat.passenger_name}`
      }

      return seat;
    },
    getSeatWithSeatNumber(seatNumber) {
      return this.seats.find((seat) => {
        return seat.seat_number == seatNumber;
      });
    },
    getSeatClass(id) {
      return this.seatClasses.find((seatClass) => seatClass.id == id);
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
  },
};
</script>

<style scoped>
table{
  /* transform: rotate(-90deg); */
}
</style>
