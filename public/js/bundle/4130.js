/*! For license information please see 4130.js.LICENSE.txt */
(self.webpackChunk=self.webpackChunk||[]).push([[4130],{74865:function(t,n,e){var r,s;void 0===(s="function"==typeof(r=function(){var t,n,e={version:"0.2.0"},r=e.settings={minimum:.08,easing:"ease",positionUsing:"",speed:200,trickle:!0,trickleRate:.02,trickleSpeed:800,showSpinner:!0,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};function s(t,n,e){return t<n?n:t>e?e:t}function i(t){return 100*(-1+t)}function o(t,n,e){var s;return(s="translate3d"===r.positionUsing?{transform:"translate3d("+i(t)+"%,0,0)"}:"translate"===r.positionUsing?{transform:"translate("+i(t)+"%,0)"}:{"margin-left":i(t)+"%"}).transition="all "+n+"ms "+e,s}e.configure=function(t){var n,e;for(n in t)void 0!==(e=t[n])&&t.hasOwnProperty(n)&&(r[n]=e);return this},e.status=null,e.set=function(t){var n=e.isStarted();t=s(t,r.minimum,1),e.status=1===t?null:t;var i=e.render(!n),c=i.querySelector(r.barSelector),l=r.speed,d=r.easing;return i.offsetWidth,a((function(n){""===r.positionUsing&&(r.positionUsing=e.getPositioningCSS()),u(c,o(t,l,d)),1===t?(u(i,{transition:"none",opacity:1}),i.offsetWidth,setTimeout((function(){u(i,{transition:"all "+l+"ms linear",opacity:0}),setTimeout((function(){e.remove(),n()}),l)}),l)):setTimeout(n,l)})),this},e.isStarted=function(){return"number"==typeof e.status},e.start=function(){e.status||e.set(0);var t=function(){setTimeout((function(){e.status&&(e.trickle(),t())}),r.trickleSpeed)};return r.trickle&&t(),this},e.done=function(t){return t||e.status?e.inc(.3+.5*Math.random()).set(1):this},e.inc=function(t){var n=e.status;return n?("number"!=typeof t&&(t=(1-n)*s(Math.random()*n,.1,.95)),n=s(n+t,0,.994),e.set(n)):e.start()},e.trickle=function(){return e.inc(Math.random()*r.trickleRate)},t=0,n=0,e.promise=function(r){return r&&"resolved"!==r.state()?(0===n&&e.start(),t++,n++,r.always((function(){0==--n?(t=0,e.done()):e.set((t-n)/t)})),this):this},e.render=function(t){if(e.isRendered())return document.getElementById("nprogress");l(document.documentElement,"nprogress-busy");var n=document.createElement("div");n.id="nprogress",n.innerHTML=r.template;var s,o=n.querySelector(r.barSelector),a=t?"-100":i(e.status||0),c=document.querySelector(r.parent);return u(o,{transition:"all 0 linear",transform:"translate3d("+a+"%,0,0)"}),r.showSpinner||(s=n.querySelector(r.spinnerSelector))&&p(s),c!=document.body&&l(c,"nprogress-custom-parent"),c.appendChild(n),n},e.remove=function(){d(document.documentElement,"nprogress-busy"),d(document.querySelector(r.parent),"nprogress-custom-parent");var t=document.getElementById("nprogress");t&&p(t)},e.isRendered=function(){return!!document.getElementById("nprogress")},e.getPositioningCSS=function(){var t=document.body.style,n="WebkitTransform"in t?"Webkit":"MozTransform"in t?"Moz":"msTransform"in t?"ms":"OTransform"in t?"O":"";return n+"Perspective"in t?"translate3d":n+"Transform"in t?"translate":"margin"};var a=function(){var t=[];function n(){var e=t.shift();e&&e(n)}return function(e){t.push(e),1==t.length&&n()}}(),u=function(){var t=["Webkit","O","Moz","ms"],n={};function e(t){return t.replace(/^-ms-/,"ms-").replace(/-([\da-z])/gi,(function(t,n){return n.toUpperCase()}))}function r(n){var e=document.body.style;if(n in e)return n;for(var r,s=t.length,i=n.charAt(0).toUpperCase()+n.slice(1);s--;)if((r=t[s]+i)in e)return r;return n}function s(t){return t=e(t),n[t]||(n[t]=r(t))}function i(t,n,e){n=s(n),t.style[n]=e}return function(t,n){var e,r,s=arguments;if(2==s.length)for(e in n)void 0!==(r=n[e])&&n.hasOwnProperty(e)&&i(t,e,r);else i(t,s[1],s[2])}}();function c(t,n){return("string"==typeof t?t:f(t)).indexOf(" "+n+" ")>=0}function l(t,n){var e=f(t),r=e+n;c(e,n)||(t.className=r.substring(1))}function d(t,n){var e,r=f(t);c(t,n)&&(e=r.replace(" "+n+" "," "),t.className=e.substring(1,e.length-1))}function f(t){return(" "+(t.className||"")+" ").replace(/\s+/gi," ")}function p(t){t&&t.parentNode&&t.parentNode.removeChild(t)}return e})?r.call(n,e,n,t):r)||(t.exports=s)},4130:(t,n,e)=>{"use strict";e.r(n),e.d(n,{default:()=>o});var r=e(74865),s=e.n(r);const i={components:{PassengerTable:function(){return e.e(157).then(e.bind(e,40157))}},computed:{loading:function(){return this.$store.getters.loading}},watch:{loading:function(t){t?(s().start(),s().set(.1)):s().done()}}};const o=(0,e(51900).Z)(i,(function(){var t=this.$createElement,n=this._self._c||t;return n("div",{staticClass:"mx-2 mx-md-3 mt-2"},[n("passenger-table")],1)}),[],!1,null,null,null).exports},51900:(t,n,e)=>{"use strict";function r(t,n,e,r,s,i,o,a){var u,c="function"==typeof t?t.options:t;if(n&&(c.render=n,c.staticRenderFns=e,c._compiled=!0),r&&(c.functional=!0),i&&(c._scopeId="data-v-"+i),o?(u=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),s&&s.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(o)},c._ssrRegister=u):s&&(u=a?function(){s.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:s),u)if(c.functional){c._injectStyles=u;var l=c.render;c.render=function(t,n){return u.call(n),l(t,n)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,u):[u]}return{exports:t,options:c}}e.d(n,{Z:()=>r})}}]);
//# sourceMappingURL=4130.js.map