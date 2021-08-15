require("./bootstrap");
require("./echart");
require("./vee-validate");
require("./toastr");

window.Vue = require("vue").default;

Vue.component("example-component", () =>
    import("./components/ExampleComponent.vue")
);
Vue.component("dashboard", () =>
    import("./components/dashboard/Dashboard.vue")
);
Vue.component("bread-crumb", () => import("./components/UI/BreadCrumb.vue"));
Vue.component("spinner", () => import("./components/UI/Spinner.vue"));
Vue.component("booking-index", () =>
    import("./components/booking/BookingIndex.vue")
);
Vue.component("bus-type-index", () =>
    import("./components/bus-type/BusTypeIndex.vue")
);
// buses
Vue.component("bus-index", () => import("./components/buses/BusIndex.vue"));
Vue.component("bus-create", () => import("./components/buses/CreateBus.vue"));
Vue.component("bus-view", () => import("./components/buses/ViewBus.vue"));
Vue.component("bus-edit", () => import("./components/buses/EditBus.vue"));

// bus seat class
Vue.component("bus-seat-classes-index", () =>
    import("./components/bus-seat-classes/SeatClassIndex.vue")
);

//seats layout
Vue.component("seats-layout-index", () =>
    import("./components/seat-layout/SeatsLayoutIndex.vue")
);

// bus ratings
Vue.component("bus-ratings-index", () =>
    import("./components/bus-ratings/BusRatingsIndex.vue")
);

//settings
Vue.component("currency-index", () =>
    import("./components/currencies/CurrencyIndex.vue")
);
Vue.component("payment-method-index", () =>
    import("./components/payment-methods/PaymentMethodsIndex.vue")
);
Vue.component("system-settings-index", () =>
    import("./components/system-settings/SystemSettingsIndex.vue")
);

//passengers
Vue.component("passenger-index", () =>
    import("./components/passengers/PassengerIndex.vue")
);
Vue.component("passenger-view", () =>
    import("./components/passengers/ViewPassenger.vue")
);

// routes
Vue.component("route-index", () =>
    import("./components/routes/RoutesIndex.vue")
);
Vue.component("route-create", () =>
    import("./components/routes/CreateRoute.vue")
);
Vue.component("route-edit", () => import("./components/routes/EditRoute.vue"));
Vue.component("route-view", () => import("./components/routes/ViewRoute.vue"));

//pickup points
Vue.component("pickup-point-index", () =>
    import("./components/pickup/PickupIndex.vue")
);

//dropoff points
Vue.component("dropoff-point-index", () =>
    import("./components/drop-off-point/DropOffPointIndex.vue")
);

// auth
Vue.component("password-edit", () =>
    import("./components/auth/PasswordEdit.vue")
);
//amenities
Vue.component("amenities-index", () =>
    import("./components/amenities/AmenitiesIndex.vue")
);

//global components
Vue.component('FilterSidebar', () => import('./components/UI/FilterSidebar.vue'));

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

// sidebar js
$(function() {
    "use strict";
    var url = window.location + "";
    var path = [location.protocol, "//", location.host, location.pathname].join(
        ""
    );

    var element = $("ul#sidebarnav a").filter(function() {
        return (
            this.href === url ||
            this.href === path ||
            url.indexOf(this.href) === 0
        );
    });
    element.parentsUntil(".sidebar-nav").each(function(index) {
        if ($(this).is("li") && $(this).children("a").length !== 0) {
            $(this)
                .children("a")
                .addClass("active");
            $(this).parent("ul#sidebarnav").length === 0
                ? $(this).addClass("active")
                : $(this).addClass("selected");
        } else if (!$(this).is("ul") && $(this).children("a").length === 0) {
            $(this).addClass("selected");
        } else if ($(this).is("ul")) {
            $(this).addClass("in");
        }
    });

    element.addClass("active");
    $("#sidebarnav a").on("click", function(e) {
        if (!$(this).hasClass("active")) {
            // hide any open menus and remove all other classes
            $("ul", $(this).parents("ul:first")).removeClass("in");
            $("a", $(this).parents("ul:first")).removeClass("active");

            // open our new menu and add the open class
            $(this)
                .next("ul")
                .addClass("in");
            $(this).addClass("active");
        } else if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this)
                .parents("ul:first")
                .removeClass("active");
            $(this)
                .next("ul")
                .removeClass("in");
        }
    });
    $("#sidebarnav >li >a.has-arrow").on("click", function(e) {
        e.preventDefault();
    });
});
