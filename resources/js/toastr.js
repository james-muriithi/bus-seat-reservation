import Vue from "vue";

// import plugin
import VueToastr from "vue-toastr";
// use plugin
Vue.use(VueToastr, {
    defaultTimeout: 3000,
    defaultProgressBar: false,
    defaultProgressBarValue: 0,
    defaultType: "success",
    defaultPosition: "toast-top-right",
    defaultCloseOnHover: false,
    defaultClassNames: ["animated", "zoomInUp"],
    progressbar: true,
});
