/*! For license information please see 8434.js.LICENSE.txt */
(self.webpackChunk=self.webpackChunk||[]).push([[8434],{4167:(t,e,n)=>{"use strict";n.d(e,{Z:()=>i});var o=n(4015),r=n.n(o),s=n(3645),a=n.n(s)()(r());a.push([t.id,"th[data-v-428885a0]{font-size:14px;font-weight:700}.image-cover[data-v-428885a0]{border-radius:8px!important;-o-object-fit:cover;object-fit:cover}","",{version:3,sources:["webpack://./resources/js/components/routes/ViewRoute.vue"],names:[],mappings:"AAuHA,oBACA,cAAA,CACA,eACA,CACA,8BACA,2BAAA,CACA,mBAAA,CAAA,gBACA",sourcesContent:['<template>\n  <div class="mx-2 mx-md-3 mt-2">\n    <div class="card">\n      <div class="card-body">\n        <div class="row">\n          <div class="col-md-12">\n            <h4 class="font-weight-bold mb-3">Route Details</h4>\n\n            <table class="table table-hover table-bordered table-md">\n              <tbody>\n                <tr>\n                  <td>Bus Name</td>\n                  <th>{{ route.bus.bus_name }} - {{ route.bus.bus_reg_no }}</th>\n                </tr>\n                <tr>\n                  <td>Pickup Point</td>\n                  <th>{{ route.board_point }}</th>\n                </tr>\n                <tr>\n                  <td>Pickup Time</td>\n                  <th>{{ route.board_time }}</th>\n                </tr>\n                <tr>\n                  <td>Drop Off Point</td>\n                  <th>{{ route.drop_point }}</th>\n                </tr>\n                <tr>\n                  <td>Drop Off Time</td>\n                  <th>{{ route.drop_time }}</th>\n                </tr>\n                <tr>\n                  <td>Status</td>\n                  <th>\n                    <span\n                      :class="`badge py-1 px-2 badge-outline-${\n                        route.status ? \'success\' : \'danger\'\n                      }`"\n                    >\n                      {{ route.status ? "Active" : "Inactive" }}\n                    </span>\n                  </th>\n                </tr>\n\n                <tr>\n                  <td>Fare</td>\n                  <th>\n                    <span\n                      class="badge py-1 px-2 badge-success mr-1"\n                      v-for="seatClass in route.seatClassesFare"\n                      :key="seatClass.id"\n                    >\n                      {{ seatClass.name }} - {{ seatClass.currencyCode\n                      }}{{ seatClass.fare }}\n                    </span>\n                  </th>\n                </tr>\n                <tr>\n                  <td>Created At</td>\n                  <th>{{ route.created_at }}</th>\n                </tr>\n                <tr>\n                  <td>Updated At</td>\n                  <th>{{ route.updated_at }}</th>\n                </tr>\n              </tbody>\n            </table>\n          </div>\n        </div>\n\n        <div class="row mt-3">\n          <div class="col-md-6">\n            <h4 class="mb-3 font-weight-bold">Drop Off Points</h4>\n            <div class="mt-2">\n              <drop-off-points-table :smallTable="true" :defaultCreateRoute="route.id"></drop-off-points-table>\n            </div>\n          </div>\n          <div class="col-md-6">\n            <h4 class="mb-3 font-weight-bold">Pickup Up Points</h4>\n            <div class="mt-2">\n              <pickup-points-table :smallTable="true" :defaultCreateRoute="route.id"></pickup-points-table>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</template>\n\n<script>\nimport Nprogress from "nprogress";\nimport PickupPointsTable from "../pickup/Table.vue";\nimport DropOffPointsTable from "../drop-off-point/DropOffPointsTable.vue";\n\nexport default {\n  components: { PickupPointsTable, DropOffPointsTable },\n  props: {\n    route: {\n      type: Object,\n      required: true,\n    },\n  },\n  computed: {\n    loading() {\n      return this.$store.getters.loading;\n    },\n  },\n  watch: {\n    loading(newValue) {\n      if (newValue) {\n        Nprogress.start();\n        Nprogress.set(0.1);\n      } else {\n        Nprogress.done();\n      }\n    },\n  },\n};\n<\/script>\n<style scoped>\nth {\n  font-size: 14px;\n  font-weight: 700;\n}\n.image-cover {\n  border-radius: 8px !important;\n  object-fit: cover;\n}\n</style>\n'],sourceRoot:""}]);const i=a},3645:t=>{"use strict";t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n=t(e);return e[2]?"@media ".concat(e[2]," {").concat(n,"}"):n})).join("")},e.i=function(t,n,o){"string"==typeof t&&(t=[[null,t,""]]);var r={};if(o)for(var s=0;s<this.length;s++){var a=this[s][0];null!=a&&(r[a]=!0)}for(var i=0;i<t.length;i++){var l=[].concat(t[i]);o&&r[l[0]]||(n&&(l[2]?l[2]="".concat(n," and ").concat(l[2]):l[2]=n),e.push(l))}},e}},4015:t=>{"use strict";function e(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=t&&("undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"]);if(null==n)return;var o,r,s=[],a=!0,i=!1;try{for(n=n.call(t);!(a=(o=n.next()).done)&&(s.push(o.value),!e||s.length!==e);a=!0);}catch(t){i=!0,r=t}finally{try{a||null==n.return||n.return()}finally{if(i)throw r}}return s}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return n(t,e);var o=Object.prototype.toString.call(t).slice(8,-1);"Object"===o&&t.constructor&&(o=t.constructor.name);if("Map"===o||"Set"===o)return Array.from(t);if("Arguments"===o||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(o))return n(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function n(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,o=new Array(e);n<e;n++)o[n]=t[n];return o}t.exports=function(t){var n=e(t,4),o=n[1],r=n[3];if(!r)return o;if("function"==typeof btoa){var s=btoa(unescape(encodeURIComponent(JSON.stringify(r)))),a="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(s),i="/*# ".concat(a," */"),l=r.sources.map((function(t){return"/*# sourceURL=".concat(r.sourceRoot||"").concat(t," */")}));return[o].concat(l).concat([i]).join("\n")}return[o].join("\n")}},4865:function(t,e,n){var o,r;void 0===(r="function"==typeof(o=function(){var t,e,n={version:"0.2.0"},o=n.settings={minimum:.08,easing:"ease",positionUsing:"",speed:200,trickle:!0,trickleRate:.02,trickleSpeed:800,showSpinner:!0,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};function r(t,e,n){return t<e?e:t>n?n:t}function s(t){return 100*(-1+t)}function a(t,e,n){var r;return(r="translate3d"===o.positionUsing?{transform:"translate3d("+s(t)+"%,0,0)"}:"translate"===o.positionUsing?{transform:"translate("+s(t)+"%,0)"}:{"margin-left":s(t)+"%"}).transition="all "+e+"ms "+n,r}n.configure=function(t){var e,n;for(e in t)void 0!==(n=t[e])&&t.hasOwnProperty(e)&&(o[e]=n);return this},n.status=null,n.set=function(t){var e=n.isStarted();t=r(t,o.minimum,1),n.status=1===t?null:t;var s=n.render(!e),c=s.querySelector(o.barSelector),u=o.speed,d=o.easing;return s.offsetWidth,i((function(e){""===o.positionUsing&&(o.positionUsing=n.getPositioningCSS()),l(c,a(t,u,d)),1===t?(l(s,{transition:"none",opacity:1}),s.offsetWidth,setTimeout((function(){l(s,{transition:"all "+u+"ms linear",opacity:0}),setTimeout((function(){n.remove(),e()}),u)}),u)):setTimeout(e,u)})),this},n.isStarted=function(){return"number"==typeof n.status},n.start=function(){n.status||n.set(0);var t=function(){setTimeout((function(){n.status&&(n.trickle(),t())}),o.trickleSpeed)};return o.trickle&&t(),this},n.done=function(t){return t||n.status?n.inc(.3+.5*Math.random()).set(1):this},n.inc=function(t){var e=n.status;return e?("number"!=typeof t&&(t=(1-e)*r(Math.random()*e,.1,.95)),e=r(e+t,0,.994),n.set(e)):n.start()},n.trickle=function(){return n.inc(Math.random()*o.trickleRate)},t=0,e=0,n.promise=function(o){return o&&"resolved"!==o.state()?(0===e&&n.start(),t++,e++,o.always((function(){0==--e?(t=0,n.done()):n.set((t-e)/t)})),this):this},n.render=function(t){if(n.isRendered())return document.getElementById("nprogress");u(document.documentElement,"nprogress-busy");var e=document.createElement("div");e.id="nprogress",e.innerHTML=o.template;var r,a=e.querySelector(o.barSelector),i=t?"-100":s(n.status||0),c=document.querySelector(o.parent);return l(a,{transition:"all 0 linear",transform:"translate3d("+i+"%,0,0)"}),o.showSpinner||(r=e.querySelector(o.spinnerSelector))&&f(r),c!=document.body&&u(c,"nprogress-custom-parent"),c.appendChild(e),e},n.remove=function(){d(document.documentElement,"nprogress-busy"),d(document.querySelector(o.parent),"nprogress-custom-parent");var t=document.getElementById("nprogress");t&&f(t)},n.isRendered=function(){return!!document.getElementById("nprogress")},n.getPositioningCSS=function(){var t=document.body.style,e="WebkitTransform"in t?"Webkit":"MozTransform"in t?"Moz":"msTransform"in t?"ms":"OTransform"in t?"O":"";return e+"Perspective"in t?"translate3d":e+"Transform"in t?"translate":"margin"};var i=function(){var t=[];function e(){var n=t.shift();n&&n(e)}return function(n){t.push(n),1==t.length&&e()}}(),l=function(){var t=["Webkit","O","Moz","ms"],e={};function n(t){return t.replace(/^-ms-/,"ms-").replace(/-([\da-z])/gi,(function(t,e){return e.toUpperCase()}))}function o(e){var n=document.body.style;if(e in n)return e;for(var o,r=t.length,s=e.charAt(0).toUpperCase()+e.slice(1);r--;)if((o=t[r]+s)in n)return o;return e}function r(t){return t=n(t),e[t]||(e[t]=o(t))}function s(t,e,n){e=r(e),t.style[e]=n}return function(t,e){var n,o,r=arguments;if(2==r.length)for(n in e)void 0!==(o=e[n])&&e.hasOwnProperty(n)&&s(t,n,o);else s(t,r[1],r[2])}}();function c(t,e){return("string"==typeof t?t:p(t)).indexOf(" "+e+" ")>=0}function u(t,e){var n=p(t),o=n+e;c(n,e)||(t.className=o.substring(1))}function d(t,e){var n,o=p(t);c(t,e)&&(n=o.replace(" "+e+" "," "),t.className=n.substring(1,n.length-1))}function p(t){return(" "+(t.className||"")+" ").replace(/\s+/gi," ")}function f(t){t&&t.parentNode&&t.parentNode.removeChild(t)}return n})?o.call(e,n,e,t):o)||(t.exports=r)},3379:(t,e,n)=>{"use strict";var o,r=function(){return void 0===o&&(o=Boolean(window&&document&&document.all&&!window.atob)),o},s=function(){var t={};return function(e){if(void 0===t[e]){var n=document.querySelector(e);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(t){n=null}t[e]=n}return t[e]}}(),a=[];function i(t){for(var e=-1,n=0;n<a.length;n++)if(a[n].identifier===t){e=n;break}return e}function l(t,e){for(var n={},o=[],r=0;r<t.length;r++){var s=t[r],l=e.base?s[0]+e.base:s[0],c=n[l]||0,u="".concat(l," ").concat(c);n[l]=c+1;var d=i(u),p={css:s[1],media:s[2],sourceMap:s[3]};-1!==d?(a[d].references++,a[d].updater(p)):a.push({identifier:u,updater:b(p,e),references:1}),o.push(u)}return o}function c(t){var e=document.createElement("style"),o=t.attributes||{};if(void 0===o.nonce){var r=n.nc;r&&(o.nonce=r)}if(Object.keys(o).forEach((function(t){e.setAttribute(t,o[t])})),"function"==typeof t.insert)t.insert(e);else{var a=s(t.insert||"head");if(!a)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");a.appendChild(e)}return e}var u,d=(u=[],function(t,e){return u[t]=e,u.filter(Boolean).join("\n")});function p(t,e,n,o){var r=n?"":o.media?"@media ".concat(o.media," {").concat(o.css,"}"):o.css;if(t.styleSheet)t.styleSheet.cssText=d(e,r);else{var s=document.createTextNode(r),a=t.childNodes;a[e]&&t.removeChild(a[e]),a.length?t.insertBefore(s,a[e]):t.appendChild(s)}}function f(t,e,n){var o=n.css,r=n.media,s=n.sourceMap;if(r?t.setAttribute("media",r):t.removeAttribute("media"),s&&"undefined"!=typeof btoa&&(o+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(s))))," */")),t.styleSheet)t.styleSheet.cssText=o;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(o))}}var m=null,v=0;function b(t,e){var n,o,r;if(e.singleton){var s=v++;n=m||(m=c(e)),o=p.bind(null,n,s,!1),r=p.bind(null,n,s,!0)}else n=c(e),o=f.bind(null,n,e),r=function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(n)};return o(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;o(t=e)}else r()}}t.exports=function(t,e){(e=e||{}).singleton||"boolean"==typeof e.singleton||(e.singleton=r());var n=l(t=t||[],e);return function(t){if(t=t||[],"[object Array]"===Object.prototype.toString.call(t)){for(var o=0;o<n.length;o++){var r=i(n[o]);a[r].references--}for(var s=l(t,e),c=0;c<n.length;c++){var u=i(n[c]);0===a[u].references&&(a[u].updater(),a.splice(u,1))}n=s}}}},8937:(t,e,n)=>{"use strict";n.d(e,{Z:()=>r});const o={components:{CreateDropOffPoint:function(){return n.e(8231).then(n.bind(n,8231))},EditDropOffPoint:function(){return n.e(642).then(n.bind(n,642))},DeleteDropOffPoint:function(){return n.e(2824).then(n.bind(n,2824))}},props:{smallTable:{type:Boolean},defaultCreateRoute:{default:""}},data:function(){return{isLoading:!1,dropoffPoints:[],selectedDropoffPoint:{}}},computed:{columns:function(){return this.smallTable?[{label:"Dropoff Point",field:"drop_off_point"},{label:"Dropoff Time",field:"drop_time"},{label:"Status",field:"status",html:!0},{label:"Actions",field:"actions",html:!0,tdClass:"text-center",thClass:"text-center",sortable:!1}]:[{label:"Route",field:"route"},{label:"Dropoff Point",field:"drop_off_point"},{label:"Dropoff Time",field:"drop_time"},{label:"Address",field:"address"},{label:"Landmark",field:"landmark"},{label:"Status",field:"status",html:!0},{label:"Cretaed At",field:"created_at",type:"date",thClass:"text-left",tdClass:"text-left",dateInputFormat:"yyyy-MM-dd HH:mm:ss",dateOutputFormat:"MMM do yyyy HH:mm"},{label:"Actions",field:"actions",html:!0,tdClass:"text-center",thClass:"text-center",sortable:!1}]}},methods:{fetchDropoffPoints:function(){var t=this,e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.$store.dispatch("startLoading"),this.isLoading=e;var n="/admin/drop-off-points";this.defaultCreateRoute&&(n+="?route=".concat(this.defaultCreateRoute)),axios.get(n).then((function(e){t.dropoffPoints=e.data.data,t.$store.dispatch("stopLoading"),t.isLoading=!1})).catch((function(e){t.$store.dispatch("stopLoading"),t.isLoading=!1}))},editDropoffPoint:function(t){this.selectedDropoffPoint=t,$("#edit-dropoff-point").modal("show")},deleteDropoffPoint:function(t){this.selectedDropoffPoint=t,$("#delete-dropoff-point").modal("show")}},created:function(){this.fetchDropoffPoints()}};const r=(0,n(1900).Z)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[t.isLoading?n("div",{staticClass:"mb-5",staticStyle:{height:"300px"}},[n("spinner",{staticClass:"loading_page",attrs:{lg:!0}})],1):n("vue-good-table",{attrs:{columns:t.columns,rows:t.dropoffPoints,"search-options":{placeholder:"Search this table",enabled:!0},"pagination-options":{enabled:!0,mode:"records",nextLabel:"next",prevLabel:"prev"},"select-options":{enabled:!0,clearSelectionText:"clear",selectOnCheckboxOnly:!0},"sort-options":{enabled:!0},styleClass:"vgt-table tableOne table-hover"},scopedSlots:t._u([{key:"table-row",fn:function(e){return["actions"==e.column.field?n("span",[n("a",{staticClass:"pr-1",attrs:{href:"#",title:"Edit"},on:{click:function(n){return n.preventDefault(),t.editDropoffPoint(Object.assign({},e.row))}}},[n("i",{staticClass:"fa fa-pencil-alt fs-16 text-success"})]),t._v(" "),n("a",{attrs:{title:"Delete",href:"#"},on:{click:function(n){return n.preventDefault(),t.deleteDropoffPoint(Object.assign({},e.row))}}},[n("i",{staticClass:"fa fa-trash fs-16 text-danger"})])]):"route"==e.column.field?n("span",[n("a",{attrs:{href:"/admin/routes/"+e.row.route.id}},[t._v(t._s(e.row.route.route_name))])]):"status"==e.column.field?n("span",[n("span",{class:"badge py-1 px-2 badge-outline-"+(e.row.status?"success":"danger")},[t._v("\n          "+t._s(e.row.status?"Active":"Inactive")+"\n        ")])]):t._e()]}}])},[n("div",{attrs:{slot:"selected-row-actions"},slot:"selected-row-actions"},[n("button",{staticClass:"btn btn-danger btn-sm"},[t._v("Delete")])]),t._v(" "),n("div",{staticClass:"mt-2 mb-3",attrs:{slot:"table-actions"},slot:"table-actions"},[n("button",{staticClass:"btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple",attrs:{"data-toggle":"modal","data-target":"#create-dropoff-point"}},[n("span",{staticClass:"ul-btn__icon"},[n("i",{staticClass:"feather-icon",attrs:{"data-feather":"plus-circle"}})]),t._v(" "),n("span",{staticClass:"ul-btn__text ml-1"},[t._v("Create")])])])]),t._v(" "),n("create-drop-off-point",{attrs:{"default-route":t.defaultCreateRoute},on:{update:function(e){return t.fetchDropoffPoints(!1)}}}),t._v(" "),n("edit-drop-off-point",{attrs:{dropOffPoint:t.selectedDropoffPoint},on:{update:function(e){return t.fetchDropoffPoints(!1)}}}),t._v(" "),n("delete-drop-off-point",{attrs:{dropOffPoint:t.selectedDropoffPoint},on:{update:function(e){return t.fetchDropoffPoints(!1)}}})],1)}),[],!1,null,null,null).exports},9559:(t,e,n)=>{"use strict";n.d(e,{Z:()=>r});const o={components:{CreatePickupPoint:function(){return n.e(2794).then(n.bind(n,2794))},EditPickupPoint:function(){return n.e(1553).then(n.bind(n,4597))},DeletePickupPoint:function(){return n.e(8720).then(n.bind(n,8720))}},props:{smallTable:{type:Boolean},defaultCreateRoute:{default:""}},data:function(){return{isLoading:!1,pickupPoints:[],selectedPickupPoint:{}}},computed:{columns:function(){return this.smallTable?[{label:"Pickup Point",field:"pickup_point"},{label:"Pickup Time",field:"pickup_time"},{label:"Status",field:"status",html:!0},{label:"Actions",field:"actions",html:!0,tdClass:"text-center",thClass:"text-center",sortable:!1}]:[{label:"Route",field:"route"},{label:"Pickup Point",field:"pickup_point"},{label:"Pickup Time",field:"pickup_time"},{label:"Address",field:"address"},{label:"Landmark",field:"landmark"},{label:"Status",field:"status",html:!0},{label:"Cretaed At",field:"created_at",type:"date",thClass:"text-left",tdClass:"text-left",dateInputFormat:"yyyy-MM-dd HH:mm:ss",dateOutputFormat:"MMM do yyyy HH:mm"},{label:"Actions",field:"actions",html:!0,tdClass:"text-center",thClass:"text-center",sortable:!1}]}},methods:{fetchPickupPoints:function(){var t=this,e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.$store.dispatch("startLoading"),this.isLoading=e;var n="/admin/pickup-points";this.defaultCreateRoute&&(n+="?route=".concat(this.defaultCreateRoute)),axios.get(n).then((function(e){t.pickupPoints=e.data.data,t.$store.dispatch("stopLoading"),t.isLoading=!1})).catch((function(e){t.$store.dispatch("stopLoading"),t.isLoading=!1}))},editPickupPoint:function(t){this.selectedPickupPoint=t,$("#edit-pickup-point").modal("show")},deletePickupPoint:function(t){this.selectedPickupPoint=t,$("#delete-pickup-point").modal("show")}},created:function(){this.fetchPickupPoints()}};const r=(0,n(1900).Z)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[t.isLoading?n("div",{staticClass:"mb-5",staticStyle:{height:"300px"}},[n("spinner",{staticClass:"loading_page",attrs:{lg:!0}})],1):n("vue-good-table",{attrs:{columns:t.columns,rows:t.pickupPoints,"search-options":{placeholder:"Search this table",enabled:!0},"pagination-options":{enabled:!0,mode:"records",nextLabel:"next",prevLabel:"prev"},"select-options":{enabled:!0,clearSelectionText:"clear",selectOnCheckboxOnly:!0},"sort-options":{enabled:!0},styleClass:"vgt-table tableOne table-hover"},scopedSlots:t._u([{key:"table-row",fn:function(e){return["actions"==e.column.field?n("span",[n("a",{staticClass:"pr-1",attrs:{href:"#",title:"Edit"},on:{click:function(n){return n.preventDefault(),t.editPickupPoint(Object.assign({},e.row))}}},[n("i",{staticClass:"fa fa-pencil-alt fs-16 text-success"})]),t._v(" "),n("a",{attrs:{title:"Delete",href:"#"},on:{click:function(n){return n.preventDefault(),t.deletePickupPoint(Object.assign({},e.row))}}},[n("i",{staticClass:"fa fa-trash fs-16 text-danger"})])]):"route"==e.column.field?n("span",[n("a",{attrs:{href:"/admin/routes/"+e.row.route.id}},[t._v(t._s(e.row.route.route_name))])]):"status"==e.column.field?n("span",[n("span",{class:"badge py-1 px-2 badge-outline-"+(e.row.status?"success":"danger")},[t._v("\n          "+t._s(e.row.status?"Active":"Inactive")+"\n        ")])]):t._e()]}}])},[n("div",{attrs:{slot:"selected-row-actions"},slot:"selected-row-actions"},[n("button",{staticClass:"btn btn-danger btn-sm"},[t._v("Delete")])]),t._v(" "),n("div",{staticClass:"mt-2 mb-3",attrs:{slot:"table-actions"},slot:"table-actions"},[n("button",{staticClass:"btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple",attrs:{"data-toggle":"modal","data-target":"#create-pickup-point"}},[n("span",{staticClass:"ul-btn__icon"},[n("i",{staticClass:"feather-icon",attrs:{"data-feather":"plus-circle"}})]),t._v(" "),n("span",{staticClass:"ul-btn__text ml-1"},[t._v("Create")])])])]),t._v(" "),n("create-pickup-point",{attrs:{"default-route":t.defaultCreateRoute},on:{update:function(e){return t.fetchPickupPoints(!1)}}}),t._v(" "),n("edit-pickup-point",{attrs:{pickupPoint:t.selectedPickupPoint},on:{update:function(e){return t.fetchPickupPoints(!1)}}}),t._v(" "),n("delete-pickup-point",{attrs:{pickupPoint:t.selectedPickupPoint},on:{update:function(e){return t.fetchPickupPoints(!1)}}})],1)}),[],!1,null,null,null).exports},8434:(t,e,n)=>{"use strict";n.r(e),n.d(e,{default:()=>p});var o=n(4865),r=n.n(o),s=n(9559),a=n(8937);const i={components:{PickupPointsTable:s.Z,DropOffPointsTable:a.Z},props:{route:{type:Object,required:!0}},computed:{loading:function(){return this.$store.getters.loading}},watch:{loading:function(t){t?(r().start(),r().set(.1)):r().done()}}};var l=n(3379),c=n.n(l),u=n(4167),d={insert:"head",singleton:!1};c()(u.Z,d);u.Z.locals;const p=(0,n(1900).Z)(i,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"mx-2 mx-md-3 mt-2"},[n("div",{staticClass:"card"},[n("div",{staticClass:"card-body"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-md-12"},[n("h4",{staticClass:"font-weight-bold mb-3"},[t._v("Route Details")]),t._v(" "),n("table",{staticClass:"table table-hover table-bordered table-md"},[n("tbody",[n("tr",[n("td",[t._v("Bus Name")]),t._v(" "),n("th",[t._v(t._s(t.route.bus.bus_name)+" - "+t._s(t.route.bus.bus_reg_no))])]),t._v(" "),n("tr",[n("td",[t._v("Pickup Point")]),t._v(" "),n("th",[t._v(t._s(t.route.board_point))])]),t._v(" "),n("tr",[n("td",[t._v("Pickup Time")]),t._v(" "),n("th",[t._v(t._s(t.route.board_time))])]),t._v(" "),n("tr",[n("td",[t._v("Drop Off Point")]),t._v(" "),n("th",[t._v(t._s(t.route.drop_point))])]),t._v(" "),n("tr",[n("td",[t._v("Drop Off Time")]),t._v(" "),n("th",[t._v(t._s(t.route.drop_time))])]),t._v(" "),n("tr",[n("td",[t._v("Status")]),t._v(" "),n("th",[n("span",{class:"badge py-1 px-2 badge-outline-"+(t.route.status?"success":"danger")},[t._v("\n                    "+t._s(t.route.status?"Active":"Inactive")+"\n                  ")])])]),t._v(" "),n("tr",[n("td",[t._v("Fare")]),t._v(" "),n("th",t._l(t.route.seatClassesFare,(function(e){return n("span",{key:e.id,staticClass:"badge py-1 px-2 badge-success mr-1"},[t._v("\n                    "+t._s(e.name)+" - "+t._s(e.currencyCode)+t._s(e.fare)+"\n                  ")])})),0)]),t._v(" "),n("tr",[n("td",[t._v("Created At")]),t._v(" "),n("th",[t._v(t._s(t.route.created_at))])]),t._v(" "),n("tr",[n("td",[t._v("Updated At")]),t._v(" "),n("th",[t._v(t._s(t.route.updated_at))])])])])])]),t._v(" "),n("div",{staticClass:"row mt-3"},[n("div",{staticClass:"col-md-6"},[n("h4",{staticClass:"mb-3 font-weight-bold"},[t._v("Drop Off Points")]),t._v(" "),n("div",{staticClass:"mt-2"},[n("drop-off-points-table",{attrs:{smallTable:!0,defaultCreateRoute:t.route.id}})],1)]),t._v(" "),n("div",{staticClass:"col-md-6"},[n("h4",{staticClass:"mb-3 font-weight-bold"},[t._v("Pickup Up Points")]),t._v(" "),n("div",{staticClass:"mt-2"},[n("pickup-points-table",{attrs:{smallTable:!0,defaultCreateRoute:t.route.id}})],1)])])])])])}),[],!1,null,"428885a0",null).exports},1900:(t,e,n)=>{"use strict";function o(t,e,n,o,r,s,a,i){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=n,c._compiled=!0),o&&(c.functional=!0),s&&(c._scopeId="data-v-"+s),a?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},c._ssrRegister=l):r&&(l=i?function(){r.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:r),l)if(c.functional){c._injectStyles=l;var u=c.render;c.render=function(t,e){return l.call(e),u(t,e)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:c}}n.d(e,{Z:()=>o})}}]);
//# sourceMappingURL=8434.js.map