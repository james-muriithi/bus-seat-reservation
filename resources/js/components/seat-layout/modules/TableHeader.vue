<template>
  <th v-contextmenu:contextmenu2>
    {{ index }}
    <v-contextmenu ref="contextmenu2">
      <v-contextmenu-item @click="makeMyAisle" class="text-capitalize">{{
        isAisle ? `Remove aisle` : `Make ${type} an aisle`
      }}</v-contextmenu-item>
      <v-contextmenu-item v-if="!isAisle" @click="showModal"
        >Change Seats Class</v-contextmenu-item
      >
      <v-contextmenu-item @click="disableSeats"
        >Disable Seats</v-contextmenu-item
      >
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
                    <span aria-hidden="true" @click="closeModal">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 mb-2">
                      <label for="" class="form-label"
                        >Default Seat class</label
                      >
                      <select class="form-control" v-model="defaultSeatsClass">
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
                    <button class="btn btn-default" @click="closeModal">
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
  </th>
</template>

<script>
import { directive, Contextmenu, ContextmenuItem } from "v-contextmenu/src";
import "v-contextmenu/dist/index.css";

export default {
  directives: {
    contextmenu: directive,
  },
  inject: ["makeAisle", "seatClasses"],
  components: {
    [Contextmenu.name]: Contextmenu,
    [ContextmenuItem.name]: ContextmenuItem,
  },
  emits: ["disableSeats", "changeSeatsClass"],
  props: {
    index: {
      type: Number,
      required: true,
    },
    type: {
      type: String,
      default: "row",
    },
    isAisle: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      open: false,
      defaultSeatsClass: 1,
    };
  },
  methods: {
    makeMyAisle() {
      let data = {
        index: this.index,
        target: this.type,
      };

      this.makeAisle(data);
    },
    disableSeats() {
      this.$emit("disableSeats", {
        index: this.index,
        target: this.type,
      });
    },
    showModal() {
      this.open = true;
    },
    closeModal() {
      this.open = false;
    },
    changeClass() {
      this.$emit("changeSeatsClass", {
        index: this.index,
        target: this.type,
        seatClassId: this.defaultSeatsClass,
      });

      this.closeModal();
    },
  },
};
</script>

<style scoped>
th {
  cursor: pointer;
}
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
