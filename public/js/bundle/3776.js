(self.webpackChunk=self.webpackChunk||[]).push([[3776],{41199:(t,e,n)=>{"use strict";n.d(e,{Z:()=>o});var s=n(94015),a=n.n(s),i=n(23645),r=n.n(i)()(a());r.push([t.id,".fade:not(.show){opacity:1}","",{version:3,sources:["webpack://./resources/js/components/bus-type/EditBusType.vue"],names:[],mappings:"AAsHA,iBACA,SACA",sourcesContent:['<template>\n  <div class="modal" id="edit-bus-type">\n    <div class="modal-dialog">\n      <div class="modal-content">\n        \x3c!-- Modal Header --\x3e\n        <div class="modal-header">\n          <h4 class="modal-title">Edit Bus Type</h4>\n          <button type="button" class="close" data-dismiss="modal">\n            &times;\n          </button>\n        </div>\n\n        \x3c!-- Modal body --\x3e\n        <div class="modal-body">\n          <validation-observer ref="editBusType">\n            <form @submit.prevent="editBusType" ref="form">\n              <div class="form-row">\n                <div class="col-md-12">\n                  <validation-provider\n                    name="Bus Type"\n                    :rules="{ required: true, min: 2, max: 20 }"\n                    v-slot="validationContext"\n                  >\n                    <div class="form-group">\n                      <label for="name">Bus Type</label>\n                      <input\n                        type="text"\n                        placeholder="Enter bus type"\n                        aria-describedby="Name-feedback"\n                        v-model.trim="busType.bus_type"\n                        :class="`form-control ${getValidationState(\n                          validationContext\n                        )}`"\n                      />\n                      <div id="Name-feed back" class="invalid-feedback w-100">\n                        {{ validationContext.errors[0] }}\n                      </div>\n                    </div>\n                  </validation-provider>\n\n                  <div class="form-group">\n                    <div class="form-check">\n                      <label class="form-check-label">\n                        <input\n                          class="form-check-input"\n                          type="checkbox"\n                          id="status"\n                          v-model="busType.status"\n                        />\n                        Status\n                      </label>\n                    </div>\n                  </div>\n                </div>\n              </div>\n\n              <div class="col-12 my-3 text-right">\n                <button class="btn btn-primary" type="submit">Submit</button>\n              </div>\n            </form>\n          </validation-observer>\n        </div>\n      </div>\n    </div>\n  </div>\n</template>\n\n<script>\nexport default {\n  emits: ["update"],\n  props: {\n    busType: {\n      type: Object,\n      required: true,\n    },\n  },\n  methods: {\n    editBusType() {\n      this.$refs.editBusType.validate().then((valid) => {\n        if (valid) {\n          //submit data\n          this.$store.dispatch("startLoading");\n          axios\n            .post(`/admin/bus-types/${this.busType.id}`, {\n              bus_type: this.busType.bus_type,\n              status: this.busType.status,\n              _method: "PUT",\n            })\n            .then((res) => {\n              //   this.$store.dispatch("stopLoading");\n              this.closeModal();\n\n              this.$nextTick(() => {\n                this.$emit("update");\n                this.showSuccessToast("Bus type edited successfully");\n              });\n            })\n            .catch((res) => {\n              this.$store.dispatch("stopLoading");\n              this.showErrorToast("There was error editing the bus type");\n            });\n        }\n      });\n    },\n    //---- Validation State Form\n    getValidationState({ dirty, validated, valid = null }) {\n      if (dirty || validated) {\n        return valid ? "is-valid" : "is-invalid";\n      }\n      return "";\n    },\n    closeModal() {\n      $("#edit-bus-type").modal("hide");\n    },\n  },\n};\n<\/script>\n<style>\n.fade:not(.show) {\n  opacity: 1;\n}\n</style>\n'],sourceRoot:""}]);const o=r},23645:t=>{"use strict";t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n=t(e);return e[2]?"@media ".concat(e[2]," {").concat(n,"}"):n})).join("")},e.i=function(t,n,s){"string"==typeof t&&(t=[[null,t,""]]);var a={};if(s)for(var i=0;i<this.length;i++){var r=this[i][0];null!=r&&(a[r]=!0)}for(var o=0;o<t.length;o++){var u=[].concat(t[o]);s&&a[u[0]]||(n&&(u[2]?u[2]="".concat(n," and ").concat(u[2]):u[2]=n),e.push(u))}},e}},94015:t=>{"use strict";function e(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=t&&("undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"]);if(null==n)return;var s,a,i=[],r=!0,o=!1;try{for(n=n.call(t);!(r=(s=n.next()).done)&&(i.push(s.value),!e||i.length!==e);r=!0);}catch(t){o=!0,a=t}finally{try{r||null==n.return||n.return()}finally{if(o)throw a}}return i}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return n(t,e);var s=Object.prototype.toString.call(t).slice(8,-1);"Object"===s&&t.constructor&&(s=t.constructor.name);if("Map"===s||"Set"===s)return Array.from(t);if("Arguments"===s||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(s))return n(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,s=new Array(e);n<e;n++)s[n]=t[n];return s}t.exports=function(t){var n=e(t,4),s=n[1],a=n[3];if(!a)return s;if("function"==typeof btoa){var i=btoa(unescape(encodeURIComponent(JSON.stringify(a)))),r="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(i),o="/*# ".concat(r," */"),u=a.sources.map((function(t){return"/*# sourceURL=".concat(a.sourceRoot||"").concat(t," */")}));return[s].concat(u).concat([o]).join("\n")}return[s].join("\n")}},93379:(t,e,n)=>{"use strict";var s,a=function(){return void 0===s&&(s=Boolean(window&&document&&document.all&&!window.atob)),s},i=function(){var t={};return function(e){if(void 0===t[e]){var n=document.querySelector(e);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(t){n=null}t[e]=n}return t[e]}}(),r=[];function o(t){for(var e=-1,n=0;n<r.length;n++)if(r[n].identifier===t){e=n;break}return e}function u(t,e){for(var n={},s=[],a=0;a<t.length;a++){var i=t[a],u=e.base?i[0]+e.base:i[0],c=n[u]||0,l="".concat(u," ").concat(c);n[u]=c+1;var d=o(l),p={css:i[1],media:i[2],sourceMap:i[3]};-1!==d?(r[d].references++,r[d].updater(p)):r.push({identifier:l,updater:y(p,e),references:1}),s.push(l)}return s}function c(t){var e=document.createElement("style"),s=t.attributes||{};if(void 0===s.nonce){var a=n.nc;a&&(s.nonce=a)}if(Object.keys(s).forEach((function(t){e.setAttribute(t,s[t])})),"function"==typeof t.insert)t.insert(e);else{var r=i(t.insert||"head");if(!r)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");r.appendChild(e)}return e}var l,d=(l=[],function(t,e){return l[t]=e,l.filter(Boolean).join("\n")});function p(t,e,n,s){var a=n?"":s.media?"@media ".concat(s.media," {").concat(s.css,"}"):s.css;if(t.styleSheet)t.styleSheet.cssText=d(e,a);else{var i=document.createTextNode(a),r=t.childNodes;r[e]&&t.removeChild(r[e]),r.length?t.insertBefore(i,r[e]):t.appendChild(i)}}function f(t,e,n){var s=n.css,a=n.media,i=n.sourceMap;if(a?t.setAttribute("media",a):t.removeAttribute("media"),i&&"undefined"!=typeof btoa&&(s+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(i))))," */")),t.styleSheet)t.styleSheet.cssText=s;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(s))}}var v=null,m=0;function y(t,e){var n,s,a;if(e.singleton){var i=m++;n=v||(v=c(e)),s=p.bind(null,n,i,!1),a=p.bind(null,n,i,!0)}else n=c(e),s=f.bind(null,n,e),a=function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(n)};return s(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;s(t=e)}else a()}}t.exports=function(t,e){(e=e||{}).singleton||"boolean"==typeof e.singleton||(e.singleton=a());var n=u(t=t||[],e);return function(t){if(t=t||[],"[object Array]"===Object.prototype.toString.call(t)){for(var s=0;s<n.length;s++){var a=o(n[s]);r[a].references--}for(var i=u(t,e),c=0;c<n.length;c++){var l=o(n[c]);0===r[l].references&&(r[l].updater(),r.splice(l,1))}n=i}}}},33776:(t,e,n)=>{"use strict";n.r(e),n.d(e,{default:()=>u});const s={emits:["update"],props:{busType:{type:Object,required:!0}},methods:{editBusType:function(){var t=this;this.$refs.editBusType.validate().then((function(e){e&&(t.$store.dispatch("startLoading"),axios.post("/admin/bus-types/".concat(t.busType.id),{bus_type:t.busType.bus_type,status:t.busType.status,_method:"PUT"}).then((function(e){t.closeModal(),t.$nextTick((function(){t.$emit("update"),t.showSuccessToast("Bus type edited successfully")}))})).catch((function(e){t.$store.dispatch("stopLoading"),t.showErrorToast("There was error editing the bus type")})))}))},getValidationState:function(t){var e=t.dirty,n=t.validated,s=t.valid;return e||n?(void 0===s?null:s)?"is-valid":"is-invalid":""},closeModal:function(){$("#edit-bus-type").modal("hide")}}};var a=n(93379),i=n.n(a),r=n(41199),o={insert:"head",singleton:!1};i()(r.Z,o);r.Z.locals;const u=(0,n(51900).Z)(s,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"modal",attrs:{id:"edit-bus-type"}},[n("div",{staticClass:"modal-dialog"},[n("div",{staticClass:"modal-content"},[t._m(0),t._v(" "),n("div",{staticClass:"modal-body"},[n("validation-observer",{ref:"editBusType"},[n("form",{ref:"form",on:{submit:function(e){return e.preventDefault(),t.editBusType.apply(null,arguments)}}},[n("div",{staticClass:"form-row"},[n("div",{staticClass:"col-md-12"},[n("validation-provider",{attrs:{name:"Bus Type",rules:{required:!0,min:2,max:20}},scopedSlots:t._u([{key:"default",fn:function(e){return[n("div",{staticClass:"form-group"},[n("label",{attrs:{for:"name"}},[t._v("Bus Type")]),t._v(" "),n("input",{directives:[{name:"model",rawName:"v-model.trim",value:t.busType.bus_type,expression:"busType.bus_type",modifiers:{trim:!0}}],class:"form-control "+t.getValidationState(e),attrs:{type:"text",placeholder:"Enter bus type","aria-describedby":"Name-feedback"},domProps:{value:t.busType.bus_type},on:{input:function(e){e.target.composing||t.$set(t.busType,"bus_type",e.target.value.trim())},blur:function(e){return t.$forceUpdate()}}}),t._v(" "),n("div",{staticClass:"invalid-feedback w-100",attrs:{id:"Name-feed back"}},[t._v("\n                      "+t._s(e.errors[0])+"\n                    ")])])]}}])}),t._v(" "),n("div",{staticClass:"form-group"},[n("div",{staticClass:"form-check"},[n("label",{staticClass:"form-check-label"},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.busType.status,expression:"busType.status"}],staticClass:"form-check-input",attrs:{type:"checkbox",id:"status"},domProps:{checked:Array.isArray(t.busType.status)?t._i(t.busType.status,null)>-1:t.busType.status},on:{change:function(e){var n=t.busType.status,s=e.target,a=!!s.checked;if(Array.isArray(n)){var i=t._i(n,null);s.checked?i<0&&t.$set(t.busType,"status",n.concat([null])):i>-1&&t.$set(t.busType,"status",n.slice(0,i).concat(n.slice(i+1)))}else t.$set(t.busType,"status",a)}}}),t._v("\n                      Status\n                    ")])])])],1)]),t._v(" "),n("div",{staticClass:"col-12 my-3 text-right"},[n("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Submit")])])])])],1)])])])}),[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"modal-header"},[n("h4",{staticClass:"modal-title"},[t._v("Edit Bus Type")]),t._v(" "),n("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal"}},[t._v("\n          ×\n        ")])])}],!1,null,null,null).exports}}]);
//# sourceMappingURL=3776.js.map