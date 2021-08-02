(self.webpackChunk=self.webpackChunk||[]).push([[3767],{5918:(e,t,n)=>{"use strict";n.d(t,{Z:()=>c});var r=n(4015),a=n.n(r),i=n(3645),o=n.n(i)()(a());o.push([e.id,".fade:not(.show){opacity:1}","",{version:3,sources:["webpack://./resources/js/components/currencies/EditCurrency.vue"],names:[],mappings:"AAmKA,iBACA,SACA",sourcesContent:['<template>\n  <div class="modal" id="edit-currency">\n    <div class="modal-dialog">\n      <div class="modal-content">\n        \x3c!-- Modal Header --\x3e\n        <div class="modal-header">\n          <h4 class="modal-title">Edit Currency</h4>\n          <button type="button" class="close" data-dismiss="modal">\n            &times;\n          </button>\n        </div>\n\n        \x3c!-- Modal body --\x3e\n        <div class="modal-body">\n          <validation-observer ref="editCurrency">\n            <form @submit.prevent="editCurrency" ref="form">\n              <div class="form-row">\n                <div class="col-md-12">\n                  <validation-provider\n                    name="Currency Name"\n                    :rules="{ required: true, min: 2, max: 20 }"\n                    v-slot="validationContext"\n                  >\n                    <div class="form-group">\n                      <label for="name">Currency Name</label>\n                      <input\n                        type="text"\n                        placeholder="Enter currency name e.g US Dollar"\n                        aria-describedby="Name-feedback"\n                        v-model.trim="currency.currency_name"\n                        :class="`form-control ${getValidationState(\n                          validationContext\n                        )}`"\n                      />\n                      <div id="Name-feed back" class="invalid-feedback w-100">\n                        {{ validationContext.errors[0] }}\n                      </div>\n                    </div>\n                  </validation-provider>\n                  \x3c!-- currency code --\x3e\n                  <validation-provider\n                    name="Currency Code"\n                    :rules="{ required: true }"\n                    v-slot="validationContext"\n                  >\n                    <div class="form-group">\n                      <label for="name">Currency Code</label>\n                      <input\n                        type="text"\n                        placeholder="Enter currency Code e.g USD"\n                        aria-describedby="Code-feedback"\n                        v-model.trim="currency.currency_code"\n                        :class="`form-control ${getValidationState(\n                          validationContext\n                        )}`"\n                      />\n                      <div id="Code-feed back" class="invalid-feedback w-100">\n                        {{ validationContext.errors[0] }}\n                      </div>\n                    </div>\n                  </validation-provider>\n\n                  \x3c!-- currency symbol --\x3e\n                  <validation-provider\n                    name="Currency Symbol"\n                    :rules="{ required: true }"\n                    v-slot="validationContext"\n                  >\n                    <div class="form-group">\n                      <label for="name">Currency Symbol</label>\n                      <input\n                        type="text"\n                        placeholder="Enter currency name e.g $"\n                        aria-describedby="Symbol-feedback"\n                        v-model.trim="currency.currency_symbol"\n                        :class="`form-control ${getValidationState(\n                          validationContext\n                        )}`"\n                      />\n                      <div id="Symbol-feed back" class="invalid-feedback w-100">\n                        {{ validationContext.errors[0] }}\n                      </div>\n                    </div>\n                  </validation-provider>\n\n                  <div class="form-group">\n                    <div class="form-check">\n                      <label class="form-check-label">\n                        <input\n                          class="form-check-input"\n                          type="checkbox"\n                          id="status"\n                          v-model="currency.status"\n                        />\n                        Status\n                      </label>\n                    </div>\n                  </div>\n                </div>\n              </div>\n\n              <div class="col-12 my-3 text-right">\n                <button class="btn btn-primary" type="submit">Submit</button>\n              </div>\n            </form>\n          </validation-observer>\n        </div>\n      </div>\n    </div>\n  </div>\n</template>\n\n<script>\nexport default {\n  emits: ["update"],\n  props: {\n    currency: {\n      type: Object,\n      required: true,\n    },\n  },\n  data() {\n    return {};\n  },\n  methods: {\n    editCurrency() {\n      this.$refs.editCurrency.validate().then((valid) => {\n        if (valid) {\n          //submit data\n          this.$store.dispatch("startLoading");\n          axios\n            .post(`/admin/currencies/${this.currency.id}`, {\n              ...this.currency,\n              _method: "PUT",\n            })\n            .then((res) => {\n              //   this.$store.dispatch("stopLoading");\n              this.closeModal();\n\n              this.$nextTick(() => {\n                this.$emit("update");\n              });\n            })\n            .catch((res) => {\n              this.$store.dispatch("stopLoading");\n            });\n        }\n      });\n    },\n    //---- Validation State Form\n    getValidationState({ dirty, validated, valid = null }) {\n      if (dirty || validated) {\n        return valid ? "is-valid" : "is-invalid";\n      }\n      return "";\n    },\n    closeModal() {\n      $("#edit-currency").modal("hide");\n    },\n  },\n};\n<\/script>\n<style>\n.fade:not(.show) {\n  opacity: 1;\n}\n</style>\n'],sourceRoot:""}]);const c=o},3645:e=>{"use strict";e.exports=function(e){var t=[];return t.toString=function(){return this.map((function(t){var n=e(t);return t[2]?"@media ".concat(t[2]," {").concat(n,"}"):n})).join("")},t.i=function(e,n,r){"string"==typeof e&&(e=[[null,e,""]]);var a={};if(r)for(var i=0;i<this.length;i++){var o=this[i][0];null!=o&&(a[o]=!0)}for(var c=0;c<e.length;c++){var s=[].concat(e[c]);r&&a[s[0]]||(n&&(s[2]?s[2]="".concat(n," and ").concat(s[2]):s[2]=n),t.push(s))}},t}},4015:e=>{"use strict";function t(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var n=e&&("undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"]);if(null==n)return;var r,a,i=[],o=!0,c=!1;try{for(n=n.call(e);!(o=(r=n.next()).done)&&(i.push(r.value),!t||i.length!==t);o=!0);}catch(e){c=!0,a=e}finally{try{o||null==n.return||n.return()}finally{if(c)throw a}}return i}(e,t)||function(e,t){if(!e)return;if("string"==typeof e)return n(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);"Object"===r&&e.constructor&&(r=e.constructor.name);if("Map"===r||"Set"===r)return Array.from(e);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return n(e,t)}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}e.exports=function(e){var n=t(e,4),r=n[1],a=n[3];if(!a)return r;if("function"==typeof btoa){var i=btoa(unescape(encodeURIComponent(JSON.stringify(a)))),o="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(i),c="/*# ".concat(o," */"),s=a.sources.map((function(e){return"/*# sourceURL=".concat(a.sourceRoot||"").concat(e," */")}));return[r].concat(s).concat([c]).join("\n")}return[r].join("\n")}},3379:(e,t,n)=>{"use strict";var r,a=function(){return void 0===r&&(r=Boolean(window&&document&&document.all&&!window.atob)),r},i=function(){var e={};return function(t){if(void 0===e[t]){var n=document.querySelector(t);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(e){n=null}e[t]=n}return e[t]}}(),o=[];function c(e){for(var t=-1,n=0;n<o.length;n++)if(o[n].identifier===e){t=n;break}return t}function s(e,t){for(var n={},r=[],a=0;a<e.length;a++){var i=e[a],s=t.base?i[0]+t.base:i[0],l=n[s]||0,d="".concat(s," ").concat(l);n[s]=l+1;var u=c(d),m={css:i[1],media:i[2],sourceMap:i[3]};-1!==u?(o[u].references++,o[u].updater(m)):o.push({identifier:d,updater:p(m,t),references:1}),r.push(d)}return r}function l(e){var t=document.createElement("style"),r=e.attributes||{};if(void 0===r.nonce){var a=n.nc;a&&(r.nonce=a)}if(Object.keys(r).forEach((function(e){t.setAttribute(e,r[e])})),"function"==typeof e.insert)e.insert(t);else{var o=i(e.insert||"head");if(!o)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");o.appendChild(t)}return t}var d,u=(d=[],function(e,t){return d[e]=t,d.filter(Boolean).join("\n")});function m(e,t,n,r){var a=n?"":r.media?"@media ".concat(r.media," {").concat(r.css,"}"):r.css;if(e.styleSheet)e.styleSheet.cssText=u(t,a);else{var i=document.createTextNode(a),o=e.childNodes;o[t]&&e.removeChild(o[t]),o.length?e.insertBefore(i,o[t]):e.appendChild(i)}}function v(e,t,n){var r=n.css,a=n.media,i=n.sourceMap;if(a?e.setAttribute("media",a):e.removeAttribute("media"),i&&"undefined"!=typeof btoa&&(r+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(i))))," */")),e.styleSheet)e.styleSheet.cssText=r;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(r))}}var f=null,y=0;function p(e,t){var n,r,a;if(t.singleton){var i=y++;n=f||(f=l(t)),r=m.bind(null,n,i,!1),a=m.bind(null,n,i,!0)}else n=l(t),r=v.bind(null,n,t),a=function(){!function(e){if(null===e.parentNode)return!1;e.parentNode.removeChild(e)}(n)};return r(e),function(t){if(t){if(t.css===e.css&&t.media===e.media&&t.sourceMap===e.sourceMap)return;r(e=t)}else a()}}e.exports=function(e,t){(t=t||{}).singleton||"boolean"==typeof t.singleton||(t.singleton=a());var n=s(e=e||[],t);return function(e){if(e=e||[],"[object Array]"===Object.prototype.toString.call(e)){for(var r=0;r<n.length;r++){var a=c(n[r]);o[a].references--}for(var i=s(e,t),l=0;l<n.length;l++){var d=c(n[l]);0===o[d].references&&(o[d].updater(),o.splice(d,1))}n=i}}}},3767:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>u});function r(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function a(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?r(Object(n),!0).forEach((function(t){i(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function i(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}const o={emits:["update"],props:{currency:{type:Object,required:!0}},data:function(){return{}},methods:{editCurrency:function(){var e=this;this.$refs.editCurrency.validate().then((function(t){t&&(e.$store.dispatch("startLoading"),axios.post("/admin/currencies/".concat(e.currency.id),a(a({},e.currency),{},{_method:"PUT"})).then((function(t){e.closeModal(),e.$nextTick((function(){e.$emit("update")}))})).catch((function(t){e.$store.dispatch("stopLoading")})))}))},getValidationState:function(e){var t=e.dirty,n=e.validated,r=e.valid;return t||n?(void 0===r?null:r)?"is-valid":"is-invalid":""},closeModal:function(){$("#edit-currency").modal("hide")}}};var c=n(3379),s=n.n(c),l=n(5918),d={insert:"head",singleton:!1};s()(l.Z,d);l.Z.locals;const u=(0,n(1900).Z)(o,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"modal",attrs:{id:"edit-currency"}},[n("div",{staticClass:"modal-dialog"},[n("div",{staticClass:"modal-content"},[e._m(0),e._v(" "),n("div",{staticClass:"modal-body"},[n("validation-observer",{ref:"editCurrency"},[n("form",{ref:"form",on:{submit:function(t){return t.preventDefault(),e.editCurrency.apply(null,arguments)}}},[n("div",{staticClass:"form-row"},[n("div",{staticClass:"col-md-12"},[n("validation-provider",{attrs:{name:"Currency Name",rules:{required:!0,min:2,max:20}},scopedSlots:e._u([{key:"default",fn:function(t){return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"name"}},[e._v("Currency Name")]),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.currency.currency_name,expression:"currency.currency_name",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(t),attrs:{type:"text",placeholder:"Enter currency name e.g US Dollar","aria-describedby":"Name-feedback"},domProps:{value:e.currency.currency_name},on:{input:function(t){t.target.composing||e.$set(e.currency,"currency_name",t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}}),e._v(" "),n("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Name-feed back"}},[e._v("\n                      "+e._s(t.errors[0])+"\n                    ")])])]}}])}),e._v(" "),n("validation-provider",{attrs:{name:"Currency Code",rules:{required:!0}},scopedSlots:e._u([{key:"default",fn:function(t){return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"name"}},[e._v("Currency Code")]),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.currency.currency_code,expression:"currency.currency_code",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(t),attrs:{type:"text",placeholder:"Enter currency Code e.g USD","aria-describedby":"Code-feedback"},domProps:{value:e.currency.currency_code},on:{input:function(t){t.target.composing||e.$set(e.currency,"currency_code",t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}}),e._v(" "),n("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Code-feed back"}},[e._v("\n                      "+e._s(t.errors[0])+"\n                    ")])])]}}])}),e._v(" "),n("validation-provider",{attrs:{name:"Currency Symbol",rules:{required:!0}},scopedSlots:e._u([{key:"default",fn:function(t){return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"name"}},[e._v("Currency Symbol")]),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.currency.currency_symbol,expression:"currency.currency_symbol",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(t),attrs:{type:"text",placeholder:"Enter currency name e.g $","aria-describedby":"Symbol-feedback"},domProps:{value:e.currency.currency_symbol},on:{input:function(t){t.target.composing||e.$set(e.currency,"currency_symbol",t.target.value.trim())},blur:function(t){return e.$forceUpdate()}}}),e._v(" "),n("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Symbol-feed back"}},[e._v("\n                      "+e._s(t.errors[0])+"\n                    ")])])]}}])}),e._v(" "),n("div",{staticClass:"form-group"},[n("div",{staticClass:"form-check"},[n("label",{staticClass:"form-check-label"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.currency.status,expression:"currency.status"}],staticClass:"form-check-input",attrs:{type:"checkbox",id:"status"},domProps:{checked:Array.isArray(e.currency.status)?e._i(e.currency.status,null)>-1:e.currency.status},on:{change:function(t){var n=e.currency.status,r=t.target,a=!!r.checked;if(Array.isArray(n)){var i=e._i(n,null);r.checked?i<0&&e.$set(e.currency,"status",n.concat([null])):i>-1&&e.$set(e.currency,"status",n.slice(0,i).concat(n.slice(i+1)))}else e.$set(e.currency,"status",a)}}}),e._v("\n                      Status\n                    ")])])])],1)]),e._v(" "),n("div",{staticClass:"col-12 my-3 text-right"},[n("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[e._v("Submit")])])])])],1)])])])}),[function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"modal-header"},[n("h4",{staticClass:"modal-title"},[e._v("Edit Currency")]),e._v(" "),n("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal"}},[e._v("\n          ×\n        ")])])}],!1,null,null,null).exports}}]);
//# sourceMappingURL=3767.js.map