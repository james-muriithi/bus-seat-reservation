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
    <!-- <Modal v-model="open" :close="closeModal">
      <div class="modal">
        <div class="pt-2">
          <p class="border-bottom mb-0">Change Seat Class</p>
        </div>
        <div class="modal-body text-start mb-2">
          <div class="row">
            <div class="col-12 mb-2">
              <label for="" class="form-label">Default Seat class</label>
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
        <div class="ml-auto text-right mb-2 me-2 border-top pt-1">
          <button class="btn btn-secondary" @click="closeModal">close</button>
          <button class="btn btn-primary ml-2" @click="changeClass">
            Update
          </button>
        </div>
      </div>
    </Modal> -->
  </th>
</template>

<script>
import { directive, Contextmenu, ContextmenuItem } from "v-contextmenu/src";
import "v-contextmenu/dist/index.css";

export default {
  directives: {
    contextmenu: directive
  },
  inject: ["makeAisle", "seatClasses"],
  components: {
    [Contextmenu.name]: Contextmenu,
    [ContextmenuItem.name]: ContextmenuItem
  },
  emits: ["disableSeats", "changeSeatsClass"],
  props: {
    index: {
      type: Number,
      required: true
    },
    type: {
      type: String,
      default: "row"
    },
    isAisle: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      open: false,
      defaultSeatsClass: 1
    };
  },
  methods: {
    makeMyAisle() {
      let data = {
        index: this.index,
        target: this.type
      };

      this.makeAisle(data);
    },
    disableSeats() {
      this.$emit("disableSeats", {
        index: this.index,
        target: this.type
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
        seatClassId: this.defaultSeatsClass
      });

      this.closeModal();
    }
  }
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
</style>
