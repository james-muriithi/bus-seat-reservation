/*! For license information please see 6160.js.LICENSE.txt */
(self.webpackChunk=self.webpackChunk||[]).push([[6160],{74865:function(t,e,n){var s,a;void 0===(a="function"==typeof(s=function(){var t,e,n={version:"0.2.0"},s=n.settings={minimum:.08,easing:"ease",positionUsing:"",speed:200,trickle:!0,trickleRate:.02,trickleSpeed:800,showSpinner:!0,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};function a(t,e,n){return t<e?e:t>n?n:t}function r(t){return 100*(-1+t)}function i(t,e,n){var a;return(a="translate3d"===s.positionUsing?{transform:"translate3d("+r(t)+"%,0,0)"}:"translate"===s.positionUsing?{transform:"translate("+r(t)+"%,0)"}:{"margin-left":r(t)+"%"}).transition="all "+e+"ms "+n,a}n.configure=function(t){var e,n;for(e in t)void 0!==(n=t[e])&&t.hasOwnProperty(e)&&(s[e]=n);return this},n.status=null,n.set=function(t){var e=n.isStarted();t=a(t,s.minimum,1),n.status=1===t?null:t;var r=n.render(!e),c=r.querySelector(s.barSelector),u=s.speed,d=s.easing;return r.offsetWidth,o((function(e){""===s.positionUsing&&(s.positionUsing=n.getPositioningCSS()),l(c,i(t,u,d)),1===t?(l(r,{transition:"none",opacity:1}),r.offsetWidth,setTimeout((function(){l(r,{transition:"all "+u+"ms linear",opacity:0}),setTimeout((function(){n.remove(),e()}),u)}),u)):setTimeout(e,u)})),this},n.isStarted=function(){return"number"==typeof n.status},n.start=function(){n.status||n.set(0);var t=function(){setTimeout((function(){n.status&&(n.trickle(),t())}),s.trickleSpeed)};return s.trickle&&t(),this},n.done=function(t){return t||n.status?n.inc(.3+.5*Math.random()).set(1):this},n.inc=function(t){var e=n.status;return e?("number"!=typeof t&&(t=(1-e)*a(Math.random()*e,.1,.95)),e=a(e+t,0,.994),n.set(e)):n.start()},n.trickle=function(){return n.inc(Math.random()*s.trickleRate)},t=0,e=0,n.promise=function(s){return s&&"resolved"!==s.state()?(0===e&&n.start(),t++,e++,s.always((function(){0==--e?(t=0,n.done()):n.set((t-e)/t)})),this):this},n.render=function(t){if(n.isRendered())return document.getElementById("nprogress");u(document.documentElement,"nprogress-busy");var e=document.createElement("div");e.id="nprogress",e.innerHTML=s.template;var a,i=e.querySelector(s.barSelector),o=t?"-100":r(n.status||0),c=document.querySelector(s.parent);return l(i,{transition:"all 0 linear",transform:"translate3d("+o+"%,0,0)"}),s.showSpinner||(a=e.querySelector(s.spinnerSelector))&&p(a),c!=document.body&&u(c,"nprogress-custom-parent"),c.appendChild(e),e},n.remove=function(){d(document.documentElement,"nprogress-busy"),d(document.querySelector(s.parent),"nprogress-custom-parent");var t=document.getElementById("nprogress");t&&p(t)},n.isRendered=function(){return!!document.getElementById("nprogress")},n.getPositioningCSS=function(){var t=document.body.style,e="WebkitTransform"in t?"Webkit":"MozTransform"in t?"Moz":"msTransform"in t?"ms":"OTransform"in t?"O":"";return e+"Perspective"in t?"translate3d":e+"Transform"in t?"translate":"margin"};var o=function(){var t=[];function e(){var n=t.shift();n&&n(e)}return function(n){t.push(n),1==t.length&&e()}}(),l=function(){var t=["Webkit","O","Moz","ms"],e={};function n(t){return t.replace(/^-ms-/,"ms-").replace(/-([\da-z])/gi,(function(t,e){return e.toUpperCase()}))}function s(e){var n=document.body.style;if(e in n)return e;for(var s,a=t.length,r=e.charAt(0).toUpperCase()+e.slice(1);a--;)if((s=t[a]+r)in n)return s;return e}function a(t){return t=n(t),e[t]||(e[t]=s(t))}function r(t,e,n){e=a(e),t.style[e]=n}return function(t,e){var n,s,a=arguments;if(2==a.length)for(n in e)void 0!==(s=e[n])&&e.hasOwnProperty(n)&&r(t,n,s);else r(t,a[1],a[2])}}();function c(t,e){return("string"==typeof t?t:f(t)).indexOf(" "+e+" ")>=0}function u(t,e){var n=f(t),s=n+e;c(n,e)||(t.className=s.substring(1))}function d(t,e){var n,s=f(t);c(t,e)&&(n=s.replace(" "+e+" "," "),t.className=n.substring(1,n.length-1))}function f(t){return(" "+(t.className||"")+" ").replace(/\s+/gi," ")}function p(t){t&&t.parentNode&&t.parentNode.removeChild(t)}return n})?s.call(e,n,e,t):s)||(t.exports=a)},26160:(t,e,n)=>{"use strict";n.r(e),n.d(e,{default:()=>l});var s=n(74865),a=n.n(s);const r={components:{CreateSeatClass:function(){return n.e(548).then(n.bind(n,30548))},EditSeatClass:function(){return n.e(9456).then(n.bind(n,99456))},DeleteSeatClass:function(){return n.e(7776).then(n.bind(n,57776))}},data:function(){return{isLoading:!1,seatClasses:[],selectedSeatClass:{}}},computed:{columns:function(){return[{label:"Name",field:"name"},{label:"Color",field:"color",html:!0},{label:"Status",field:"status",html:!0},{label:"Cretaed At",field:"created_at",type:"date",thClass:"text-left",tdClass:"text-left",dateInputFormat:"yyyy-MM-dd HH:mm:ss",dateOutputFormat:"MMM do yyyy HH:mm"},{label:"Actions",field:"actions",html:!0,tdClass:"text-center",thClass:"text-center",sortable:!1}]}},methods:{fetchSeatClasses:function(){var t=this,e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.$store.dispatch("startLoading"),this.isLoading=e,axios.get("/admin/bus-seat-classes").then((function(e){t.seatClasses=e.data.data,t.$store.dispatch("stopLoading"),t.isLoading=!1})).catch((function(e){t.$store.dispatch("stopLoading"),t.isLoading=!1}))},editSeatClass:function(t){this.selectedSeatClass=t,$("#edit-seat-class").modal("show")},deleteSeatClass:function(t){this.selectedSeatClass=t,$("#delete-seat-class").modal("show")}},created:function(){this.fetchSeatClasses()}};var i=n(51900);const o={components:{SeatClassesTable:(0,i.Z)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[t.isLoading?n("div",{staticClass:"mb-5",staticStyle:{height:"300px"}},[n("spinner",{staticClass:"loading_page",attrs:{lg:!0}})],1):n("vue-good-table",{attrs:{columns:t.columns,rows:t.seatClasses,"search-options":{placeholder:"Search this table",enabled:!0},"pagination-options":{enabled:!0,mode:"records",nextLabel:"next",prevLabel:"prev"},"select-options":{enabled:!0,clearSelectionText:"clear",selectOnCheckboxOnly:!0},"sort-options":{enabled:!0,initialSortBy:{field:"created_at",type:"desc"}},styleClass:"vgt-table tableOne table-hover"},scopedSlots:t._u([{key:"table-row",fn:function(e){return["actions"==e.column.field?n("span",[n("a",{staticClass:"pr-1",attrs:{href:"#",title:"Edit"},on:{click:function(n){return n.preventDefault(),t.editSeatClass(Object.assign({},e.row))}}},[n("i",{staticClass:"fa fa-pencil-alt fs-16 text-success"})]),t._v(" "),n("a",{attrs:{title:"Delete",href:"#"},on:{click:function(n){return n.preventDefault(),t.deleteSeatClass(Object.assign({},e.row))}}},[n("i",{staticClass:"fa fa-trash fs-16 text-danger"})])]):"status"==e.column.field?n("span",[n("span",{class:"badge py-1 px-2 badge-outline-"+(e.row.status?"success":"danger")},[t._v("\n          "+t._s(e.row.status?"Active":"Inactive")+"\n        ")])]):"color"==e.column.field?n("span",[n("div",{style:{background:e.row.color,width:"30px",height:"30px",borderRadius:"5px"}})]):t._e()]}}])},[n("div",{attrs:{slot:"selected-row-actions"},slot:"selected-row-actions"},[n("button",{staticClass:"btn btn-danger btn-sm"},[t._v("Delete")])]),t._v(" "),n("div",{staticClass:"mt-2 mb-3",attrs:{slot:"table-actions"},slot:"table-actions"},[n("button",{staticClass:"btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple",attrs:{"data-toggle":"modal","data-target":"#create-seat-class"}},[n("span",{staticClass:"ul-btn__icon"},[n("i",{staticClass:"feather-icon",attrs:{"data-feather":"plus-circle"}})]),t._v(" "),n("span",{staticClass:"ul-btn__text ml-1"},[t._v("Create")])])])]),t._v(" "),n("create-seat-class",{on:{update:function(e){return t.fetchSeatClasses(!1)}}}),t._v(" "),n("edit-seat-class",{attrs:{seatClass:t.selectedSeatClass},on:{update:function(e){return t.fetchSeatClasses(!1)}}}),t._v(" "),n("delete-seat-class",{attrs:{seatClass:t.selectedSeatClass},on:{update:function(e){return t.fetchSeatClasses(!1)}}})],1)}),[],!1,null,null,null).exports},data:function(){return{}},computed:{loading:function(){return this.$store.getters.loading}},watch:{loading:function(t){t?(a().start(),a().set(.1)):a().done()}},methods:{openModal:function(){}}};const l=(0,i.Z)(o,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"mx-2 mx-md-3 mt-2"},[e("seat-classes-table")],1)}),[],!1,null,null,null).exports},51900:(t,e,n)=>{"use strict";function s(t,e,n,s,a,r,i,o){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=n,c._compiled=!0),s&&(c.functional=!0),r&&(c._scopeId="data-v-"+r),i?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),a&&a.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},c._ssrRegister=l):a&&(l=o?function(){a.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:a),l)if(c.functional){c._injectStyles=l;var u=c.render;c.render=function(t,e){return l.call(e),u(t,e)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:c}}n.d(e,{Z:()=>s})}}]);
//# sourceMappingURL=6160.js.map