/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component('dashboard', () => import('./components/dashboard/Dashboard.vue'));
Vue.component('bread-crumb', () => import('./components/UI/BreadCrumb.vue'));
// Vue.component('loader', require('./components/UI/Loader.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// vuex store
 import store from "./store";

 // vue good table
 import VueGoodTablePlugin from 'vue-good-table';

 // mixins
 import GlobalMixin from "./mixins/global";
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
    var path = [location.protocol, '//', location.host, location.pathname].join('');

    var element = $("ul#sidebarnav a").filter(function() {
        return this.href === url || this.href === path; // || url.href.indexOf(this.href) === 0;
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
