(self.webpackChunk=self.webpackChunk||[]).push([[882],{2503:(t,e,n)=>{"use strict";n.d(e,{Z:()=>s});var a=n(4015),r=n.n(a),o=n(3645),i=n.n(o)()(r());i.push([t.id,".fade:not(.show){opacity:1}","",{version:3,sources:["webpack://./resources/js/components/payment-methods/EditPaymentMethod.vue"],names:[],mappings:"AAwGA,iBACA,SACA",sourcesContent:['<template>\n  <div class="modal" id="edit-payment-method">\n    <div class="modal-dialog">\n      <div class="modal-content">\n        \x3c!-- Modal Header --\x3e\n        <div class="modal-header">\n          <h4 class="modal-title">Create Payment Method</h4>\n          <button type="button" class="close" data-dismiss="modal">\n            &times;\n          </button>\n        </div>\n\n        \x3c!-- Modal body --\x3e\n        <div class="modal-body">\n          <validation-observer ref="editPaymentMethod">\n            <form @submit.prevent="editPaymentMethod" ref="form">\n              <div class="form-row">\n                <div class="col-md-12">\n                  <validation-provider\n                    name="Method Name"\n                    :rules="{ required: true, min: 2, max: 20 }"\n                    v-slot="validationContext"\n                  >\n                    <div class="form-group">\n                      <label for="name">Method Name</label>\n                      <input\n                        type="text"\n                        placeholder="Enter payment method name"\n                        aria-describedby="Name-feedback"\n                        v-model.trim="paymentMethod.name"\n                        :class="`form-control ${getValidationState(\n                          validationContext\n                        )}`"\n                      />\n                      <div id="Name-feed back" class="invalid-feedback w-100">\n                        {{ validationContext.errors[0] }}\n                      </div>\n                    </div>\n                  </validation-provider>\n                </div>\n              </div>\n\n              <div class="col-12 my-3 text-right">\n                <button class="btn btn-primary" type="submit">Submit</button>\n              </div>\n            </form>\n          </validation-observer>\n        </div>\n      </div>\n    </div>\n  </div>\n</template>\n\n<script>\nexport default {\n  emits: ["update"],\n  props: {\n    paymentMethod: {\n      type: Object,\n      required: true,\n    },\n  },\n  data() {\n    return {};\n  },\n  methods: {\n    editPaymentMethod() {\n      this.$refs.editPaymentMethod.validate().then((valid) => {\n        if (valid) {\n          //submit data\n          this.$store.dispatch("startLoading");\n          axios\n            .post(`/admin/payment-methods/${this.paymentMethod.id}`, {\n              ...this.paymentMethod,\n              _method: "PUT",\n            })\n            .then((res) => {\n              //   this.$store.dispatch("stopLoading");\n              this.closeModal();\n\n              this.$nextTick(() => {\n                this.$emit("update");\n              });\n            })\n            .catch((res) => {\n              this.$store.dispatch("stopLoading");\n            });\n        }\n      });\n    },\n    //---- Validation State Form\n    getValidationState({ dirty, validated, valid = null }) {\n      if (dirty || validated) {\n        return valid ? "is-valid" : "is-invalid";\n      }\n      return "";\n    },\n    closeModal() {\n      $("#edit-payment-method").modal("hide");\n    },\n  },\n};\n<\/script>\n<style>\n.fade:not(.show) {\n  opacity: 1;\n}\n</style>\n'],sourceRoot:""}]);const s=i},3645:t=>{"use strict";t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n=t(e);return e[2]?"@media ".concat(e[2]," {").concat(n,"}"):n})).join("")},e.i=function(t,n,a){"string"==typeof t&&(t=[[null,t,""]]);var r={};if(a)for(var o=0;o<this.length;o++){var i=this[o][0];null!=i&&(r[i]=!0)}for(var s=0;s<t.length;s++){var d=[].concat(t[s]);a&&r[d[0]]||(n&&(d[2]?d[2]="".concat(n," and ").concat(d[2]):d[2]=n),e.push(d))}},e}},4015:t=>{"use strict";function e(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=t&&("undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"]);if(null==n)return;var a,r,o=[],i=!0,s=!1;try{for(n=n.call(t);!(i=(a=n.next()).done)&&(o.push(a.value),!e||o.length!==e);i=!0);}catch(t){s=!0,r=t}finally{try{i||null==n.return||n.return()}finally{if(s)throw r}}return o}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return n(t,e);var a=Object.prototype.toString.call(t).slice(8,-1);"Object"===a&&t.constructor&&(a=t.constructor.name);if("Map"===a||"Set"===a)return Array.from(t);if("Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a))return n(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,a=new Array(e);n<e;n++)a[n]=t[n];return a}t.exports=function(t){var n=e(t,4),a=n[1],r=n[3];if(!r)return a;if("function"==typeof btoa){var o=btoa(unescape(encodeURIComponent(JSON.stringify(r)))),i="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(o),s="/*# ".concat(i," */"),d=r.sources.map((function(t){return"/*# sourceURL=".concat(r.sourceRoot||"").concat(t," */")}));return[a].concat(d).concat([s]).join("\n")}return[a].join("\n")}},3379:(t,e,n)=>{"use strict";var a,r=function(){return void 0===a&&(a=Boolean(window&&document&&document.all&&!window.atob)),a},o=function(){var t={};return function(e){if(void 0===t[e]){var n=document.querySelector(e);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(t){n=null}t[e]=n}return t[e]}}(),i=[];function s(t){for(var e=-1,n=0;n<i.length;n++)if(i[n].identifier===t){e=n;break}return e}function d(t,e){for(var n={},a=[],r=0;r<t.length;r++){var o=t[r],d=e.base?o[0]+e.base:o[0],c=n[d]||0,l="".concat(d," ").concat(c);n[d]=c+1;var u=s(l),m={css:o[1],media:o[2],sourceMap:o[3]};-1!==u?(i[u].references++,i[u].updater(m)):i.push({identifier:l,updater:h(m,e),references:1}),a.push(l)}return a}function c(t){var e=document.createElement("style"),a=t.attributes||{};if(void 0===a.nonce){var r=n.nc;r&&(a.nonce=r)}if(Object.keys(a).forEach((function(t){e.setAttribute(t,a[t])})),"function"==typeof t.insert)t.insert(e);else{var i=o(t.insert||"head");if(!i)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");i.appendChild(e)}return e}var l,u=(l=[],function(t,e){return l[t]=e,l.filter(Boolean).join("\n")});function m(t,e,n,a){var r=n?"":a.media?"@media ".concat(a.media," {").concat(a.css,"}"):a.css;if(t.styleSheet)t.styleSheet.cssText=u(e,r);else{var o=document.createTextNode(r),i=t.childNodes;i[e]&&t.removeChild(i[e]),i.length?t.insertBefore(o,i[e]):t.appendChild(o)}}function f(t,e,n){var a=n.css,r=n.media,o=n.sourceMap;if(r?t.setAttribute("media",r):t.removeAttribute("media"),o&&"undefined"!=typeof btoa&&(a+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(o))))," */")),t.styleSheet)t.styleSheet.cssText=a;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(a))}}var p=null,v=0;function h(t,e){var n,a,r;if(e.singleton){var o=v++;n=p||(p=c(e)),a=m.bind(null,n,o,!1),r=m.bind(null,n,o,!0)}else n=c(e),a=f.bind(null,n,e),r=function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(n)};return a(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;a(t=e)}else r()}}t.exports=function(t,e){(e=e||{}).singleton||"boolean"==typeof e.singleton||(e.singleton=r());var n=d(t=t||[],e);return function(t){if(t=t||[],"[object Array]"===Object.prototype.toString.call(t)){for(var a=0;a<n.length;a++){var r=s(n[a]);i[r].references--}for(var o=d(t,e),c=0;c<n.length;c++){var l=s(n[c]);0===i[l].references&&(i[l].updater(),i.splice(l,1))}n=o}}}},2882:(t,e,n)=>{"use strict";n.r(e),n.d(e,{default:()=>u});function a(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function r(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?a(Object(n),!0).forEach((function(e){o(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):a(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function o(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}const i={emits:["update"],props:{paymentMethod:{type:Object,required:!0}},data:function(){return{}},methods:{editPaymentMethod:function(){var t=this;this.$refs.editPaymentMethod.validate().then((function(e){e&&(t.$store.dispatch("startLoading"),axios.post("/admin/payment-methods/".concat(t.paymentMethod.id),r(r({},t.paymentMethod),{},{_method:"PUT"})).then((function(e){t.closeModal(),t.$nextTick((function(){t.$emit("update")}))})).catch((function(e){t.$store.dispatch("stopLoading")})))}))},getValidationState:function(t){var e=t.dirty,n=t.validated,a=t.valid;return e||n?(void 0===a?null:a)?"is-valid":"is-invalid":""},closeModal:function(){$("#edit-payment-method").modal("hide")}}};var s=n(3379),d=n.n(s),c=n(2503),l={insert:"head",singleton:!1};d()(c.Z,l);c.Z.locals;const u=(0,n(1900).Z)(i,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"modal",attrs:{id:"edit-payment-method"}},[n("div",{staticClass:"modal-dialog"},[n("div",{staticClass:"modal-content"},[t._m(0),t._v(" "),n("div",{staticClass:"modal-body"},[n("validation-observer",{ref:"editPaymentMethod"},[n("form",{ref:"form",on:{submit:function(e){return e.preventDefault(),t.editPaymentMethod.apply(null,arguments)}}},[n("div",{staticClass:"form-row"},[n("div",{staticClass:"col-md-12"},[n("validation-provider",{attrs:{name:"Method Name",rules:{required:!0,min:2,max:20}},scopedSlots:t._u([{key:"default",fn:function(e){return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"name"}},[t._v("Method Name")]),t._v(" "),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:t.paymentMethod.name,expression:"paymentMethod.name",modifiers:{trim:!0}}],class:"form-control "+t.getValidationState(e),attrs:{type:"text",placeholder:"Enter payment method name","aria-describedby":"Name-feedback"},domProps:{value:t.paymentMethod.name},on:{input:function(e){e.target.composing||t.$set(t.paymentMethod,"name",e.target.value.trim())},blur:function(e){return t.$forceUpdate()}}}),t._v(" "),n("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Name-feed back"}},[t._v("\n                      "+t._s(e.errors[0])+"\n                    ")])])]}}])})],1)]),t._v(" "),n("div",{staticClass:"col-12 my-3 text-right"},[n("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Submit")])])])])],1)])])])}),[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"modal-header"},[n("h4",{staticClass:"modal-title"},[t._v("Create Payment Method")]),t._v(" "),n("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal"}},[t._v("\n          ×\n        ")])])}],!1,null,null,null).exports}}]);
//# sourceMappingURL=882.js.map