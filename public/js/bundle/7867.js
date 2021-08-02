(self.webpackChunk=self.webpackChunk||[]).push([[7867],{3874:(t,e,n)=>{"use strict";n.d(e,{Z:()=>i});var o=n(4015),s=n.n(o),a=n(3645),r=n.n(a)()(s());r.push([t.id,".fade:not(.show){opacity:1}","",{version:3,sources:["webpack://./resources/js/components/buses/DeleteBus.vue"],names:[],mappings:"AAyEA,iBACA,SACA",sourcesContent:['<template>\n  <div class="modal" id="delete-bus">\n    <div class="modal-dialog">\n      <div class="modal-content">\n        \x3c!-- Modal Header --\x3e\n        <div class="modal-header">\n          <h4 class="modal-title">Delete Bus</h4>\n          <button type="button" class="close" data-dismiss="modal">\n            &times;\n          </button>\n        </div>\n\n        \x3c!-- Modal body --\x3e\n        <div class="modal-body">\n          <div class="mb-2">\n            <p>\n              Are you sure you want to delete <b>{{ `${bus.bus_name} ${bus.bus_reg_no}`  }}</b>?\n            </p>\n          </div>\n\n          <div class="col-12 mt-3 text-right">\n            <button class="btn btn-primary" data-dismiss="modal">Cancel</button>\n            <button class="btn btn-danger" @click="deleteBus">\n              Delete\n            </button>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</template>\n\n<script>\nexport default {\n  emits: ["update"],\n  props: {\n    bus: {\n      type: Object,\n      required: true,\n    },\n  },\n  data() {\n    return {};\n  },\n  methods: {\n    deleteBus() {\n      this.$store.dispatch("startLoading");\n      axios\n        .post(`/admin/buses/${this.bus.id}`, {\n          _method: "DELETE",\n        })\n        .then((res) => {\n          this.closeModal();\n\n          this.$nextTick(() => {\n            this.$emit("update");\n          });\n        })\n        .catch((res) => {\n          this.closeModal();\n          this.$store.dispatch("stopLoading");\n        });\n    },\n    closeModal() {\n      $("#delete-bus").modal("hide");\n    },\n  },\n  created() {\n    const self = this;\n  },\n};\n<\/script>\n<style>\n.fade:not(.show) {\n  opacity: 1;\n}\n</style>\n'],sourceRoot:""}]);const i=r},3645:t=>{"use strict";t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n=t(e);return e[2]?"@media ".concat(e[2]," {").concat(n,"}"):n})).join("")},e.i=function(t,n,o){"string"==typeof t&&(t=[[null,t,""]]);var s={};if(o)for(var a=0;a<this.length;a++){var r=this[a][0];null!=r&&(s[r]=!0)}for(var i=0;i<t.length;i++){var c=[].concat(t[i]);o&&s[c[0]]||(n&&(c[2]?c[2]="".concat(n," and ").concat(c[2]):c[2]=n),e.push(c))}},e}},4015:t=>{"use strict";function e(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=t&&("undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"]);if(null==n)return;var o,s,a=[],r=!0,i=!1;try{for(n=n.call(t);!(r=(o=n.next()).done)&&(a.push(o.value),!e||a.length!==e);r=!0);}catch(t){i=!0,s=t}finally{try{r||null==n.return||n.return()}finally{if(i)throw s}}return a}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return n(t,e);var o=Object.prototype.toString.call(t).slice(8,-1);"Object"===o&&t.constructor&&(o=t.constructor.name);if("Map"===o||"Set"===o)return Array.from(t);if("Arguments"===o||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(o))return n(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,o=new Array(e);n<e;n++)o[n]=t[n];return o}t.exports=function(t){var n=e(t,4),o=n[1],s=n[3];if(!s)return o;if("function"==typeof btoa){var a=btoa(unescape(encodeURIComponent(JSON.stringify(s)))),r="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(a),i="/*# ".concat(r," */"),c=s.sources.map((function(t){return"/*# sourceURL=".concat(s.sourceRoot||"").concat(t," */")}));return[o].concat(c).concat([i]).join("\n")}return[o].join("\n")}},3379:(t,e,n)=>{"use strict";var o,s=function(){return void 0===o&&(o=Boolean(window&&document&&document.all&&!window.atob)),o},a=function(){var t={};return function(e){if(void 0===t[e]){var n=document.querySelector(e);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(t){n=null}t[e]=n}return t[e]}}(),r=[];function i(t){for(var e=-1,n=0;n<r.length;n++)if(r[n].identifier===t){e=n;break}return e}function c(t,e){for(var n={},o=[],s=0;s<t.length;s++){var a=t[s],c=e.base?a[0]+e.base:a[0],l=n[c]||0,u="".concat(c," ").concat(l);n[c]=l+1;var d=i(u),f={css:a[1],media:a[2],sourceMap:a[3]};-1!==d?(r[d].references++,r[d].updater(f)):r.push({identifier:u,updater:v(f,e),references:1}),o.push(u)}return o}function l(t){var e=document.createElement("style"),o=t.attributes||{};if(void 0===o.nonce){var s=n.nc;s&&(o.nonce=s)}if(Object.keys(o).forEach((function(t){e.setAttribute(t,o[t])})),"function"==typeof t.insert)t.insert(e);else{var r=a(t.insert||"head");if(!r)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");r.appendChild(e)}return e}var u,d=(u=[],function(t,e){return u[t]=e,u.filter(Boolean).join("\n")});function f(t,e,n,o){var s=n?"":o.media?"@media ".concat(o.media," {").concat(o.css,"}"):o.css;if(t.styleSheet)t.styleSheet.cssText=d(e,s);else{var a=document.createTextNode(s),r=t.childNodes;r[e]&&t.removeChild(r[e]),r.length?t.insertBefore(a,r[e]):t.appendChild(a)}}function p(t,e,n){var o=n.css,s=n.media,a=n.sourceMap;if(s?t.setAttribute("media",s):t.removeAttribute("media"),a&&"undefined"!=typeof btoa&&(o+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(a))))," */")),t.styleSheet)t.styleSheet.cssText=o;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(o))}}var m=null,h=0;function v(t,e){var n,o,s;if(e.singleton){var a=h++;n=m||(m=l(e)),o=f.bind(null,n,a,!1),s=f.bind(null,n,a,!0)}else n=l(e),o=p.bind(null,n,e),s=function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(n)};return o(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;o(t=e)}else s()}}t.exports=function(t,e){(e=e||{}).singleton||"boolean"==typeof e.singleton||(e.singleton=s());var n=c(t=t||[],e);return function(t){if(t=t||[],"[object Array]"===Object.prototype.toString.call(t)){for(var o=0;o<n.length;o++){var s=i(n[o]);r[s].references--}for(var a=c(t,e),l=0;l<n.length;l++){var u=i(n[l]);0===r[u].references&&(r[u].updater(),r.splice(u,1))}n=a}}}},7867:(t,e,n)=>{"use strict";n.r(e),n.d(e,{default:()=>c});const o={emits:["update"],props:{bus:{type:Object,required:!0}},data:function(){return{}},methods:{deleteBus:function(){var t=this;this.$store.dispatch("startLoading"),axios.post("/admin/buses/".concat(this.bus.id),{_method:"DELETE"}).then((function(e){t.closeModal(),t.$nextTick((function(){t.$emit("update")}))})).catch((function(e){t.closeModal(),t.$store.dispatch("stopLoading")}))},closeModal:function(){$("#delete-bus").modal("hide")}},created:function(){}};var s=n(3379),a=n.n(s),r=n(3874),i={insert:"head",singleton:!1};a()(r.Z,i);r.Z.locals;const c=(0,n(1900).Z)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"modal",attrs:{id:"delete-bus"}},[n("div",{staticClass:"modal-dialog"},[n("div",{staticClass:"modal-content"},[t._m(0),t._v(" "),n("div",{staticClass:"modal-body"},[n("div",{staticClass:"mb-2"},[n("p",[t._v("\n            Are you sure you want to delete "),n("b",[t._v(t._s(t.bus.bus_name+" "+t.bus.bus_reg_no))]),t._v("?\n          ")])]),t._v(" "),n("div",{staticClass:"col-12 mt-3 text-right"},[n("button",{staticClass:"btn btn-primary",attrs:{"data-dismiss":"modal"}},[t._v("Cancel")]),t._v(" "),n("button",{staticClass:"btn btn-danger",on:{click:t.deleteBus}},[t._v("\n            Delete\n          ")])])])])])])}),[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"modal-header"},[n("h4",{staticClass:"modal-title"},[t._v("Delete Bus")]),t._v(" "),n("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal"}},[t._v("\n          ×\n        ")])])}],!1,null,null,null).exports}}]);
//# sourceMappingURL=7867.js.map