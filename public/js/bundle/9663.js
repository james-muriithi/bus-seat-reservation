/*! For license information please see 9663.js.LICENSE.txt */
(self.webpackChunk=self.webpackChunk||[]).push([[9663],{2973:(t,e,r)=>{"use strict";r.d(e,{Z:()=>a});var n=r(94015),o=r.n(n),s=r(23645),i=r.n(s)()(o());i.push([t.id,"th[data-v-ec5690bc]{font-size:14px;font-weight:700}.image-cover[data-v-ec5690bc]{border-radius:8px!important;-o-object-fit:cover;object-fit:cover}","",{version:3,sources:["webpack://./resources/js/components/routes/ViewRoute.vue"],names:[],mappings:"AAwIA,oBACA,cAAA,CACA,eACA,CACA,8BACA,2BAAA,CACA,mBAAA,CAAA,gBACA",sourcesContent:['<template>\r\n  <div class="mx-2 mx-md-3 mt-2">\r\n    <div class="card">\r\n      <div class="card-body">\r\n        <div class="row">\r\n          <div class="col-md-12">\r\n            <h4 class="font-weight-bold mb-3">Route Details</h4>\r\n\r\n            <table class="table table-hover table-bordered table-md">\r\n              <tbody>\r\n                <tr>\r\n                  <td>Bus Name</td>\r\n                  <th>{{ route.bus.bus_name }} - {{ route.bus.bus_reg_no }}</th>\r\n                </tr>\r\n                <tr>\r\n                  <td>Pickup Point</td>\r\n                  <th>{{ route.board_point }}</th>\r\n                </tr>\r\n                <tr>\r\n                  <td>Pickup Time</td>\r\n                  <th>{{ route.board_time }}</th>\r\n                </tr>\r\n                <tr>\r\n                  <td>Drop Off Point</td>\r\n                  <th>{{ route.drop_point }}</th>\r\n                </tr>\r\n                <tr>\r\n                  <td>Drop Off Time</td>\r\n                  <th>{{ route.drop_time }}</th>\r\n                </tr>\r\n                <tr>\r\n                  <td>Status</td>\r\n                  <th>\r\n                    <span\r\n                      :class="`badge py-1 px-2 badge-outline-${\r\n                        route.status ? \'success\' : \'danger\'\r\n                      }`"\r\n                    >\r\n                      {{ route.status ? "Active" : "Inactive" }}\r\n                    </span>\r\n                  </th>\r\n                </tr>\r\n\r\n                <tr>\r\n                  <td>Fare</td>\r\n                  <th>\r\n                    <span\r\n                      class="badge py-1 px-2 badge-success mr-1"\r\n                      v-for="seatClass in route.seatClassesFare"\r\n                      :key="seatClass.id"\r\n                    >\r\n                      {{ seatClass.name }} - {{ seatClass.currencyCode\r\n                      }}{{ seatClass.fare }}\r\n                    </span>\r\n                  </th>\r\n                </tr>\r\n                <tr>\r\n                  <td>Created At</td>\r\n                  <th>{{ route.created_at }}</th>\r\n                </tr>\r\n                <tr>\r\n                  <td>Updated At</td>\r\n                  <th>{{ route.updated_at }}</th>\r\n                </tr>\r\n              </tbody>\r\n            </table>\r\n          </div>\r\n        </div>\r\n\r\n        <div class="row mt-3">\r\n          <div class="col-md-6">\r\n            <h4 class="mb-3 font-weight-bold">Price Variations</h4>\r\n            <div class="mt-2">\r\n              <price-variations-table :smallTable="true" :route_id="route.id"></price-variations-table>\r\n            </div>\r\n          </div>\r\n          <div class="col-md-6">\r\n            <h4 class="mb-3 font-weight-bold">Trips</h4>\r\n            <div class="mt-2">\r\n              <trips-table :route_id="route.id" />\r\n            </div>\r\n          </div>\r\n        </div>\r\n\r\n        <div class="row mt-5">\r\n          <div class="col-md-6">\r\n            <h4 class="mb-3 font-weight-bold">Drop Off Points</h4>\r\n            <div class="mt-2">\r\n              <drop-off-points-table :smallTable="true" :defaultCreateRoute="route.id"></drop-off-points-table>\r\n            </div>\r\n          </div>\r\n          <div class="col-md-6">\r\n            <h4 class="mb-3 font-weight-bold">Pickup Up Points</h4>\r\n            <div class="mt-2">\r\n              <pickup-points-table :smallTable="true" :defaultCreateRoute="route.id"></pickup-points-table>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</template>\r\n\r\n<script>\r\nimport Nprogress from "nprogress";\r\nconst PickupPointsTable = () => import("../pickup/Table.vue");\r\nconst DropOffPointsTable = () =>  import("../drop-off-point/DropOffPointsTable.vue");\r\nconst PriceVariationsTable = () => import("../route-price-variations/PriceVariationsTable.vue");\r\nconst TripsTable = () => import ("../trips/TripsTable.vue");\r\n\r\nexport default {\r\n  components: { PickupPointsTable, DropOffPointsTable, PriceVariationsTable, TripsTable },\r\n  props: {\r\n    route: {\r\n      type: Object,\r\n      required: true,\r\n    },\r\n  },\r\n  computed: {\r\n    loading() {\r\n      return this.$store.getters.loading;\r\n    },\r\n  },\r\n  watch: {\r\n    loading(newValue) {\r\n      if (newValue) {\r\n        Nprogress.start();\r\n        Nprogress.set(0.1);\r\n      } else {\r\n        Nprogress.done();\r\n      }\r\n    },\r\n  },\r\n};\r\n<\/script>\r\n<style scoped>\r\nth {\r\n  font-size: 14px;\r\n  font-weight: 700;\r\n}\r\n.image-cover {\r\n  border-radius: 8px !important;\r\n  object-fit: cover;\r\n}\r\n</style>\r\n'],sourceRoot:""}]);const a=i},23645:t=>{"use strict";t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var r=t(e);return e[2]?"@media ".concat(e[2]," {").concat(r,"}"):r})).join("")},e.i=function(t,r,n){"string"==typeof t&&(t=[[null,t,""]]);var o={};if(n)for(var s=0;s<this.length;s++){var i=this[s][0];null!=i&&(o[i]=!0)}for(var a=0;a<t.length;a++){var c=[].concat(t[a]);n&&o[c[0]]||(r&&(c[2]?c[2]="".concat(r," and ").concat(c[2]):c[2]=r),e.push(c))}},e}},94015:t=>{"use strict";function e(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var r=t&&("undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"]);if(null==r)return;var n,o,s=[],i=!0,a=!1;try{for(r=r.call(t);!(i=(n=r.next()).done)&&(s.push(n.value),!e||s.length!==e);i=!0);}catch(t){a=!0,o=t}finally{try{i||null==r.return||r.return()}finally{if(a)throw o}}return s}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return r(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);"Object"===n&&t.constructor&&(n=t.constructor.name);if("Map"===n||"Set"===n)return Array.from(t);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return r(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function r(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}t.exports=function(t){var r=e(t,4),n=r[1],o=r[3];if(!o)return n;if("function"==typeof btoa){var s=btoa(unescape(encodeURIComponent(JSON.stringify(o)))),i="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(s),a="/*# ".concat(i," */"),c=o.sources.map((function(t){return"/*# sourceURL=".concat(o.sourceRoot||"").concat(t," */")}));return[n].concat(c).concat([a]).join("\n")}return[n].join("\n")}},74865:function(t,e,r){var n,o;void 0===(o="function"==typeof(n=function(){var t,e,r={version:"0.2.0"},n=r.settings={minimum:.08,easing:"ease",positionUsing:"",speed:200,trickle:!0,trickleRate:.02,trickleSpeed:800,showSpinner:!0,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};function o(t,e,r){return t<e?e:t>r?r:t}function s(t){return 100*(-1+t)}function i(t,e,r){var o;return(o="translate3d"===n.positionUsing?{transform:"translate3d("+s(t)+"%,0,0)"}:"translate"===n.positionUsing?{transform:"translate("+s(t)+"%,0)"}:{"margin-left":s(t)+"%"}).transition="all "+e+"ms "+r,o}r.configure=function(t){var e,r;for(e in t)void 0!==(r=t[e])&&t.hasOwnProperty(e)&&(n[e]=r);return this},r.status=null,r.set=function(t){var e=r.isStarted();t=o(t,n.minimum,1),r.status=1===t?null:t;var s=r.render(!e),u=s.querySelector(n.barSelector),l=n.speed,d=n.easing;return s.offsetWidth,a((function(e){""===n.positionUsing&&(n.positionUsing=r.getPositioningCSS()),c(u,i(t,l,d)),1===t?(c(s,{transition:"none",opacity:1}),s.offsetWidth,setTimeout((function(){c(s,{transition:"all "+l+"ms linear",opacity:0}),setTimeout((function(){r.remove(),e()}),l)}),l)):setTimeout(e,l)})),this},r.isStarted=function(){return"number"==typeof r.status},r.start=function(){r.status||r.set(0);var t=function(){setTimeout((function(){r.status&&(r.trickle(),t())}),n.trickleSpeed)};return n.trickle&&t(),this},r.done=function(t){return t||r.status?r.inc(.3+.5*Math.random()).set(1):this},r.inc=function(t){var e=r.status;return e?("number"!=typeof t&&(t=(1-e)*o(Math.random()*e,.1,.95)),e=o(e+t,0,.994),r.set(e)):r.start()},r.trickle=function(){return r.inc(Math.random()*n.trickleRate)},t=0,e=0,r.promise=function(n){return n&&"resolved"!==n.state()?(0===e&&r.start(),t++,e++,n.always((function(){0==--e?(t=0,r.done()):r.set((t-e)/t)})),this):this},r.render=function(t){if(r.isRendered())return document.getElementById("nprogress");l(document.documentElement,"nprogress-busy");var e=document.createElement("div");e.id="nprogress",e.innerHTML=n.template;var o,i=e.querySelector(n.barSelector),a=t?"-100":s(r.status||0),u=document.querySelector(n.parent);return c(i,{transition:"all 0 linear",transform:"translate3d("+a+"%,0,0)"}),n.showSpinner||(o=e.querySelector(n.spinnerSelector))&&f(o),u!=document.body&&l(u,"nprogress-custom-parent"),u.appendChild(e),e},r.remove=function(){d(document.documentElement,"nprogress-busy"),d(document.querySelector(n.parent),"nprogress-custom-parent");var t=document.getElementById("nprogress");t&&f(t)},r.isRendered=function(){return!!document.getElementById("nprogress")},r.getPositioningCSS=function(){var t=document.body.style,e="WebkitTransform"in t?"Webkit":"MozTransform"in t?"Moz":"msTransform"in t?"ms":"OTransform"in t?"O":"";return e+"Perspective"in t?"translate3d":e+"Transform"in t?"translate":"margin"};var a=function(){var t=[];function e(){var r=t.shift();r&&r(e)}return function(r){t.push(r),1==t.length&&e()}}(),c=function(){var t=["Webkit","O","Moz","ms"],e={};function r(t){return t.replace(/^-ms-/,"ms-").replace(/-([\da-z])/gi,(function(t,e){return e.toUpperCase()}))}function n(e){var r=document.body.style;if(e in r)return e;for(var n,o=t.length,s=e.charAt(0).toUpperCase()+e.slice(1);o--;)if((n=t[o]+s)in r)return n;return e}function o(t){return t=r(t),e[t]||(e[t]=n(t))}function s(t,e,r){e=o(e),t.style[e]=r}return function(t,e){var r,n,o=arguments;if(2==o.length)for(r in e)void 0!==(n=e[r])&&e.hasOwnProperty(r)&&s(t,r,n);else s(t,o[1],o[2])}}();function u(t,e){return("string"==typeof t?t:p(t)).indexOf(" "+e+" ")>=0}function l(t,e){var r=p(t),n=r+e;u(r,e)||(t.className=n.substring(1))}function d(t,e){var r,n=p(t);u(t,e)&&(r=n.replace(" "+e+" "," "),t.className=r.substring(1,r.length-1))}function p(t){return(" "+(t.className||"")+" ").replace(/\s+/gi," ")}function f(t){t&&t.parentNode&&t.parentNode.removeChild(t)}return r})?n.call(e,r,e,t):n)||(t.exports=o)},93379:(t,e,r)=>{"use strict";var n,o=function(){return void 0===n&&(n=Boolean(window&&document&&document.all&&!window.atob)),n},s=function(){var t={};return function(e){if(void 0===t[e]){var r=document.querySelector(e);if(window.HTMLIFrameElement&&r instanceof window.HTMLIFrameElement)try{r=r.contentDocument.head}catch(t){r=null}t[e]=r}return t[e]}}(),i=[];function a(t){for(var e=-1,r=0;r<i.length;r++)if(i[r].identifier===t){e=r;break}return e}function c(t,e){for(var r={},n=[],o=0;o<t.length;o++){var s=t[o],c=e.base?s[0]+e.base:s[0],u=r[c]||0,l="".concat(c," ").concat(u);r[c]=u+1;var d=a(l),p={css:s[1],media:s[2],sourceMap:s[3]};-1!==d?(i[d].references++,i[d].updater(p)):i.push({identifier:l,updater:b(p,e),references:1}),n.push(l)}return n}function u(t){var e=document.createElement("style"),n=t.attributes||{};if(void 0===n.nonce){var o=r.nc;o&&(n.nonce=o)}if(Object.keys(n).forEach((function(t){e.setAttribute(t,n[t])})),"function"==typeof t.insert)t.insert(e);else{var i=s(t.insert||"head");if(!i)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");i.appendChild(e)}return e}var l,d=(l=[],function(t,e){return l[t]=e,l.filter(Boolean).join("\n")});function p(t,e,r,n){var o=r?"":n.media?"@media ".concat(n.media," {").concat(n.css,"}"):n.css;if(t.styleSheet)t.styleSheet.cssText=d(e,o);else{var s=document.createTextNode(o),i=t.childNodes;i[e]&&t.removeChild(i[e]),i.length?t.insertBefore(s,i[e]):t.appendChild(s)}}function f(t,e,r){var n=r.css,o=r.media,s=r.sourceMap;if(o?t.setAttribute("media",o):t.removeAttribute("media"),s&&"undefined"!=typeof btoa&&(n+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(s))))," */")),t.styleSheet)t.styleSheet.cssText=n;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(n))}}var v=null,m=0;function b(t,e){var r,n,o;if(e.singleton){var s=m++;r=v||(v=u(e)),n=p.bind(null,r,s,!1),o=p.bind(null,r,s,!0)}else r=u(e),n=f.bind(null,r,e),o=function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(r)};return n(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;n(t=e)}else o()}}t.exports=function(t,e){(e=e||{}).singleton||"boolean"==typeof e.singleton||(e.singleton=o());var r=c(t=t||[],e);return function(t){if(t=t||[],"[object Array]"===Object.prototype.toString.call(t)){for(var n=0;n<r.length;n++){var o=a(r[n]);i[o].references--}for(var s=c(t,e),u=0;u<r.length;u++){var l=a(r[u]);0===i[l].references&&(i[l].updater(),i.splice(l,1))}r=s}}}},39663:(t,e,r)=>{"use strict";r.r(e),r.d(e,{default:()=>l});var n=r(74865),o=r.n(n);const s={components:{PickupPointsTable:function(){return r.e(9559).then(r.bind(r,49559))},DropOffPointsTable:function(){return r.e(8937).then(r.bind(r,18937))},PriceVariationsTable:function(){return r.e(9410).then(r.bind(r,29410))},TripsTable:function(){return r.e(1785).then(r.bind(r,11785))}},props:{route:{type:Object,required:!0}},computed:{loading:function(){return this.$store.getters.loading}},watch:{loading:function(t){t?(o().start(),o().set(.1)):o().done()}}};var i=r(93379),a=r.n(i),c=r(2973),u={insert:"head",singleton:!1};a()(c.Z,u);c.Z.locals;const l=(0,r(51900).Z)(s,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"mx-2 mx-md-3 mt-2"},[r("div",{staticClass:"card"},[r("div",{staticClass:"card-body"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12"},[r("h4",{staticClass:"font-weight-bold mb-3"},[t._v("Route Details")]),t._v(" "),r("table",{staticClass:"table table-hover table-bordered table-md"},[r("tbody",[r("tr",[r("td",[t._v("Bus Name")]),t._v(" "),r("th",[t._v(t._s(t.route.bus.bus_name)+" - "+t._s(t.route.bus.bus_reg_no))])]),t._v(" "),r("tr",[r("td",[t._v("Pickup Point")]),t._v(" "),r("th",[t._v(t._s(t.route.board_point))])]),t._v(" "),r("tr",[r("td",[t._v("Pickup Time")]),t._v(" "),r("th",[t._v(t._s(t.route.board_time))])]),t._v(" "),r("tr",[r("td",[t._v("Drop Off Point")]),t._v(" "),r("th",[t._v(t._s(t.route.drop_point))])]),t._v(" "),r("tr",[r("td",[t._v("Drop Off Time")]),t._v(" "),r("th",[t._v(t._s(t.route.drop_time))])]),t._v(" "),r("tr",[r("td",[t._v("Status")]),t._v(" "),r("th",[r("span",{class:"badge py-1 px-2 badge-outline-"+(t.route.status?"success":"danger")},[t._v("\n                    "+t._s(t.route.status?"Active":"Inactive")+"\n                  ")])])]),t._v(" "),r("tr",[r("td",[t._v("Fare")]),t._v(" "),r("th",t._l(t.route.seatClassesFare,(function(e){return r("span",{key:e.id,staticClass:"badge py-1 px-2 badge-success mr-1"},[t._v("\n                    "+t._s(e.name)+" - "+t._s(e.currencyCode)+t._s(e.fare)+"\n                  ")])})),0)]),t._v(" "),r("tr",[r("td",[t._v("Created At")]),t._v(" "),r("th",[t._v(t._s(t.route.created_at))])]),t._v(" "),r("tr",[r("td",[t._v("Updated At")]),t._v(" "),r("th",[t._v(t._s(t.route.updated_at))])])])])])]),t._v(" "),r("div",{staticClass:"row mt-3"},[r("div",{staticClass:"col-md-6"},[r("h4",{staticClass:"mb-3 font-weight-bold"},[t._v("Price Variations")]),t._v(" "),r("div",{staticClass:"mt-2"},[r("price-variations-table",{attrs:{smallTable:!0,route_id:t.route.id}})],1)]),t._v(" "),r("div",{staticClass:"col-md-6"},[r("h4",{staticClass:"mb-3 font-weight-bold"},[t._v("Trips")]),t._v(" "),r("div",{staticClass:"mt-2"},[r("trips-table",{attrs:{route_id:t.route.id}})],1)])]),t._v(" "),r("div",{staticClass:"row mt-5"},[r("div",{staticClass:"col-md-6"},[r("h4",{staticClass:"mb-3 font-weight-bold"},[t._v("Drop Off Points")]),t._v(" "),r("div",{staticClass:"mt-2"},[r("drop-off-points-table",{attrs:{smallTable:!0,defaultCreateRoute:t.route.id}})],1)]),t._v(" "),r("div",{staticClass:"col-md-6"},[r("h4",{staticClass:"mb-3 font-weight-bold"},[t._v("Pickup Up Points")]),t._v(" "),r("div",{staticClass:"mt-2"},[r("pickup-points-table",{attrs:{smallTable:!0,defaultCreateRoute:t.route.id}})],1)])])])])])}),[],!1,null,"ec5690bc",null).exports},51900:(t,e,r)=>{"use strict";function n(t,e,r,n,o,s,i,a){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=r,u._compiled=!0),n&&(u.functional=!0),s&&(u._scopeId="data-v-"+s),i?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},u._ssrRegister=c):o&&(c=a?function(){o.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:o),c)if(u.functional){u._injectStyles=c;var l=u.render;u.render=function(t,e){return c.call(e),l(t,e)}}else{var d=u.beforeCreate;u.beforeCreate=d?[].concat(d,c):[c]}return{exports:t,options:u}}r.d(e,{Z:()=>n})}}]);
//# sourceMappingURL=9663.js.map