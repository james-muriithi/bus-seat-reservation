(self.webpackChunk=self.webpackChunk||[]).push([[5001],{8615:(n,e,t)=>{"use strict";t.d(e,{Z:()=>s});var r=t(4015),i=t.n(r),a=t(3645),o=t.n(a)()(i());o.push([n.id,'.loading_page[data-v-0b5d26b4]{height:80px;left:calc(50% - 50px);margin-top:5%;top:calc(50% - 50px);width:80px}.spinner.sm[data-v-0b5d26b4]{height:2em;width:2em}.spinner-primary[data-v-0b5d26b4]{background:#8b5cf6;background:linear-gradient(90deg,#8b5cf6 10%,rgba(67,236,76,0) 42%)}.spinner-primary[data-v-0b5d26b4]:before{background:#8b5cf6}.spinner[data-v-0b5d26b4]{-webkit-animation:spin-data-v-0b5d26b4 1.4s linear infinite;animation:spin-data-v-0b5d26b4 1.4s linear infinite;border-radius:50%;display:inline-block;font-size:10px;height:4em;margin:auto;position:relative;text-indent:-9999em;transform:translateZ(0);width:4em}.spinner[data-v-0b5d26b4]:before{border-radius:100% 0 0 0;height:50%;width:50%}.spinner[data-v-0b5d26b4]:after,.spinner[data-v-0b5d26b4]:before{content:"";left:0;position:absolute;top:0}.spinner[data-v-0b5d26b4]:after{background:#fff;border-radius:50%;bottom:0;height:75%;margin:auto;right:0;width:75%}@-webkit-keyframes spin-data-v-0b5d26b4{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}@keyframes spin-data-v-0b5d26b4{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}',"",{version:3,sources:["webpack://./resources/js/components/UI/Spinner.vue"],names:[],mappings:"AAgBA,+BACA,WAAA,CAEA,qBAAA,CAEA,aAAA,CADA,oBAAA,CAFA,UAIA,CAEA,6BACA,UAAA,CACA,SACA,CACA,kCACA,kBAAA,CACA,mEACA,CACA,yCACA,kBACA,CAEA,0BASA,2DAAA,CAAA,mDAAA,CAFA,iBAAA,CANA,oBAAA,CACA,cAAA,CAIA,UAAA,CAHA,WAAA,CAKA,iBAAA,CAJA,mBAAA,CAMA,uBAAA,CALA,SAMA,CACA,iCAGA,wBAAA,CADA,UAAA,CADA,SAGA,CACA,iEAKA,UAAA,CADA,MAAA,CAFA,iBAAA,CACA,KAGA,CACA,gCACA,eAAA,CAGA,iBAAA,CAEA,QAAA,CAHA,UAAA,CAEA,WAAA,CAEA,OAAA,CALA,SAMA,CAEA,wCACA,GAEA,sBACA,CACA,GAEA,uBACA,CACA,CAEA,gCACA,GAEA,sBACA,CACA,GAEA,uBACA,CACA",sourcesContent:["<template>\n  <div :class=\"`spinner spinner-primary mt-3 ${lg ? '' : 'sm'}`\"></div>\n</template>\n\n<script>\nexport default {\n  props: {\n    lg: {\n      type: Boolean,\n      default: false,\n    },\n  },\n};\n<\/script>\n\n<style scoped>\n.loading_page {\n  height: 80px;\n  width: 80px;\n  left: calc(50% - 50px);\n  top: calc(50% - 50px);\n  margin-top: 5%;\n}\n\n.spinner.sm {\n  height: 2em;\n  width: 2em;\n}\n.spinner-primary {\n  background: #8b5cf6;\n  background: linear-gradient(90deg, #8b5cf6 10%, rgba(67, 236, 76, 0) 42%);\n}\n.spinner-primary:before {\n  background: #8b5cf6;\n}\n\n.spinner {\n  display: inline-block;\n  font-size: 10px;\n  margin: auto;\n  text-indent: -9999em;\n  width: 4em;\n  height: 4em;\n  border-radius: 50%;\n  position: relative;\n  animation: spin 1.4s infinite linear;\n  transform: translateZ(0);\n}\n.spinner:before {\n  width: 50%;\n  height: 50%;\n  border-radius: 100% 0 0 0;\n}\n.spinner:after,\n.spinner:before {\n  position: absolute;\n  top: 0;\n  left: 0;\n  content: \"\";\n}\n.spinner:after {\n  background: #fff;\n  width: 75%;\n  height: 75%;\n  border-radius: 50%;\n  margin: auto;\n  bottom: 0;\n  right: 0;\n}\n\n@-webkit-keyframes spin {\n  0% {\n    -webkit-transform: rotate(0deg);\n    transform: rotate(0deg);\n  }\n  100% {\n    -webkit-transform: rotate(360deg);\n    transform: rotate(360deg);\n  }\n}\n\n@keyframes spin {\n  0% {\n    -webkit-transform: rotate(0deg);\n    transform: rotate(0deg);\n  }\n  100% {\n    -webkit-transform: rotate(360deg);\n    transform: rotate(360deg);\n  }\n}\n</style>\n"],sourceRoot:""}]);const s=o},3645:n=>{"use strict";n.exports=function(n){var e=[];return e.toString=function(){return this.map((function(e){var t=n(e);return e[2]?"@media ".concat(e[2]," {").concat(t,"}"):t})).join("")},e.i=function(n,t,r){"string"==typeof n&&(n=[[null,n,""]]);var i={};if(r)for(var a=0;a<this.length;a++){var o=this[a][0];null!=o&&(i[o]=!0)}for(var s=0;s<n.length;s++){var A=[].concat(n[s]);r&&i[A[0]]||(t&&(A[2]?A[2]="".concat(t," and ").concat(A[2]):A[2]=t),e.push(A))}},e}},4015:n=>{"use strict";function e(n,e){return function(n){if(Array.isArray(n))return n}(n)||function(n,e){var t=n&&("undefined"!=typeof Symbol&&n[Symbol.iterator]||n["@@iterator"]);if(null==t)return;var r,i,a=[],o=!0,s=!1;try{for(t=t.call(n);!(o=(r=t.next()).done)&&(a.push(r.value),!e||a.length!==e);o=!0);}catch(n){s=!0,i=n}finally{try{o||null==t.return||t.return()}finally{if(s)throw i}}return a}(n,e)||function(n,e){if(!n)return;if("string"==typeof n)return t(n,e);var r=Object.prototype.toString.call(n).slice(8,-1);"Object"===r&&n.constructor&&(r=n.constructor.name);if("Map"===r||"Set"===r)return Array.from(n);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return t(n,e)}(n,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function t(n,e){(null==e||e>n.length)&&(e=n.length);for(var t=0,r=new Array(e);t<e;t++)r[t]=n[t];return r}n.exports=function(n){var t=e(n,4),r=t[1],i=t[3];if(!i)return r;if("function"==typeof btoa){var a=btoa(unescape(encodeURIComponent(JSON.stringify(i)))),o="sourceMappingURL=data:application/json;charset=utf-8;base64,".concat(a),s="/*# ".concat(o," */"),A=i.sources.map((function(n){return"/*# sourceURL=".concat(i.sourceRoot||"").concat(n," */")}));return[r].concat(A).concat([s]).join("\n")}return[r].join("\n")}},3379:(n,e,t)=>{"use strict";var r,i=function(){return void 0===r&&(r=Boolean(window&&document&&document.all&&!window.atob)),r},a=function(){var n={};return function(e){if(void 0===n[e]){var t=document.querySelector(e);if(window.HTMLIFrameElement&&t instanceof window.HTMLIFrameElement)try{t=t.contentDocument.head}catch(n){t=null}n[e]=t}return n[e]}}(),o=[];function s(n){for(var e=-1,t=0;t<o.length;t++)if(o[t].identifier===n){e=t;break}return e}function A(n,e){for(var t={},r=[],i=0;i<n.length;i++){var a=n[i],A=e.base?a[0]+e.base:a[0],c=t[A]||0,d="".concat(A," ").concat(c);t[A]=c+1;var u=s(d),f={css:a[1],media:a[2],sourceMap:a[3]};-1!==u?(o[u].references++,o[u].updater(f)):o.push({identifier:d,updater:m(f,e),references:1}),r.push(d)}return r}function c(n){var e=document.createElement("style"),r=n.attributes||{};if(void 0===r.nonce){var i=t.nc;i&&(r.nonce=i)}if(Object.keys(r).forEach((function(n){e.setAttribute(n,r[n])})),"function"==typeof n.insert)n.insert(e);else{var o=a(n.insert||"head");if(!o)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");o.appendChild(e)}return e}var d,u=(d=[],function(n,e){return d[n]=e,d.filter(Boolean).join("\n")});function f(n,e,t,r){var i=t?"":r.media?"@media ".concat(r.media," {").concat(r.css,"}"):r.css;if(n.styleSheet)n.styleSheet.cssText=u(e,i);else{var a=document.createTextNode(i),o=n.childNodes;o[e]&&n.removeChild(o[e]),o.length?n.insertBefore(a,o[e]):n.appendChild(a)}}function l(n,e,t){var r=t.css,i=t.media,a=t.sourceMap;if(i?n.setAttribute("media",i):n.removeAttribute("media"),a&&"undefined"!=typeof btoa&&(r+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(a))))," */")),n.styleSheet)n.styleSheet.cssText=r;else{for(;n.firstChild;)n.removeChild(n.firstChild);n.appendChild(document.createTextNode(r))}}var p=null,b=0;function m(n,e){var t,r,i;if(e.singleton){var a=b++;t=p||(p=c(e)),r=f.bind(null,t,a,!1),i=f.bind(null,t,a,!0)}else t=c(e),r=l.bind(null,t,e),i=function(){!function(n){if(null===n.parentNode)return!1;n.parentNode.removeChild(n)}(t)};return r(n),function(e){if(e){if(e.css===n.css&&e.media===n.media&&e.sourceMap===n.sourceMap)return;r(n=e)}else i()}}n.exports=function(n,e){(e=e||{}).singleton||"boolean"==typeof e.singleton||(e.singleton=i());var t=A(n=n||[],e);return function(n){if(n=n||[],"[object Array]"===Object.prototype.toString.call(n)){for(var r=0;r<t.length;r++){var i=s(t[r]);o[i].references--}for(var a=A(n,e),c=0;c<t.length;c++){var d=s(t[c]);0===o[d].references&&(o[d].updater(),o.splice(d,1))}t=a}}}},5001:(n,e,t)=>{"use strict";t.r(e),t.d(e,{default:()=>A});const r={props:{lg:{type:Boolean,default:!1}}};var i=t(3379),a=t.n(i),o=t(8615),s={insert:"head",singleton:!1};a()(o.Z,s);o.Z.locals;const A=(0,t(1900).Z)(r,(function(){var n=this,e=n.$createElement;return(n._self._c||e)("div",{class:"spinner spinner-primary mt-3 "+(n.lg?"":"sm")})}),[],!1,null,"0b5d26b4",null).exports},1900:(n,e,t)=>{"use strict";function r(n,e,t,r,i,a,o,s){var A,c="function"==typeof n?n.options:n;if(e&&(c.render=e,c.staticRenderFns=t,c._compiled=!0),r&&(c.functional=!0),a&&(c._scopeId="data-v-"+a),o?(A=function(n){(n=n||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(n=__VUE_SSR_CONTEXT__),i&&i.call(this,n),n&&n._registeredComponents&&n._registeredComponents.add(o)},c._ssrRegister=A):i&&(A=s?function(){i.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:i),A)if(c.functional){c._injectStyles=A;var d=c.render;c.render=function(n,e){return A.call(e),d(n,e)}}else{var u=c.beforeCreate;c.beforeCreate=u?[].concat(u,A):[A]}return{exports:n,options:c}}t.d(e,{Z:()=>r})}}]);
//# sourceMappingURL=5001.js.map