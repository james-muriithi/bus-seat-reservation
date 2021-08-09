(self.webpackChunk=self.webpackChunk||[]).push([[51],{73794:(e,n,t)=>{"use strict";t.d(n,{Z:()=>i});var r=t(94015),a=t.n(r),c=t(23645),o=t.n(c)()(a());o.push([e.id,".fade:not(.show){opacity:1}","",{version:3,sources:["webpack://./resources/js/components/currencies/CreateCurrency.vue"],names:[],mappings:"AAsLA,iBACA,SACA",sourcesContent:['<template>\n  <div class="modal" id="create-currency">\n    <div class="modal-dialog">\n      <div class="modal-content">\n        \x3c!-- Modal Header --\x3e\n        <div class="modal-header">\n          <h4 class="modal-title">Create Currency</h4>\n          <button type="button" class="close" data-dismiss="modal">\n            &times;\n          </button>\n        </div>\n\n        \x3c!-- Modal body --\x3e\n        <div class="modal-body">\n          <validation-observer ref="createCurrency">\n            <form @submit.prevent="createCurrency" ref="form">\n              <div class="form-row">\n                <div class="col-md-12">\n                  <validation-provider\n                    name="Currency Name"\n                    :rules="{ required: true, min: 2, max: 20 }"\n                    v-slot="validationContext"\n                  >\n                    <div class="form-group">\n                      <label for="name">Currency Name</label>\n                      <input\n                        type="text"\n                        placeholder="Enter currency name e.g US Dollar"\n                        aria-describedby="Name-feedback"\n                        v-model.trim="currency.currency_name"\n                        :class="`form-control ${getValidationState(\n                          validationContext\n                        )}`"\n                      />\n                      <div id="Name-feed back" class="invalid-feedback w-100">\n                        {{ validationContext.errors[0] }}\n                      </div>\n                    </div>\n                  </validation-provider>\n                  \x3c!-- currency code --\x3e\n                  <validation-provider\n                    name="Currency Code"\n                    :rules="{ required: true }"\n                    v-slot="validationContext"\n                  >\n                    <div class="form-group">\n                      <label for="name">Currency Code</label>\n                      <input\n                        type="text"\n                        placeholder="Enter currency Code e.g USD"\n                        aria-describedby="Code-feedback"\n                        v-model.trim="currency.currency_code"\n                        :class="`form-control ${getValidationState(\n                          validationContext\n                        )}`"\n                      />\n                      <div id="Code-feed back" class="invalid-feedback w-100">\n                        {{ validationContext.errors[0] }}\n                      </div>\n                    </div>\n                  </validation-provider>\n\n                  \x3c!-- currency symbol --\x3e\n                  <validation-provider\n                    name="Currency Symbol"\n                    :rules="{ required: true }"\n                    v-slot="validationContext"\n                  >\n                    <div class="form-group">\n                      <label for="name">Currency Symbol</label>\n                      <input\n                        type="text"\n                        placeholder="Enter currency name e.g $"\n                        aria-describedby="Symbol-feedback"\n                        v-model.trim="currency.currency_symbol"\n                        :class="`form-control ${getValidationState(\n                          validationContext\n                        )}`"\n                      />\n                      <div id="Symbol-feed back" class="invalid-feedback w-100">\n                        {{ validationContext.errors[0] }}\n                      </div>\n                    </div>\n                  </validation-provider>\n\n                  <div class="form-group">\n                    <div class="form-check">\n                      <label class="form-check-label">\n                        <input\n                          class="form-check-input"\n                          type="checkbox"\n                          id="status"\n                          v-model="currency.status"\n                        />\n                        Status\n                      </label>\n                    </div>\n                  </div>\n                </div>\n              </div>\n\n              <div class="col-12 my-3 text-right">\n                <button class="btn btn-primary" type="submit">Submit</button>\n              </div>\n            </form>\n          </validation-observer>\n        </div>\n      </div>\n    </div>\n  </div>\n</template>\n\n<script>\nexport default {\n  emits: ["update"],\n  data() {\n    return {\n      currency: {\n        currency_code: "",\n        currency_symbol: "",\n        currency_name: "",\n        status: 1,\n      },\n    };\n  },\n  methods: {\n    resetForm() {\n      this.currency = {\n        currency_code: "",\n        currency_symbol: "",\n        currency_name: "",\n        status: 1,\n      };\n      this.$nextTick(() => {\n        this.$refs.createCurrency.reset();\n      });\n    },\n    createCurrency() {\n      this.$refs.createCurrency.validate().then((valid) => {\n        if (valid) {\n          //submit data\n          this.$store.dispatch("startLoading");\n          axios\n            .post("/admin/currencies", this.currency)\n            .then((res) => {\n              //   this.$store.dispatch("stopLoading");\n              this.closeModal();\n\n              this.$nextTick(() => {\n                this.$emit("update");\n                this.showSuccessToast(\'Currency created successfully\')\n              });\n            })\n            .catch((res) => {\n              this.$store.dispatch("stopLoading");\n              this.showErrorToast(\'There was a problem creating the currency\')\n            });\n        }\n      });\n    },\n    //---- Validation State Form\n    getValidationState({ dirty, validated, valid = null }) {\n      if (dirty || validated) {\n        return valid ? "is-valid" : "is-invalid";\n      }\n      return "";\n    },\n    closeModal() {\n      $("#create-currency").modal("hide");\n    },\n  },\n  created() {\n    const self = this;\n    $(function () {\n      $("#create-currency").on("show.bs.modal", function (e) {\n        self.resetForm();\n      });\n    });\n  },\n};\n<\/script>\n<style>\n.fade:not(.show) {\n  opacity: 1;\n}\n</style>\n'],sourceRoot:""}]);const i=o},23645:e=>{"use strict";e.exports=function(e){var n=[];return n.toString=function(){return this.map((function(n){var t=e(n);return n[2]?"@media ".concat(n[2]," {").concat(t,"}"):t})).join("")},n.i=function(e,t,r){"string"==typeof e&&(e=[[null,e,""]]);var a={};if(r)for(var c=0;c<this.length;c++){var o=this[c][0];null!=o&&(a[o]=!0)}for(var i=0;i<e.length;i++){var s=[].concat(e[i]);r&&a[s[0]]||(t&&(s[2]?s[2]="".concat(t," and ").concat(s[2]):s[2]=t),n.push(s))}},n}},94015:e=>{"use strict";function n(e,n){return function(e){if(Array.isArray(e))return e}(e)||function(e,n){var t=e&&("undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"]);if(null==t)return;var r,a,c=[],o=!0,i=!1;try{for(t=t.call(e);!(o=(r=t.next()).done)&&(c.push(r.value),!n||c.length!==n);o=!0);}catch(e){i=!0,a=e}finally{try{o||null==t.return||t.return()}finally{if(i)throw a}}return c}(e,n)||function(e,n){if(!e)return;if("string"==typeof e)return t(e,n);var r=Object.prototype.toString.call(e).slice(8,-1);"Object"===r&&e.constructor&&(r=e.constructor.name);if("Map"===r||"Set"===r)return Array.from(e);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return t(e,n)}(e,n)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function t(e,n){(null==n||n>e.length)&&(n=e.length);for(var t=0,r=new Array(n);t<n;t++)r[t]=e[t];return r}e.exports=function(e){var t=n(e,4),r=t[1],a=t[3];if(!a)return r;if("function"==typeof btoa){var c=btoa(unescape(encodeURIComponent(JSON.stringify(a)))),o="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(c),i="/*# ".concat(o," */"),s=a.sources.map((function(e){return"/*# sourceURL=".concat(a.sourceRoot||"").concat(e," */")}));return[r].concat(s).concat([i]).join("\n")}return[r].join("\n")}},93379:(e,n,t)=>{"use strict";var r,a=function(){return void 0===r&&(r=Boolean(window&&document&&document.all&&!window.atob)),r},c=function(){var e={};return function(n){if(void 0===e[n]){var t=document.querySelector(n);if(window.HTMLIFrameElement&&t instanceof window.HTMLIFrameElement)try{t=t.contentDocument.head}catch(e){t=null}e[n]=t}return e[n]}}(),o=[];function i(e){for(var n=-1,t=0;t<o.length;t++)if(o[t].identifier===e){n=t;break}return n}function s(e,n){for(var t={},r=[],a=0;a<e.length;a++){var c=e[a],s=n.base?c[0]+n.base:c[0],l=t[s]||0,u="".concat(s," ").concat(l);t[s]=l+1;var d=i(u),m={css:c[1],media:c[2],sourceMap:c[3]};-1!==d?(o[d].references++,o[d].updater(m)):o.push({identifier:u,updater:p(m,n),references:1}),r.push(u)}return r}function l(e){var n=document.createElement("style"),r=e.attributes||{};if(void 0===r.nonce){var a=t.nc;a&&(r.nonce=a)}if(Object.keys(r).forEach((function(e){n.setAttribute(e,r[e])})),"function"==typeof e.insert)e.insert(n);else{var o=c(e.insert||"head");if(!o)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");o.appendChild(n)}return n}var u,d=(u=[],function(e,n){return u[e]=n,u.filter(Boolean).join("\n")});function m(e,n,t,r){var a=t?"":r.media?"@media ".concat(r.media," {").concat(r.css,"}"):r.css;if(e.styleSheet)e.styleSheet.cssText=d(n,a);else{var c=document.createTextNode(a),o=e.childNodes;o[n]&&e.removeChild(o[n]),o.length?e.insertBefore(c,o[n]):e.appendChild(c)}}function v(e,n,t){var r=t.css,a=t.media,c=t.sourceMap;if(a?e.setAttribute("media",a):e.removeAttribute("media"),c&&"undefined"!=typeof btoa&&(r+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(c))))," */")),e.styleSheet)e.styleSheet.cssText=r;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(r))}}var f=null,y=0;function p(e,n){var t,r,a;if(n.singleton){var c=y++;t=f||(f=l(n)),r=m.bind(null,t,c,!1),a=m.bind(null,t,c,!0)}else t=l(n),r=v.bind(null,t,n),a=function(){!function(e){if(null===e.parentNode)return!1;e.parentNode.removeChild(e)}(t)};return r(e),function(n){if(n){if(n.css===e.css&&n.media===e.media&&n.sourceMap===e.sourceMap)return;r(e=n)}else a()}}e.exports=function(e,n){(n=n||{}).singleton||"boolean"==typeof n.singleton||(n.singleton=a());var t=s(e=e||[],n);return function(e){if(e=e||[],"[object Array]"===Object.prototype.toString.call(e)){for(var r=0;r<t.length;r++){var a=i(t[r]);o[a].references--}for(var c=s(e,n),l=0;l<t.length;l++){var u=i(t[l]);0===o[u].references&&(o[u].updater(),o.splice(u,1))}t=c}}}},30051:(e,n,t)=>{"use strict";t.r(n),t.d(n,{default:()=>s});const r={emits:["update"],data:function(){return{currency:{currency_code:"",currency_symbol:"",currency_name:"",status:1}}},methods:{resetForm:function(){var e=this;this.currency={currency_code:"",currency_symbol:"",currency_name:"",status:1},this.$nextTick((function(){e.$refs.createCurrency.reset()}))},createCurrency:function(){var e=this;this.$refs.createCurrency.validate().then((function(n){n&&(e.$store.dispatch("startLoading"),axios.post("/admin/currencies",e.currency).then((function(n){e.closeModal(),e.$nextTick((function(){e.$emit("update"),e.showSuccessToast("Currency created successfully")}))})).catch((function(n){e.$store.dispatch("stopLoading"),e.showErrorToast("There was a problem creating the currency")})))}))},getValidationState:function(e){var n=e.dirty,t=e.validated,r=e.valid;return n||t?(void 0===r?null:r)?"is-valid":"is-invalid":""},closeModal:function(){$("#create-currency").modal("hide")}},created:function(){var e=this;$((function(){$("#create-currency").on("show.bs.modal",(function(n){e.resetForm()}))}))}};var a=t(93379),c=t.n(a),o=t(73794),i={insert:"head",singleton:!1};c()(o.Z,i);o.Z.locals;const s=(0,t(51900).Z)(r,(function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("div",{staticClass:"modal",attrs:{id:"create-currency"}},[t("div",{staticClass:"modal-dialog"},[t("div",{staticClass:"modal-content"},[e._m(0),e._v(" "),t("div",{staticClass:"modal-body"},[t("validation-observer",{ref:"createCurrency"},[t("form",{ref:"form",on:{submit:function(n){return n.preventDefault(),e.createCurrency.apply(null,arguments)}}},[t("div",{staticClass:"form-row"},[t("div",{staticClass:"col-md-12"},[t("validation-provider",{attrs:{name:"Currency Name",rules:{required:!0,min:2,max:20}},scopedSlots:e._u([{key:"default",fn:function(n){return[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"name"}},[e._v("Currency Name")]),e._v(" "),t("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.currency.currency_name,expression:"currency.currency_name",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(n),attrs:{type:"text",placeholder:"Enter currency name e.g US Dollar","aria-describedby":"Name-feedback"},domProps:{value:e.currency.currency_name},on:{input:function(n){n.target.composing||e.$set(e.currency,"currency_name",n.target.value.trim())},blur:function(n){return e.$forceUpdate()}}}),e._v(" "),t("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Name-feed back"}},[e._v("\n                      "+e._s(n.errors[0])+"\n                    ")])])]}}])}),e._v(" "),t("validation-provider",{attrs:{name:"Currency Code",rules:{required:!0}},scopedSlots:e._u([{key:"default",fn:function(n){return[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"name"}},[e._v("Currency Code")]),e._v(" "),t("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.currency.currency_code,expression:"currency.currency_code",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(n),attrs:{type:"text",placeholder:"Enter currency Code e.g USD","aria-describedby":"Code-feedback"},domProps:{value:e.currency.currency_code},on:{input:function(n){n.target.composing||e.$set(e.currency,"currency_code",n.target.value.trim())},blur:function(n){return e.$forceUpdate()}}}),e._v(" "),t("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Code-feed back"}},[e._v("\n                      "+e._s(n.errors[0])+"\n                    ")])])]}}])}),e._v(" "),t("validation-provider",{attrs:{name:"Currency Symbol",rules:{required:!0}},scopedSlots:e._u([{key:"default",fn:function(n){return[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"name"}},[e._v("Currency Symbol")]),e._v(" "),t("input",{directives:[{name:"model",rawName:"v-model.trim",value:e.currency.currency_symbol,expression:"currency.currency_symbol",modifiers:{trim:!0}}],class:"form-control "+e.getValidationState(n),attrs:{type:"text",placeholder:"Enter currency name e.g $","aria-describedby":"Symbol-feedback"},domProps:{value:e.currency.currency_symbol},on:{input:function(n){n.target.composing||e.$set(e.currency,"currency_symbol",n.target.value.trim())},blur:function(n){return e.$forceUpdate()}}}),e._v(" "),t("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Symbol-feed back"}},[e._v("\n                      "+e._s(n.errors[0])+"\n                    ")])])]}}])}),e._v(" "),t("div",{staticClass:"form-group"},[t("div",{staticClass:"form-check"},[t("label",{staticClass:"form-check-label"},[t("input",{directives:[{name:"model",rawName:"v-model",value:e.currency.status,expression:"currency.status"}],staticClass:"form-check-input",attrs:{type:"checkbox",id:"status"},domProps:{checked:Array.isArray(e.currency.status)?e._i(e.currency.status,null)>-1:e.currency.status},on:{change:function(n){var t=e.currency.status,r=n.target,a=!!r.checked;if(Array.isArray(t)){var c=e._i(t,null);r.checked?c<0&&e.$set(e.currency,"status",t.concat([null])):c>-1&&e.$set(e.currency,"status",t.slice(0,c).concat(t.slice(c+1)))}else e.$set(e.currency,"status",a)}}}),e._v("\n                      Status\n                    ")])])])],1)]),e._v(" "),t("div",{staticClass:"col-12 my-3 text-right"},[t("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[e._v("Submit")])])])])],1)])])])}),[function(){var e=this,n=e.$createElement,t=e._self._c||n;return t("div",{staticClass:"modal-header"},[t("h4",{staticClass:"modal-title"},[e._v("Create Currency")]),e._v(" "),t("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal"}},[e._v("\n          ×\n        ")])])}],!1,null,null,null).exports}}]);
//# sourceMappingURL=51.js.map