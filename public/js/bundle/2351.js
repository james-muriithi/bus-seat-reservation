(self.webpackChunk=self.webpackChunk||[]).push([[2351],{6415:(t,e,n)=>{"use strict";n.d(e,{Z:()=>i});var o=n(94015),a=n.n(o),r=n(23645),s=n.n(r)()(a());s.push([t.id,".fade:not(.show){opacity:1}","",{version:3,sources:["webpack://./resources/js/components/payment-methods/DeletePaymentMethod.vue"],names:[],mappings:"AA2EA,iBACA,SACA",sourcesContent:['<template>\n  <div class="modal" id="delete-payment-method">\n    <div class="modal-dialog">\n      <div class="modal-content">\n        \x3c!-- Modal Header --\x3e\n        <div class="modal-header">\n          <h4 class="modal-title">Delete Payment Method</h4>\n          <button type="button" class="close" data-dismiss="modal">\n            &times;\n          </button>\n        </div>\n\n        \x3c!-- Modal body --\x3e\n        <div class="modal-body">\n          <div class="mb-2">\n            <p>\n              Are you sure you want to delete <b>{{ paymentMethod.name }}</b>?\n            </p>\n          </div>\n\n          <div class="col-12 mt-3 text-right">\n            <button class="btn btn-primary" data-dismiss="modal">Cancel</button>\n            <button class="btn btn-danger" @click="deletePaymentMethod">\n              Delete\n            </button>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</template>\n\n<script>\nexport default {\n  emits: ["update"],\n  props: {\n    paymentMethod: {\n      type: Object,\n      required: true,\n    },\n  },\n  data() {\n    return {};\n  },\n  methods: {\n    deletePaymentMethod() {\n      this.$store.dispatch("startLoading");\n      axios\n        .post(`/admin/payment-methods/${this.paymentMethod.id}`, {\n          _method: "DELETE",\n        })\n        .then((res) => {\n          this.closeModal();\n\n          this.$nextTick(() => {\n            this.$emit("update");\n            this.showSuccessToast(\'Payment method deleted successfully\')\n          });\n        })\n        .catch((res) => {\n          this.closeModal();\n          this.$store.dispatch("stopLoading");\n          this.showErrorToast(\'There was a problem deleting the payment method\')\n        });\n    },\n    closeModal() {\n      $("#delete-payment-method").modal("hide");\n    },\n  },\n  created() {\n    const self = this;\n  },\n};\n<\/script>\n<style>\n.fade:not(.show) {\n  opacity: 1;\n}\n</style>\n'],sourceRoot:""}]);const i=s},23645:t=>{"use strict";t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n=t(e);return e[2]?"@media ".concat(e[2]," {").concat(n,"}"):n})).join("")},e.i=function(t,n,o){"string"==typeof t&&(t=[[null,t,""]]);var a={};if(o)for(var r=0;r<this.length;r++){var s=this[r][0];null!=s&&(a[s]=!0)}for(var i=0;i<t.length;i++){var c=[].concat(t[i]);o&&a[c[0]]||(n&&(c[2]?c[2]="".concat(n," and ").concat(c[2]):c[2]=n),e.push(c))}},e}},94015:t=>{"use strict";function e(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=t&&("undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"]);if(null==n)return;var o,a,r=[],s=!0,i=!1;try{for(n=n.call(t);!(s=(o=n.next()).done)&&(r.push(o.value),!e||r.length!==e);s=!0);}catch(t){i=!0,a=t}finally{try{s||null==n.return||n.return()}finally{if(i)throw a}}return r}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return n(t,e);var o=Object.prototype.toString.call(t).slice(8,-1);"Object"===o&&t.constructor&&(o=t.constructor.name);if("Map"===o||"Set"===o)return Array.from(t);if("Arguments"===o||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(o))return n(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,o=new Array(e);n<e;n++)o[n]=t[n];return o}t.exports=function(t){var n=e(t,4),o=n[1],a=n[3];if(!a)return o;if("function"==typeof btoa){var r=btoa(unescape(encodeURIComponent(JSON.stringify(a)))),s="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(r),i="/*# ".concat(s," */"),c=a.sources.map((function(t){return"/*# sourceURL=".concat(a.sourceRoot||"").concat(t," */")}));return[o].concat(c).concat([i]).join("\n")}return[o].join("\n")}},93379:(t,e,n)=>{"use strict";var o,a=function(){return void 0===o&&(o=Boolean(window&&document&&document.all&&!window.atob)),o},r=function(){var t={};return function(e){if(void 0===t[e]){var n=document.querySelector(e);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(t){n=null}t[e]=n}return t[e]}}(),s=[];function i(t){for(var e=-1,n=0;n<s.length;n++)if(s[n].identifier===t){e=n;break}return e}function c(t,e){for(var n={},o=[],a=0;a<t.length;a++){var r=t[a],c=e.base?r[0]+e.base:r[0],d=n[c]||0,l="".concat(c," ").concat(d);n[c]=d+1;var u=i(l),m={css:r[1],media:r[2],sourceMap:r[3]};-1!==u?(s[u].references++,s[u].updater(m)):s.push({identifier:l,updater:v(m,e),references:1}),o.push(l)}return o}function d(t){var e=document.createElement("style"),o=t.attributes||{};if(void 0===o.nonce){var a=n.nc;a&&(o.nonce=a)}if(Object.keys(o).forEach((function(t){e.setAttribute(t,o[t])})),"function"==typeof t.insert)t.insert(e);else{var s=r(t.insert||"head");if(!s)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");s.appendChild(e)}return e}var l,u=(l=[],function(t,e){return l[t]=e,l.filter(Boolean).join("\n")});function m(t,e,n,o){var a=n?"":o.media?"@media ".concat(o.media," {").concat(o.css,"}"):o.css;if(t.styleSheet)t.styleSheet.cssText=u(e,a);else{var r=document.createTextNode(a),s=t.childNodes;s[e]&&t.removeChild(s[e]),s.length?t.insertBefore(r,s[e]):t.appendChild(r)}}function h(t,e,n){var o=n.css,a=n.media,r=n.sourceMap;if(a?t.setAttribute("media",a):t.removeAttribute("media"),r&&"undefined"!=typeof btoa&&(o+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(r))))," */")),t.styleSheet)t.styleSheet.cssText=o;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(o))}}var p=null,f=0;function v(t,e){var n,o,a;if(e.singleton){var r=f++;n=p||(p=d(e)),o=m.bind(null,n,r,!1),a=m.bind(null,n,r,!0)}else n=d(e),o=h.bind(null,n,e),a=function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(n)};return o(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;o(t=e)}else a()}}t.exports=function(t,e){(e=e||{}).singleton||"boolean"==typeof e.singleton||(e.singleton=a());var n=c(t=t||[],e);return function(t){if(t=t||[],"[object Array]"===Object.prototype.toString.call(t)){for(var o=0;o<n.length;o++){var a=i(n[o]);s[a].references--}for(var r=c(t,e),d=0;d<n.length;d++){var l=i(n[d]);0===s[l].references&&(s[l].updater(),s.splice(l,1))}n=r}}}},72351:(t,e,n)=>{"use strict";n.r(e),n.d(e,{default:()=>c});const o={emits:["update"],props:{paymentMethod:{type:Object,required:!0}},data:function(){return{}},methods:{deletePaymentMethod:function(){var t=this;this.$store.dispatch("startLoading"),axios.post("/admin/payment-methods/".concat(this.paymentMethod.id),{_method:"DELETE"}).then((function(e){t.closeModal(),t.$nextTick((function(){t.$emit("update"),t.showSuccessToast("Payment method deleted successfully")}))})).catch((function(e){t.closeModal(),t.$store.dispatch("stopLoading"),t.showErrorToast("There was a problem deleting the payment method")}))},closeModal:function(){$("#delete-payment-method").modal("hide")}},created:function(){}};var a=n(93379),r=n.n(a),s=n(6415),i={insert:"head",singleton:!1};r()(s.Z,i);s.Z.locals;const c=(0,n(51900).Z)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"modal",attrs:{id:"delete-payment-method"}},[n("div",{staticClass:"modal-dialog"},[n("div",{staticClass:"modal-content"},[t._m(0),t._v(" "),n("div",{staticClass:"modal-body"},[n("div",{staticClass:"mb-2"},[n("p",[t._v("\n            Are you sure you want to delete "),n("b",[t._v(t._s(t.paymentMethod.name))]),t._v("?\n          ")])]),t._v(" "),n("div",{staticClass:"col-12 mt-3 text-right"},[n("button",{staticClass:"btn btn-primary",attrs:{"data-dismiss":"modal"}},[t._v("Cancel")]),t._v(" "),n("button",{staticClass:"btn btn-danger",on:{click:t.deletePaymentMethod}},[t._v("\n            Delete\n          ")])])])])])])}),[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"modal-header"},[n("h4",{staticClass:"modal-title"},[t._v("Delete Payment Method")]),t._v(" "),n("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal"}},[t._v("\n          ×\n        ")])])}],!1,null,null,null).exports}}]);
//# sourceMappingURL=2351.js.map