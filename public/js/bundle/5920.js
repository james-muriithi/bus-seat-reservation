(self.webpackChunk=self.webpackChunk||[]).push([[5920],{6257:(e,r,n)=>{"use strict";n.d(r,{Z:()=>o});var t=n(94015),a=n.n(t),i=n(23645),s=n.n(i)()(a());s.push([e.id,".fade:not(.show){opacity:1}","",{version:3,sources:["webpack://./resources/js/components/passengers/CreatePassenger.vue"],names:[],mappings:"AAoPA,iBACA,SACA",sourcesContent:['<template>\r\n  <div class="modal" id="create-passenger">\r\n    <div class="modal-dialog">\r\n      <div class="modal-content">\r\n        \x3c!-- Modal Header --\x3e\r\n        <div class="modal-header">\r\n          <h4 class="modal-title">Create Passenger</h4>\r\n          <button type="button" class="close" data-dismiss="modal">\r\n            &times;\r\n          </button>\r\n        </div>\r\n\r\n        \x3c!-- Modal body --\x3e\r\n        <div class="modal-body">\r\n          <validation-observer ref="createPassenger">\r\n            <form @submit.prevent="createPassenger" ref="form">\r\n              <div class="form-row">\r\n                <div class="col-md-12">\r\n                  <validation-provider\r\n                    name="Name"\r\n                    :rules="{ required: true, min: 2, max: 20 }"\r\n                    v-slot="validationContext"\r\n                  >\r\n                    <div class="form-group">\r\n                      <label for="name">Name</label>\r\n                      <input\r\n                        type="text"\r\n                        placeholder="Enter passenger name"\r\n                        aria-describedby="Name-feedback"\r\n                        v-model.trim="passenger.name"\r\n                        :class="`form-control ${getValidationState(\r\n                          validationContext\r\n                        )}`"\r\n                      />\r\n                      <div id="Name-feed back" class="invalid-feedback w-100">\r\n                        {{ validationContext.errors[0] }}\r\n                      </div>\r\n                    </div>\r\n                  </validation-provider>\r\n\r\n                  <validation-provider\r\n                    name="Email"\r\n                    :rules="{ required: true, email: true }"\r\n                    v-slot="validationContext"\r\n                  >\r\n                    <div class="form-group">\r\n                      <label for="icon">Email</label>\r\n\r\n                      <input\r\n                        type="text"\r\n                        placeholder="Enter passenger email"\r\n                        aria-describedby="Email-feedback"\r\n                        v-model.trim="passenger.email"\r\n                        :class="`form-control ${getValidationState(\r\n                          validationContext\r\n                        )}`"\r\n                      />\r\n\r\n                      <div id="Email-feedback" class="invalid-feedback w-100">\r\n                        {{ validationContext.errors[0] }}\r\n                      </div>\r\n                    </div>\r\n                  </validation-provider>\r\n\r\n                  <validation-provider\r\n                    name="Mobile"\r\n                    :rules="{ required: true, regex: /^(0|\\+?254)(\\d){9}$/ }"\r\n                    v-slot="validationContext"\r\n                  >\r\n                    <div class="form-group">\r\n                      <label for="icon">Mobile</label>\r\n\r\n                      <input\r\n                        type="text"\r\n                        placeholder="Enter passenger email"\r\n                        aria-describedby="Mobile-feedback"\r\n                        v-model.trim="passenger.mobile"\r\n                        :class="`form-control ${getValidationState(\r\n                          validationContext\r\n                        )}`"\r\n                      />\r\n\r\n                      <div id="Mobile-feedback" class="invalid-feedback w-100">\r\n                        {{ validationContext.errors[0] }}\r\n                      </div>\r\n                    </div>\r\n                  </validation-provider>\r\n\r\n                  <validation-provider\r\n                    name="Age"\r\n                    :rules="{ required: false, integer: true, min_value: 10 }"\r\n                    v-slot="validationContext"\r\n                  >\r\n                    <div class="form-group">\r\n                      <label for="icon">Age</label>\r\n\r\n                      <input\r\n                        type="text"\r\n                        placeholder="Enter passenger age"\r\n                        aria-describedby="Age-feedback"\r\n                        v-model.trim="passenger.age"\r\n                        :class="`form-control ${getValidationState(\r\n                          validationContext\r\n                        )}`"\r\n                      />\r\n\r\n                      <div id="Age-feedback" class="invalid-feedback w-100">\r\n                        {{ validationContext.errors[0] }}\r\n                      </div>\r\n                    </div>\r\n                  </validation-provider>\r\n\r\n                  <validation-provider\r\n                    name="Age"\r\n                    :rules="{ required: false }"\r\n                    v-slot="validationContext"\r\n                  >\r\n                    <div class="form-group">\r\n                      <label for="icon">Gender</label>\r\n\r\n                      <select\r\n                        aria-describedby="Gender-feedback"\r\n                        v-model.trim="passenger.gender"\r\n                        :class="`form-control ${getValidationState(\r\n                          validationContext\r\n                        )}`"\r\n                      >\r\n                        <option\r\n                          :value="gender.value"\r\n                          v-for="gender in genders"\r\n                          :key="gender.value"\r\n                        >\r\n                          {{ gender.title }}\r\n                        </option>\r\n                      </select>\r\n                      <div id="Gender-feedback" class="invalid-feedback w-100">\r\n                        {{ validationContext.errors[0] }}\r\n                      </div>\r\n                    </div>\r\n                  </validation-provider>\r\n                </div>\r\n              </div>\r\n\r\n              <div class="col-12 my-3 text-right">\r\n                <button class="btn btn-primary" type="submit">Submit</button>\r\n              </div>\r\n            </form>\r\n          </validation-observer>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</template>\r\n\r\n<script>\r\nexport default {\r\n  emits: ["update"],\r\n  data() {\r\n    return {\r\n      passenger: {\r\n        name: "",\r\n        gender: "",\r\n        age: "",\r\n        email: "",\r\n        mobile: "",\r\n      },\r\n      genders: [\r\n        {\r\n          title: "--Select Gender--",\r\n          value: "",\r\n        },\r\n        {\r\n          title: "Male",\r\n          value: "male",\r\n        },\r\n        {\r\n          title: "Female",\r\n          value: "female",\r\n        },\r\n        {\r\n          title: "Prefer not to say",\r\n          value: "pnts",\r\n        },\r\n      ],\r\n    };\r\n  },\r\n  methods: {\r\n    resetForm() {\r\n      this.passenger = {\r\n        name: "",\r\n        gender: "",\r\n        age: "",\r\n        email: "",\r\n        mobile: "",\r\n      };\r\n      this.$nextTick(() => {\r\n        this.$refs.createPassenger.reset();\r\n      });\r\n    },\r\n    createPassenger() {\r\n      this.$refs.createPassenger.validate().then((valid) => {\r\n        if (valid) {\r\n          //submit data\r\n          this.$store.dispatch("startLoading");\r\n          axios\r\n            .post("/admin/passengers", this.passenger)\r\n            .then((res) => {\r\n              //   this.$store.dispatch("stopLoading");\r\n              this.closeModal();\r\n\r\n              this.$nextTick(() => {\r\n                this.$emit("update");\r\n                this.showSuccessToast("Passenger created successfully");\r\n              });\r\n            })\r\n            .catch((res) => {\r\n              this.$store.dispatch("stopLoading");\r\n              this.showErrorToast("There was an error creating the passenger");\r\n            });\r\n        }\r\n      });\r\n    },\r\n    //---- Validation State Form\r\n    getValidationState({ dirty, validated, valid = null }) {\r\n      if (dirty || validated) {\r\n        return valid ? "is-valid" : "is-invalid";\r\n      }\r\n      return "";\r\n    },\r\n    closeModal() {\r\n      $("#create-passenger").modal("hide");\r\n    },\r\n  },\r\n  created() {\r\n    const self = this;\r\n    $(function () {\r\n      $("#create-passenger").on("show.bs.modal", function (e) {\r\n        self.resetForm();\r\n      });\r\n    });\r\n  },\r\n};\r\n<\/script>\r\n<style>\r\n.fade:not(.show) {\r\n  opacity: 1;\r\n}\r\n</style>\r\n'],sourceRoot:""}]);const o=s},23645:e=>{"use strict";e.exports=function(e){var r=[];return r.toString=function(){return this.map((function(r){var n=e(r);return r[2]?"@media ".concat(r[2]," {").concat(n,"}"):n})).join("")},r.i=function(e,n,t){"string"==typeof e&&(e=[[null,e,""]]);var a={};if(t)for(var i=0;i<this.length;i++){var s=this[i][0];null!=s&&(a[s]=!0)}for(var o=0;o<e.length;o++){var l=[].concat(e[o]);t&&a[l[0]]||(n&&(l[2]?l[2]="".concat(n," and ").concat(l[2]):l[2]=n),r.push(l))}},r}},94015:e=>{"use strict";function r(e,r){return function(e){if(Array.isArray(e))return e}(e)||function(e,r){var n=e&&("undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"]);if(null==n)return;var t,a,i=[],s=!0,o=!1;try{for(n=n.call(e);!(s=(t=n.next()).done)&&(i.push(t.value),!r||i.length!==r);s=!0);}catch(e){o=!0,a=e}finally{try{s||null==n.return||n.return()}finally{if(o)throw a}}return i}(e,r)||function(e,r){if(!e)return;if("string"==typeof e)return n(e,r);var t=Object.prototype.toString.call(e).slice(8,-1);"Object"===t&&e.constructor&&(t=e.constructor.name);if("Map"===t||"Set"===t)return Array.from(e);if("Arguments"===t||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t))return n(e,r)}(e,r)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(e,r){(null==r||r>e.length)&&(r=e.length);for(var n=0,t=new Array(r);n<r;n++)t[n]=e[n];return t}e.exports=function(e){var n=r(e,4),t=n[1],a=n[3];if(!a)return t;if("function"==typeof btoa){var i=btoa(unescape(encodeURIComponent(JSON.stringify(a)))),s="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(i),o="/*# ".concat(s," */"),l=a.sources.map((function(e){return"/*# sourceURL=".concat(a.sourceRoot||"").concat(e," */")}));return[t].concat(l).concat([o]).join("\n")}return[t].join("\n")}},93379:(e,r,n)=>{"use strict";var t,a=function(){return void 0===t&&(t=Boolean(window&&document&&document.all&&!window.atob)),t},i=function(){var e={};return function(r){if(void 0===e[r]){var n=document.querySelector(r);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(e){n=null}e[r]=n}return e[r]}}(),s=[];function o(e){for(var r=-1,n=0;n<s.length;n++)if(s[n].identifier===e){r=n;break}return r}function l(e,r){for(var n={},t=[],a=0;a<e.length;a++){var i=e[a],l=r.base?i[0]+r.base:i[0],d=n[l]||0,c="".concat(l," ").concat(d);n[l]=d+1;var u=o(c),v={css:i[1],media:i[2],sourceMap:i[3]};-1!==u?(s[u].references++,s[u].updater(v)):s.push({identifier:c,updater:g(v,r),references:1}),t.push(c)}return t}function d(e){var r=document.createElement("style"),t=e.attributes||{};if(void 0===t.nonce){var a=n.nc;a&&(t.nonce=a)}if(Object.keys(t).forEach((function(e){r.setAttribute(e,t[e])})),"function"==typeof e.insert)e.insert(r);else{var s=i(e.insert||"head");if(!s)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");s.appendChild(r)}return r}var c,u=(c=[],function(e,r){return c[e]=r,c.filter(Boolean).join("\n")});function v(e,r,n,t){var a=n?"":t.media?"@media ".concat(t.media," {").concat(t.css,"}"):t.css;if(e.styleSheet)e.styleSheet.cssText=u(r,a);else{var i=document.createTextNode(a),s=e.childNodes;s[r]&&e.removeChild(s[r]),s.length?e.insertBefore(i,s[r]):e.appendChild(i)}}function m(e,r,n){var t=n.css,a=n.media,i=n.sourceMap;if(a?e.setAttribute("media",a):e.removeAttribute("media"),i&&"undefined"!=typeof btoa&&(t+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(i))))," */")),e.styleSheet)e.styleSheet.cssText=t;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(t))}}var f=null,p=0;function g(e,r){var n,t,a;if(r.singleton){var i=p++;n=f||(f=d(r)),t=v.bind(null,n,i,!1),a=v.bind(null,n,i,!0)}else n=d(r),t=m.bind(null,n,r),a=function(){!function(e){if(null===e.parentNode)return!1;e.parentNode.removeChild(e)}(n)};return t(e),function(r){if(r){if(r.css===e.css&&r.media===e.media&&r.sourceMap===e.sourceMap)return;t(e=r)}else a()}}e.exports=function(e,r){(r=r||{}).singleton||"boolean"==typeof r.singleton||(r.singleton=a());var n=l(e=e||[],r);return function(e){if(e=e||[],"[object Array]"===Object.prototype.toString.call(e)){for(var t=0;t<n.length;t++){var a=o(n[t]);s[a].references--}for(var i=l(e,r),d=0;d<n.length;d++){var c=o(n[d]);0===s[c].references&&(s[c].updater(),s.splice(c,1))}n=i}}}},25920:(e,r,n)=>{"use strict";n.r(r),n.d(r,{default:()=>l});const t={emits:["update"],data:function(){return{passenger:{name:"",gender:"",age:"",email:"",mobile:""},genders:[{title:"--Select Gender--",value:""},{title:"Male",value:"male"},{title:"Female",value:"female"},{title:"Prefer not to say",value:"pnts"}]}},methods:{resetForm:function(){var e=this;this.passenger={name:"",gender:"",age:"",email:"",mobile:""},this.$nextTick((function(){e.$refs.createPassenger.reset()}))},createPassenger:function(){var e=this;this.$refs.createPassenger.validate().then((function(r){r&&(e.$store.dispatch("startLoading"),axios.post("/admin/passengers",e.passenger).then((function(r){e.closeModal(),e.$nextTick((function(){e.$emit("update"),e.showSuccessToast("Passenger created successfully")}))})).catch((function(r){e.$store.dispatch("stopLoading"),e.showErrorToast("There was an error creating the passenger")})))}))},getValidationState:function(e){var r=e.dirty,n=e.validated,t=e.valid;return r||n?(void 0===t?null:t)?"is-valid":"is-invalid":""},closeModal:function(){$("#create-passenger").modal("hide")}},created:function(){var e=this;$((function(){$("#create-passenger").on("show.bs.modal",(function(r){e.resetForm()}))}))}};var a=n(93379),i=n.n(a),s=n(6257),o={insert:"head",singleton:!1};i()(s.Z,o);s.Z.locals;const l=(0,n(51900).Z)(t,(function(){var e=this,r=e.$createElement,n=e._self._c||r;return n("div",{staticClass:"modal",attrs:{id:"create-passenger"}},[n("div",{staticClass:"modal-dialog"},[n("div",{staticClass:"modal-content"},[e._m(0),e._v(" "),n("div",{staticClass:"modal-body"},[n("validation-observer",{ref:"createPassenger"},[n("form",{ref:"form",on:{submit:function(r){return r.preventDefault(),e.createPassenger.apply(null,arguments)}}},[n("div",{staticClass:"form-row"},[n("div",{staticClass:"col-md-12"},[n("validation-provider",{attrs:{name:"Name",rules:{required:!0,min:2,max:20}},scopedSlots:e._u([{key:"default",fn:function(r){return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"name"}},[e._v("Name")]),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.passenger.name,expression:"passenger.name",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(r),attrs:{type:"text",placeholder:"Enter passenger name","aria-describedby":"Name-feedback"},domProps:{value:e.passenger.name},on:{input:function(r){r.target.composing||e.$set(e.passenger,"name",r.target.value.trim())},blur:function(r){return e.$forceUpdate()}}}),e._v(" "),n("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Name-feed back"}},[e._v("\n                      "+e._s(r.errors[0])+"\n                    ")])])]}}])}),e._v(" "),n("validation-provider",{attrs:{name:"Email",rules:{required:!0,email:!0}},scopedSlots:e._u([{key:"default",fn:function(r){return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"icon"}},[e._v("Email")]),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.passenger.email,expression:"passenger.email",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(r),attrs:{type:"text",placeholder:"Enter passenger email","aria-describedby":"Email-feedback"},domProps:{value:e.passenger.email},on:{input:function(r){r.target.composing||e.$set(e.passenger,"email",r.target.value.trim())},blur:function(r){return e.$forceUpdate()}}}),e._v(" "),n("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Email-feedback"}},[e._v("\n                      "+e._s(r.errors[0])+"\n                    ")])])]}}])}),e._v(" "),n("validation-provider",{attrs:{name:"Mobile",rules:{required:!0,regex:/^(0|\+?254)(\d){9}$/}},scopedSlots:e._u([{key:"default",fn:function(r){return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"icon"}},[e._v("Mobile")]),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.passenger.mobile,expression:"passenger.mobile",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(r),attrs:{type:"text",placeholder:"Enter passenger email","aria-describedby":"Mobile-feedback"},domProps:{value:e.passenger.mobile},on:{input:function(r){r.target.composing||e.$set(e.passenger,"mobile",r.target.value.trim())},blur:function(r){return e.$forceUpdate()}}}),e._v(" "),n("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Mobile-feedback"}},[e._v("\n                      "+e._s(r.errors[0])+"\n                    ")])])]}}])}),e._v(" "),n("validation-provider",{attrs:{name:"Age",rules:{required:!1,integer:!0,min_value:10}},scopedSlots:e._u([{key:"default",fn:function(r){return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"icon"}},[e._v("Age")]),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.passenger.age,expression:"passenger.age",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(r),attrs:{type:"text",placeholder:"Enter passenger age","aria-describedby":"Age-feedback"},domProps:{value:e.passenger.age},on:{input:function(r){r.target.composing||e.$set(e.passenger,"age",r.target.value.trim())},blur:function(r){return e.$forceUpdate()}}}),e._v(" "),n("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Age-feedback"}},[e._v("\n                      "+e._s(r.errors[0])+"\n                    ")])])]}}])}),e._v(" "),n("validation-provider",{attrs:{name:"Age",rules:{required:!1}},scopedSlots:e._u([{key:"default",fn:function(r){return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"icon"}},[e._v("Gender")]),e._v(" "),n("select",{directives:[{name:"model",rawName:"v-model.trim",value:e.passenger.gender,expression:"passenger.gender",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(r),attrs:{"aria-describedby":"Gender-feedback"},on:{change:function(r){var n=Array.prototype.filter.call(r.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.$set(e.passenger,"gender",r.target.multiple?n:n[0])}}},e._l(e.genders,(function(r){return n("option",{key:r.value,domProps:{value:r.value}},[e._v("\n                        "+e._s(r.title)+"\n                      ")])})),0),e._v(" "),n("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Gender-feedback"}},[e._v("\n                      "+e._s(r.errors[0])+"\n                    ")])])]}}])})],1)]),e._v(" "),n("div",{staticClass:"col-12 my-3 text-right"},[n("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[e._v("Submit")])])])])],1)])])])}),[function(){var e=this,r=e.$createElement,n=e._self._c||r;return n("div",{staticClass:"modal-header"},[n("h4",{staticClass:"modal-title"},[e._v("Create Passenger")]),e._v(" "),n("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal"}},[e._v("\n          ×\n        ")])])}],!1,null,null,null).exports}}]);
//# sourceMappingURL=5920.js.map