import Vue from "vue";
// const { ValidationObserver, ValidationProvider, extend, localize } = () =>
//     import("vee-validate");
import {
    ValidationObserver,
    ValidationProvider,
    extend,
    localize,
    configure
} from "vee-validate";
import * as rules from "vee-validate/dist/rules";

localize({
    en: {
        messages: {
            required: "This field is required",
            required_if: "This field is required",
            regex: "This field must be a valid",
            mimes: `This field must have a valid file type.`,
            size: (_, { size }) => `This field size must be less than ${size}.`,
            min: "This field must have no less than {length} characters",
            max: (_, { length }) =>
                `This field must have no more than ${length} characters`
        }
    }
});
// Install VeeValidate rules and localization
Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule]);
});

configure({
    events: "change|blur"
});

// Register it globally
Vue.component("ValidationObserver", ValidationObserver);
Vue.component("ValidationProvider", ValidationProvider);
