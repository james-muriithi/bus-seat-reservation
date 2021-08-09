<template>
  <span :style="seatClassColors" :title="seatTooltip">
    <svg
      id="Layer_1"
      data-name="Layer 1"
      :class="`seat${disabled ? ' disabled' : ''}`"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 100 100"
      v-contextmenu:contextmenu1
    >
      <path
        :class="`${classifier(idxr, idxc)}${disabled ? ' cls-disabled' : ''}`"
        d="M36,17.3H80.4a8.88,8.88,0,0,1,6.72-7.25A5.77,5.77,0,0,0,81.57,6H36a5.72,5.72,0,0,0-5.76,5.66A5.71,5.71,0,0,0,36,17.3Z"
      />
      <path
        :class="classifier(idxr, idxc)"
        d="M80.29,82.79H36A5.66,5.66,0,1,0,36,94.1H81.47a6.13,6.13,0,0,0,5.44-3.41A8.77,8.77,0,0,1,80.29,82.79Z"
      />
      <path
        :class="seatCentre(idxr, idxc)"
        d="M80.08,79.7V20.5H35.92A8.85,8.85,0,0,1,27.17,13h-18a4,4,0,0,0-4.06,4V82.79a4,4,0,0,0,4.06,3.95H27.28a8.65,8.65,0,0,1,8.75-7Z"
      />
      <path
        :class="classifier(idxr, idxc)"
        d="M89.15,12.93a5.71,5.71,0,0,0-5.76,5.65V82.15a5.76,5.76,0,0,0,11.52,0V18.58A5.71,5.71,0,0,0,89.15,12.93Z"
      />
      <path
        :class="classifier(idxr, idxc)"
        d="M90.21,9.94a8.93,8.93,0,0,0-8.74-7H36a8.94,8.94,0,0,0-8.75,6.93H9.15A7.22,7.22,0,0,0,2,17V82.79a7.06,7.06,0,0,0,7.15,7h18a8.85,8.85,0,0,0,8.75,7.26H81.47A8.91,8.91,0,0,0,90,90.9a8.81,8.81,0,0,0,8-8.75V18.58A8.84,8.84,0,0,0,90.21,9.94ZM36,6H81.57a5.77,5.77,0,0,1,5.55,4.06A8.88,8.88,0,0,0,80.4,17.3H36a5.71,5.71,0,0,1-5.76-5.65A5.72,5.72,0,0,1,36,6ZM27.28,86.74H9.15a4,4,0,0,1-4.06-3.95V17a4,4,0,0,1,4.06-4h18a8.85,8.85,0,0,0,8.75,7.47H80.08V79.7H36A8.65,8.65,0,0,0,27.28,86.74ZM81.47,94.1H36a5.66,5.66,0,1,1,0-11.31H80.29a8.77,8.77,0,0,0,6.62,7.9A6.13,6.13,0,0,1,81.47,94.1ZM94.91,82.15a5.76,5.76,0,0,1-11.52,0V18.58a5.76,5.76,0,0,1,11.52,0Z"
      />
      <text class="seat-label" x="25" y="55">{{ seat.seat_number }}</text>
    </svg>
    <v-contextmenu ref="contextmenu1">
      <v-contextmenu-item @click="makeSeatAGap">Remove Seat</v-contextmenu-item>
      <v-contextmenu-item @click="disableMySeat">{{
        seat.disabled ? "Enable Seat" : "Disable Seat"
      }}</v-contextmenu-item>
      <v-contextmenu-item @click="showModal"
        >Change Seat Class
      </v-contextmenu-item>
      <v-contextmenu-item @click="renameMySeat">Rename Seat</v-contextmenu-item>
    </v-contextmenu>

    <div v-if="open">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Change Seats Class</h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true" @click="closeModal"
                      >&times;</span
                    >
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 mb-2">
                      <label for="" class="form-label"
                        >Default Seat Class</label
                      >
                      <select class="form-control" v-model="defaultSeatClass">
                        <option
                          :value="seatClass.id"
                          v-for="seatClass in seatClasses"
                          :key="seatClass.id"
                        >
                          {{ seatClass.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="ml-auto text-right mb-2 me-2 border-top pt-1">
                    <button
                      class="btn btn-default"
                      @click="closeModal"
                    >
                      close
                    </button>
                    <button class="btn btn-primary ml-2" @click="changeClass">
                      Update
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </span>
</template>

<script>
import { directive, Contextmenu, ContextmenuItem } from "v-contextmenu/src";
import "v-contextmenu/dist/index.css";

export default {
  directives: {
    contextmenu: directive,
  },

  components: {
    [Contextmenu.name]: Contextmenu,
    [ContextmenuItem.name]: ContextmenuItem,
  },
  inject: [
    "makeGap",
    "renameSeat",
    "getSeat",
    "getSeatWithRC",
    "disableSeat",
    "seatClasses",
    "changeSeatClass",
  ],
  props: {
    idxr: {
      type: Number,
      required: true,
    },
    idxc: {
      type: Number,
      required: true,
    },
    seat: {
      type: Object,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      open: false,
      defaultSeatClassId: this.seat.class.id || '',
    };
  },
  computed: {
    defaultSeatClass: {
      get: function () {
        return this.defaultSeatClassId;
      },
      set: function (value) {
        this.defaultSeatClassId = value;
      },
    },
    seatTooltip() {
      return this.seat.disabled
        ? `Disabled seat`
        : `${this.seat.class.name} class`;
    },
    seatClassColors() {
      let data = {};
      if (this.seat.disabled) {
        data = {
          "--disabled-stroke": "#ada9a9",
          "--disabled-fill": "#ada9a9",
        };
      } else if (this.seat.class) {
        data = {
          "--stroke": "transparent",
          "--fill": this.seat.class.color,
        };
      }

      return data;
    },
  },
  watch: {
    // seat() {
    //   this.defaultSeatClass = this.seat.class.id;
    // }
  },
  methods: {
    seatCentre(r, c) {
      let seat = this.getSeatWithRC(r, c);
      if (seat != null) {
        if (seat.disabled) {
          return "cls-ra cls-disabled ";
        }
        return "cls-fa";
      }
    },
    classifier(r, c) {
      let seat = this.getSeatWithRC(r, c);
      if (seat != null) {
        if (seat.disabled) {
          return "cls-ra cls-disabled ";
        }

        return "cls-ra";
      }
    },
    makeSeatAGap() {
      this.makeGap(this.seat);
    },
    disableMySeat() {
      this.disableSeat({
        row: this.seat.position.r,
        col: this.seat.position.c,
      });
    },
    renameMySeat() {
      var seatNumber = prompt("Please enter your name", this.seat.seat_number);
      if (seatNumber) {
        if (!this.getSeat(seatNumber)) {
          this.renameSeat({
            row: this.seat.position.r,
            col: this.seat.position.c,
            seat_number: seatNumber,
          });
        } else if (seatNumber != this.seat.seat_number) {
          alert("seat number is already taken");
        }
      }
    },
    showModal() {
      this.open = true;
    },
    closeModal() {
      this.open = false;
    },
    changeClass() {
      this.changeSeatClass(this.seat.seat_number, this.defaultSeatClass);
      this.closeModal();
    },
  },
};
</script>

<style scoped>
.ml-2 {
  margin-left: 8px;
}
.ml-auto {
  margin-left: auto;
}
.text-right {
  text-align: right;
}

.modal {
  width: 450px;
  box-sizing: border-box;
  background-color: #fff;
  font-size: 20px;
  text-align: center;
  display: block;
  position: initial;
}
.seat {
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
  cursor: pointer;
}

.seat.disabled {
  cursor: default;
  /* pointer-events:none; */
}
.seat-label {
  font-size: 23px;
  font-weight: 700;
  color: #333;
}
.cls-selected {
  fill: green;
  stroke: #000;
  stroke-miterlimit: 10;
}
.cls-disabled {
  fill: var(--disabled-fill) !important;
  stroke: var(--disabled-stroke) !important;
  stroke-miterlimit: 10;
}
.cls-ra:not(.cls-disabled) {
  /* fill: #fff;
  stroke: rgb(7, 7, 7); */
  fill: var(--fill) !important;
  stroke: var(--stroke) !important;
  stroke-miterlimit: 10;
  stroke-width: 1;
}
.cls-rb {
  fill: gray;
  stroke: #000;
  stroke-miterlimit: 10;
}
.cls-fa {
  fill: #fff;
  stroke-miterlimit: 10;
}
.cls-fb {
  fill: pink;
  stroke: red;
  stroke-miterlimit: 10;
}
.cls-ma {
  fill: #fff;
  stroke: blue;
  stroke-miterlimit: 10;
}
.cls-mb {
  fill: royalblue;
  stroke: blue;
  stroke-miterlimit: 10;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
</style>
