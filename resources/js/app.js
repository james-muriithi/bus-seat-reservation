require("./bootstrap");
require("./sidebar")
require("./echart");
require("./vee-validate");
require("./toastr");

window.Vue = require("vue").default;

Vue.component("example-component", () =>
    import ("./components/ExampleComponent.vue")
);
Vue.component("dashboard", () =>
    import ("./components/dashboard/Dashboard.vue")
);
Vue.component("bread-crumb", () =>
    import ("./components/UI/BreadCrumb.vue"));
Vue.component("spinner", () =>
    import ("./components/UI/Spinner.vue"));

// booking    
Vue.component("booking-index", () =>
    import ("./components/booking/BookingIndex.vue")
);
Vue.component("booking-create", () =>
    import ("./components/booking/BookingCreate.vue")
);

Vue.component("bus-type-index", () =>
    import ("./components/bus-type/BusTypeIndex.vue")
);
// buses
Vue.component("bus-index", () =>
    import ("./components/buses/BusIndex.vue"));
Vue.component("bus-create", () =>
    import ("./components/buses/CreateBus.vue"));
Vue.component("bus-view", () =>
    import ("./components/buses/ViewBus.vue"));
Vue.component("bus-edit", () =>
    import ("./components/buses/EditBus.vue"));

// bus seat class
Vue.component("bus-seat-classes-index", () =>
    import ("./components/bus-seat-classes/SeatClassIndex.vue")
);

//seats layout
Vue.component("seats-layout-index", () =>
    import ("./components/seat-layout/SeatsLayoutIndex.vue")
);

// bus ratings
Vue.component("bus-ratings-index", () =>
    import ("./components/bus-ratings/BusRatingsIndex.vue")
);

//settings
Vue.component("currency-index", () =>
    import ("./components/currencies/CurrencyIndex.vue")
);
Vue.component("payment-method-index", () =>
    import ("./components/payment-methods/PaymentMethodsIndex.vue")
);
Vue.component("system-settings-index", () =>
    import ("./components/system-settings/SystemSettingsIndex.vue")
);

//passengers
Vue.component("passenger-index", () =>
    import ("./components/passengers/PassengerIndex.vue")
);
Vue.component("passenger-view", () =>
    import ("./components/passengers/ViewPassenger.vue")
);

// routes
Vue.component("route-index", () =>
    import ("./components/routes/RoutesIndex.vue")
);
Vue.component("route-create", () =>
    import ("./components/routes/CreateRoute.vue")
);
Vue.component("route-edit", () =>
    import ("./components/routes/EditRoute.vue"));
Vue.component("route-view", () =>
    import ("./components/routes/ViewRoute.vue"));

//pickup points
Vue.component("pickup-point-index", () =>
    import ("./components/pickup/PickupIndex.vue")
);

//dropoff points
Vue.component("dropoff-point-index", () =>
    import ("./components/drop-off-point/DropOffPointIndex.vue")
);

// auth
Vue.component("password-edit", () =>
    import ("./components/auth/PasswordEdit.vue")
);
//amenities
Vue.component("amenities-index", () =>
    import ("./components/amenities/AmenitiesIndex.vue")
);

// trips
Vue.component("trips-index", () =>
    import ("./components/trips/TripsIndex.vue"));
Vue.component("trips-view", () =>
    import ("./components/trips/ViewTrip.vue"));

// route price variations
Vue.component("price-variations-index", () =>
    import ("./components/route-price-variations/PriceVariationIndex.vue"));

// payments
Vue.component("payment-index", () =>
    import ("./components/payment/PaymentIndex.vue"));

//global components
Vue.component("FilterSidebar", () =>
    import ("./components/UI/FilterSidebar.vue")
);

// vuex store
import store from "./store";

// vue good table
import VueGoodTablePlugin from "vue-good-table";

// mixins
import GlobalMixin from "./mixins/global";
import Vue from "vue";
Vue.mixin(GlobalMixin);

Vue.use(VueGoodTablePlugin);

const app = new Vue({
    store,
    el: "#app"
});