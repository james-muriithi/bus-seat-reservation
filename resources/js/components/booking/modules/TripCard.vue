<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-3">
          <img
            :src="asset('images/bus.svg')"
            height="50"
            width="50"
            class="img-thumbnail border-0"
          />
          <div class="bus_title font-weight-bold">
            {{ trip.bus.bus_name || "" }}
          </div>
          <div class="bus_reg fs-11">
            {{ trip.bus.bus_reg_no }} - {{ trip.bus.bus_type }}
          </div>
          <div class="amenities row justify-content-center d-none d-sm-flex">
            <div class="col-3" v-for="amenity in amenities" :key="amenity.name">
              <i :class="amenity.icon" :title="amenity.name"></i>
            </div>
          </div>
        </div>
        <div class="col-md-2 position-relative d-flex d-md-block mt-md-3 fs-13">
          <p class="text-left">{{ pickup_time }}</p>
          <p class="ml-md-auto position-absolute bottom-0 mb-2">
            {{ drop_time }}
          </p>
        </div>
        <div class="col-md-3 prices text-left d-flex align-items-center">
          <div class="w-100">
            <div
              class="price fs-12 d-flex mb-2"
              v-for="priceList in trip.trip_price_list"
              :key="priceList.seatType"
            >
              <span>{{ priceList.seatType }}:</span>
              <span class="ml-auto">
                {{ priceList.currencyCode }} {{ priceList.fare }}
              </span>
            </div>
          </div>
        </div>
        <div
          class="
            col-md-3
            prices
            justify-content-center
            d-flex
            align-items-center
            px-0
          "
        >
          <div class="w-100 mt-md-3">
            <p class="mb-2">{{ trip.available_seat_count }} seats available</p>
            <button class="btn btn-rounded btn-success">View Seats</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<<script>
export default {
    name: "TripCard",
    props: {
        trip: {
            required: true,
            type: Object
        }
    },
    computed: {
        pickup_time(){
            return moment(this.trip.pickup_time, ['HH:mm:ss']).format("hh:mm A");
        },
        drop_time(){
            return moment(this.trip.drop_time, ['HH:mm:ss']).format("hh:mm A");
        },
        amenities(){
            return this.trip.amenities.slice(0, 3);
        }
    }
}
</script>

<style scoped>
.bottom-0 {
  bottom: 0;
}
.fs-13 {
  font-size: 13px;
}
.fs-12 {
  font-size: 12px;
}
.fs-11 {
  font-size: 11px;
}
.fs-10 {
  font-size: 10px;
}
@media screen and (max-width: 767px) {
  .ml-md-auto {
    margin-left: auto !important;
    position: relative !important;
  }
  .mt-md-3 {
    margin-top: 12px;
  }
}
</style>