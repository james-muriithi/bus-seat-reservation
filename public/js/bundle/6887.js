(self.webpackChunk=self.webpackChunk||[]).push([[6887],{6887:(t,e,s)=>{"use strict";s.r(e),s.d(e,{default:()=>n});const a={props:{bus_id:{default:null}},data:function(){return{isLoading:!1,routes:[],selectedRoute:{}}},computed:{columns:function(){var t=[{label:"Bus Name",field:"bus_name"},{label:"Pickup Point",field:"board_point"},{label:"Pickup Time",field:"board_time"},{label:"Drop Off Point",field:"drop_point"},{label:"Drop Off Time",field:"drop_time"},{label:"Fare",field:"fare"},{label:"Status",field:"status"},{label:"Actions",field:"actions",html:!0,tdClass:"text-center",thClass:"text-center",sortable:!1}];return this.bus_id&&t.shift(),t}},methods:{fetchRoutes:function(){var t=this,e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.$store.dispatch("startLoading"),this.isLoading=e;var s="/admin/routes";this.bus_id&&(s+="?bus=".concat(this.bus_id)),axios.get(s).then((function(e){t.routes=e.data.data,t.$store.dispatch("stopLoading"),t.isLoading=!1})).catch((function(e){t.$store.dispatch("stopLoading"),t.isLoading=!1}))},deleteRoute:function(t){this.selecteRoute=t,$("#delete-route").modal("show")}},created:function(){this.fetchRoutes()}};const n=(0,s(1900).Z)(a,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[t.isLoading?s("div",{staticClass:"mb-5",staticStyle:{height:"300px"}},[s("spinner",{staticClass:"loading_page",attrs:{lg:!0}})],1):s("vue-good-table",{attrs:{columns:t.columns,rows:t.routes,"search-options":{placeholder:"Search this table",enabled:!0},"pagination-options":{enabled:!0,mode:"records",nextLabel:"next",prevLabel:"prev"},"select-options":{enabled:!0,clearSelectionText:"clear",selectOnCheckboxOnly:!0},"sort-options":{enabled:!0},styleClass:"vgt-table tableOne table-hover"},scopedSlots:t._u([{key:"table-row",fn:function(e){return["actions"==e.column.field?s("span",[s("a",{staticClass:"pr-1",attrs:{href:"/admin/routes/"+e.row.id,title:"View"}},[s("i",{staticClass:"ti-eye fs-16 text-info"})]),t._v(" "),s("a",{staticClass:"pr-1",attrs:{href:"/admin/routes/"+e.row.id+"/edit",title:"Edit"}},[s("i",{staticClass:"fa fa-pencil-alt fs-16 text-success"})]),t._v(" "),s("a",{attrs:{title:"Delete",href:"#"},on:{click:function(s){return s.preventDefault(),t.deleteRoute(Object.assign({},e.row))}}},[s("i",{staticClass:"fa fa-trash fs-16 text-danger"})])]):"bus_name"==e.column.field?s("span",[t._v("\n        "+t._s(e.row.bus.bus_name)+"\n      ")]):"fare"==e.column.field?s("span",t._l(e.row.seatClassesFare,(function(e){return s("span",{key:e.id,staticClass:"badge py-1 px-2 badge-success mr-1"},[t._v("\n          "+t._s(e.name)+" - "+t._s(e.currencyCode)+t._s(e.fare)+"\n        ")])})),0):"status"==e.column.field?s("span",[s("span",{class:"badge py-1 px-2 badge-outline-"+(e.row.status?"success":"danger")},[t._v("\n          "+t._s(e.row.status?"Active":"Inactive")+"\n        ")])]):t._e()]}}])},[s("div",{attrs:{slot:"selected-row-actions"},slot:"selected-row-actions"},[s("button",{staticClass:"btn btn-danger btn-sm"},[t._v("Delete")])]),t._v(" "),s("div",{staticClass:"mt-2 mb-3",attrs:{slot:"table-actions"},slot:"table-actions"},[s("a",{staticClass:"btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple",attrs:{href:"/admin/routes/create"}},[s("span",{staticClass:"ul-btn__icon"},[s("i",{staticClass:"feather-icon",attrs:{"data-feather":"plus-circle"}})]),t._v(" "),s("span",{staticClass:"ul-btn__text ml-1"},[t._v("Create")])])])])],1)}),[],!1,null,null,null).exports}}]);
//# sourceMappingURL=6887.js.map