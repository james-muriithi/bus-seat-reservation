(self.webpackChunk=self.webpackChunk||[]).push([[9559],{49559:(t,e,i)=>{"use strict";i.r(e),i.d(e,{default:()=>s});const a={components:{CreatePickupPoint:function(){return i.e(522).then(i.bind(i,80522))},EditPickupPoint:function(){return i.e(3825).then(i.bind(i,3825))},DeletePickupPoint:function(){return i.e(6671).then(i.bind(i,56671))}},props:{smallTable:{type:Boolean},defaultCreateRoute:{default:""}},data:function(){return{isLoading:!1,pickupPoints:[],selectedPickupPoint:{}}},computed:{columns:function(){return this.smallTable?[{label:"Pickup Point",field:"pickup_point"},{label:"Pickup Time",field:"pickup_time"},{label:"Status",field:"status",html:!0},{label:"Actions",field:"actions",html:!0,tdClass:"text-center",thClass:"text-center",sortable:!1}]:[{label:"Route",field:"route"},{label:"Pickup Point",field:"pickup_point"},{label:"Pickup Time",field:"pickup_time"},{label:"Address",field:"address"},{label:"Landmark",field:"landmark"},{label:"Status",field:"status",html:!0},{label:"Cretaed At",field:"created_at",type:"date",thClass:"text-left",tdClass:"text-left",dateInputFormat:"yyyy-MM-dd HH:mm:ss",dateOutputFormat:"MMM do yyyy HH:mm"},{label:"Actions",field:"actions",html:!0,tdClass:"text-center",thClass:"text-center",sortable:!1}]}},methods:{fetchPickupPoints:function(){var t=this,e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0];this.$store.dispatch("startLoading"),this.isLoading=e;var i="/admin/pickup-points";this.defaultCreateRoute&&(i+="?route=".concat(this.defaultCreateRoute)),axios.get(i).then((function(e){t.pickupPoints=e.data.data,t.$store.dispatch("stopLoading"),t.isLoading=!1})).catch((function(e){t.$store.dispatch("stopLoading"),t.isLoading=!1}))},editPickupPoint:function(t){this.selectedPickupPoint=t,$("#edit-pickup-point").modal("show")},deletePickupPoint:function(t){this.selectedPickupPoint=t,$("#delete-pickup-point").modal("show")}},created:function(){this.fetchPickupPoints()}};const s=(0,i(51900).Z)(a,(function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[t.isLoading?i("div",{staticClass:"mb-5",staticStyle:{height:"300px"}},[i("spinner",{staticClass:"loading_page",attrs:{lg:!0}})],1):i("vue-good-table",{attrs:{columns:t.columns,rows:t.pickupPoints,"search-options":{placeholder:"Search this table",enabled:!0},"pagination-options":{enabled:!0,mode:"records",nextLabel:"next",prevLabel:"prev"},"select-options":{enabled:!0,clearSelectionText:"clear",selectOnCheckboxOnly:!0},"sort-options":{enabled:!0},styleClass:"vgt-table tableOne table-hover"},scopedSlots:t._u([{key:"table-row",fn:function(e){return["actions"==e.column.field?i("span",[i("a",{staticClass:"pr-1",attrs:{href:"#",title:"Edit"},on:{click:function(i){return i.preventDefault(),t.editPickupPoint(Object.assign({},e.row))}}},[i("i",{staticClass:"fa fa-pencil-alt fs-16 text-success"})]),t._v(" "),i("a",{attrs:{title:"Delete",href:"#"},on:{click:function(i){return i.preventDefault(),t.deletePickupPoint(Object.assign({},e.row))}}},[i("i",{staticClass:"fa fa-trash fs-16 text-danger"})])]):"route"==e.column.field?i("span",[i("a",{attrs:{href:"/admin/routes/"+e.row.route.id}},[t._v(t._s(e.row.route.route_name))])]):"status"==e.column.field?i("span",[i("span",{class:"badge py-1 px-2 badge-outline-"+(e.row.status?"success":"danger")},[t._v("\n          "+t._s(e.row.status?"Active":"Inactive")+"\n        ")])]):t._e()]}}])},[i("div",{attrs:{slot:"selected-row-actions"},slot:"selected-row-actions"},[i("button",{staticClass:"btn btn-danger btn-sm"},[t._v("Delete")])]),t._v(" "),i("div",{staticClass:"mt-2 mb-3",attrs:{slot:"table-actions"},slot:"table-actions"},[i("button",{staticClass:"btn-sm btn btn-primary btn-rounded btn-icon m-1 ripple",attrs:{"data-toggle":"modal","data-target":"#create-pickup-point"}},[i("span",{staticClass:"ul-btn__icon"},[i("i",{staticClass:"feather-icon",attrs:{"data-feather":"plus-circle"}})]),t._v(" "),i("span",{staticClass:"ul-btn__text ml-1"},[t._v("Create")])])])]),t._v(" "),i("create-pickup-point",{attrs:{"default-route":t.defaultCreateRoute},on:{update:function(e){return t.fetchPickupPoints(!1)}}}),t._v(" "),i("edit-pickup-point",{attrs:{pickupPoint:t.selectedPickupPoint},on:{update:function(e){return t.fetchPickupPoints(!1)}}}),t._v(" "),i("delete-pickup-point",{attrs:{pickupPoint:t.selectedPickupPoint},on:{update:function(e){return t.fetchPickupPoints(!1)}}})],1)}),[],!1,null,null,null).exports}}]);
//# sourceMappingURL=9559.js.map