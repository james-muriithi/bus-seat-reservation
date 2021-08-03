/*! For license information please see 6350.js.LICENSE.txt */
(self.webpackChunk=self.webpackChunk||[]).push([[6350],{4865:function(t,e,n){var o,r;void 0===(r="function"==typeof(o=function(){var t,e,n={version:"0.2.0"},o=n.settings={minimum:.08,easing:"ease",positionUsing:"",speed:200,trickle:!0,trickleRate:.02,trickleSpeed:800,showSpinner:!0,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};function r(t,e,n){return t<e?e:t>n?n:t}function s(t){return 100*(-1+t)}function i(t,e,n){var r;return(r="translate3d"===o.positionUsing?{transform:"translate3d("+s(t)+"%,0,0)"}:"translate"===o.positionUsing?{transform:"translate("+s(t)+"%,0)"}:{"margin-left":s(t)+"%"}).transition="all "+e+"ms "+n,r}n.configure=function(t){var e,n;for(e in t)void 0!==(n=t[e])&&t.hasOwnProperty(e)&&(o[e]=n);return this},n.status=null,n.set=function(t){var e=n.isStarted();t=r(t,o.minimum,1),n.status=1===t?null:t;var s=n.render(!e),c=s.querySelector(o.barSelector),f=o.speed,u=o.easing;return s.offsetWidth,a((function(e){""===o.positionUsing&&(o.positionUsing=n.getPositioningCSS()),l(c,i(t,f,u)),1===t?(l(s,{transition:"none",opacity:1}),s.offsetWidth,setTimeout((function(){l(s,{transition:"all "+f+"ms linear",opacity:0}),setTimeout((function(){n.remove(),e()}),f)}),f)):setTimeout(e,f)})),this},n.isStarted=function(){return"number"==typeof n.status},n.start=function(){n.status||n.set(0);var t=function(){setTimeout((function(){n.status&&(n.trickle(),t())}),o.trickleSpeed)};return o.trickle&&t(),this},n.done=function(t){return t||n.status?n.inc(.3+.5*Math.random()).set(1):this},n.inc=function(t){var e=n.status;return e?("number"!=typeof t&&(t=(1-e)*r(Math.random()*e,.1,.95)),e=r(e+t,0,.994),n.set(e)):n.start()},n.trickle=function(){return n.inc(Math.random()*o.trickleRate)},t=0,e=0,n.promise=function(o){return o&&"resolved"!==o.state()?(0===e&&n.start(),t++,e++,o.always((function(){0==--e?(t=0,n.done()):n.set((t-e)/t)})),this):this},n.render=function(t){if(n.isRendered())return document.getElementById("nprogress");f(document.documentElement,"nprogress-busy");var e=document.createElement("div");e.id="nprogress",e.innerHTML=o.template;var r,i=e.querySelector(o.barSelector),a=t?"-100":s(n.status||0),c=document.querySelector(o.parent);return l(i,{transition:"all 0 linear",transform:"translate3d("+a+"%,0,0)"}),o.showSpinner||(r=e.querySelector(o.spinnerSelector))&&p(r),c!=document.body&&f(c,"nprogress-custom-parent"),c.appendChild(e),e},n.remove=function(){u(document.documentElement,"nprogress-busy"),u(document.querySelector(o.parent),"nprogress-custom-parent");var t=document.getElementById("nprogress");t&&p(t)},n.isRendered=function(){return!!document.getElementById("nprogress")},n.getPositioningCSS=function(){var t=document.body.style,e="WebkitTransform"in t?"Webkit":"MozTransform"in t?"Moz":"msTransform"in t?"ms":"OTransform"in t?"O":"";return e+"Perspective"in t?"translate3d":e+"Transform"in t?"translate":"margin"};var a=function(){var t=[];function e(){var n=t.shift();n&&n(e)}return function(n){t.push(n),1==t.length&&e()}}(),l=function(){var t=["Webkit","O","Moz","ms"],e={};function n(t){return t.replace(/^-ms-/,"ms-").replace(/-([\da-z])/gi,(function(t,e){return e.toUpperCase()}))}function o(e){var n=document.body.style;if(e in n)return e;for(var o,r=t.length,s=e.charAt(0).toUpperCase()+e.slice(1);r--;)if((o=t[r]+s)in n)return o;return e}function r(t){return t=n(t),e[t]||(e[t]=o(t))}function s(t,e,n){e=r(e),t.style[e]=n}return function(t,e){var n,o,r=arguments;if(2==r.length)for(n in e)void 0!==(o=e[n])&&e.hasOwnProperty(n)&&s(t,n,o);else s(t,r[1],r[2])}}();function c(t,e){return("string"==typeof t?t:d(t)).indexOf(" "+e+" ")>=0}function f(t,e){var n=d(t),o=n+e;c(n,e)||(t.className=o.substring(1))}function u(t,e){var n,o=d(t);c(t,e)&&(n=o.replace(" "+e+" "," "),t.className=n.substring(1,n.length-1))}function d(t){return(" "+(t.className||"")+" ").replace(/\s+/gi," ")}function p(t){t&&t.parentNode&&t.parentNode.removeChild(t)}return n})?o.call(e,n,e,t):o)||(t.exports=r)},6350:(t,e,n)=>{"use strict";n.r(e),n.d(e,{default:()=>i});var o=n(4865),r=n.n(o);const s={components:{DropOffPointsTable:n(8937).Z},data:function(){return{}},computed:{loading:function(){return this.$store.getters.loading}},watch:{loading:function(t){t?(r().start(),r().set(.1)):r().done()}},methods:{openModal:function(){}}};const i=(0,n(1900).Z)(s,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"mx-2 mx-md-3 mt-2"},[e("drop-off-points-table")],1)}),[],!1,null,null,null).exports},8937:(t,e,n)=>{"use strict";n.d(e,{Z:()=>r});const o={components:{CreateDropOffPoint:function(){return n.e(8231).then(n.bind(n,8231))},EditDropOffPoint:function(){return n.e(642).then(n.bind(n,642))},DeleteDropOffPoint:function(){return n.e(2824).then(n.bind(n,2824))}},props:{smallTable:{type:Boolean},defaultCreateRoute:{default:""}},data:function(){return{isLoading:!1,dropoffPoints:[],selectedDropoffPoint:{}}},computed:{columns:function(){return this.smallTable?[{label:"Dropoff Point",field:"drop_off_point"},{label:"Dropoff Time",field:"drop_time"},{label:"Status",field:"status",html:!0},{label:"Actions",field:"actions",html:!0,tdClass:"text-center",thClass:"text-center",sortable:!1}]:[{label:"Route",field:"route"},{label:"Dropoff Point",field:"drop_off_point"},{label:"Dropoff Time",field:"drop_time"},{label:"Address",field:"address"},{label:"Landmark",field:"landmark"},{label:"Status",field:"status",html:!0},{label:"Cretaed At",field:"created_at",type:"date",thClass:"text-left",tdClass:"text-left",dateInputFormat:"yyyy-MM-dd HH:mm:ss",dateOutputFormat:"MMM do yyyy HH:mm"},{label:"Actions",field:"actions",html:!0,tdClass:"text-center",thClass:"text-center",sortable:!1}]}},methods:{fetchDropoffPoints:function(){var t=this,e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.$store.dispatch("startLoading"),this.isLoading=e;var n="/admin/drop-off-points";this.defaultCreateRoute&&(n+="?route=".concat(this.defaultCreateRoute)),axios.get(n).then((function(e){t.dropoffPoints=e.data.data,t.$store.dispatch("stopLoading"),t.isLoading=!1})).catch((function(e){t.$store.dispatch("stopLoading"),t.isLoading=!1}))},editDropoffPoint:function(t){this.selectedDropoffPoint=t,$("#edit-dropoff-point").modal("show")},deleteDropoffPoint:function(t){this.selectedDropoffPoint=t,$("#delete-dropoff-point").modal("show")}},created:function(){this.fetchDropoffPoints()}};const r=(0,n(1900).Z)(o,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[t.isLoading?n("div",{staticClass:"mb-5",staticStyle:{height:"300px"}},[n("spinner",{staticClass:"loading_page",attrs:{lg:!0}})],1):n("vue-good-table",{attrs:{columns:t.columns,rows:t.dropoffPoints,"search-options":{placeholder:"Search this table",enabled:!0},"pagination-options":{enabled:!0,mode:"records",nextLabel:"next",prevLabel:"prev"},"select-options":{enabled:!0,clearSelectionText:"clear",selectOnCheckboxOnly:!0},"sort-options":{enabled:!0},styleClass:"vgt-table tableOne table-hover"},scopedSlots:t._u([{key:"table-row",fn:function(e){return["actions"==e.column.field?n("span",[n("a",{staticClass:"pr-1",attrs:{href:"#",title:"Edit"},on:{click:function(n){return n.preventDefault(),t.editDropoffPoint(Object.assign({},e.row))}}},[n("i",{staticClass:"fa fa-pencil-alt fs-16 text-success"})]),t._v(" "),n("a",{attrs:{title:"Delete",href:"#"},on:{click:function(n){return n.preventDefault(),t.deleteDropoffPoint(Object.assign({},e.row))}}},[n("i",{staticClass:"fa fa-trash fs-16 text-danger"})])]):"route"==e.column.field?n("span",[n("a",{attrs:{href:"/admin/routes/"+e.row.route.id}},[t._v(t._s(e.row.route.route_name))])]):"status"==e.column.field?n("span",[n("span",{class:"badge py-1 px-2 badge-outline-"+(e.row.status?"success":"danger")},[t._v("\n          "+t._s(e.row.status?"Active":"Inactive")+"\n        ")])]):t._e()]}}])},[n("div",{attrs:{slot:"selected-row-actions"},slot:"selected-row-actions"},[n("button",{staticClass:"btn btn-danger btn-sm"},[t._v("Delete")])]),t._v(" "),n("div",{staticClass:"mt-2 mb-3",attrs:{slot:"table-actions"},slot:"table-actions"},[n("button",{staticClass:"btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple",attrs:{"data-toggle":"modal","data-target":"#create-dropoff-point"}},[n("span",{staticClass:"ul-btn__icon"},[n("i",{staticClass:"feather-icon",attrs:{"data-feather":"plus-circle"}})]),t._v(" "),n("span",{staticClass:"ul-btn__text ml-1"},[t._v("Create")])])])]),t._v(" "),n("create-drop-off-point",{attrs:{"default-route":t.defaultCreateRoute},on:{update:function(e){return t.fetchDropoffPoints(!1)}}}),t._v(" "),n("edit-drop-off-point",{attrs:{dropOffPoint:t.selectedDropoffPoint},on:{update:function(e){return t.fetchDropoffPoints(!1)}}}),t._v(" "),n("delete-drop-off-point",{attrs:{dropOffPoint:t.selectedDropoffPoint},on:{update:function(e){return t.fetchDropoffPoints(!1)}}})],1)}),[],!1,null,null,null).exports},1900:(t,e,n)=>{"use strict";function o(t,e,n,o,r,s,i,a){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=n,c._compiled=!0),o&&(c.functional=!0),s&&(c._scopeId="data-v-"+s),i?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},c._ssrRegister=l):r&&(l=a?function(){r.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:r),l)if(c.functional){c._injectStyles=l;var f=c.render;c.render=function(t,e){return l.call(e),f(t,e)}}else{var u=c.beforeCreate;c.beforeCreate=u?[].concat(u,l):[l]}return{exports:t,options:c}}n.d(e,{Z:()=>o})}}]);
//# sourceMappingURL=6350.js.map