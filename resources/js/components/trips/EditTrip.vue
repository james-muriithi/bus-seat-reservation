<template>
    <div class="modal" id="edit-trip">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Trip</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <validation-observer ref="editTrip">
                        <form @submit.prevent="editTrip" ref="form">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <validation-provider
                                        name="Route"
                                        :rules="{ required: true }"
                                        v-slot="validationContext"
                                    >
                                        <div class="form-group">
                                            <label for="name">Route</label>

                                            <select2
                                                id="route"
                                                aria-describedby="bus-feedback"
                                                v-model.trim="trip.route_id"
                                                :options="routes"
                                                :settings="{
                                                    theme: 'bootstrap',
                                                    multiple: false,
                                                    closeOnSelect: true
                                                }"
                                            >
                                            </select2>

                                            <div
                                                id="route-feedback"
                                                class="invalid-feedback w-100"
                                            >
                                                {{
                                                    validationContext.errors[0]
                                                }}
                                            </div>
                                        </div>
                                    </validation-provider>

                                    <validation-provider
                                        name="Travel Date"
                                        :rules="{ required: true }"
                                        v-slot="validationContext"
                                    >
                                        <div class="form-group">
                                            <label for="name"
                                                >Travel Date</label
                                            >
                                            <input
                                                type="date"
                                                placeholder="Enter travel Date"
                                                aria-describedby="Pickup-Point-feedback"
                                                v-model.trim="trip.travel_date"
                                                :class="
                                                    `form-control ${getValidationState(
                                                        validationContext
                                                    )}`
                                                "
                                                
                                            />
                                            <div
                                                id="Pickup-Point-feedback"
                                                class="invalid-feedback w-100"
                                            >
                                                {{
                                                    validationContext.errors[0]
                                                }}
                                            </div>
                                        </div>
                                    </validation-provider>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    id="status"
                                                    v-model="trip.status"
                                                />
                                                Status
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 my-3 text-right">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </validation-observer>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Select2 from "v-select2-component";
import "select2-bootstrap-theme/dist/select2-bootstrap.min.css";

export default {
    components: { Select2 },
    props: {
        defaultRoute: {
            default: ""
        },
        trip: {
            required: true,
            type: Object
        }
    },
    emits: ["update"],
    data() {
        return {
            routes: []
        };
    },
    computed: {
        today() {
            return moment().format("YYYY-MM-DD");
        }
    },
    methods: {
        editTrip() {
            this.$refs.editTrip.validate().then(valid => {
                if (valid) {
                    //submit data
                    this.$store.dispatch("startLoading");
                    axios
                        .post(`/admin/trips/${this.trip.id}`, {
                            _method: "PUT",
                            route_id: this.trip.route_id,
                            status: this.trip.status,
                            travel_date: this.trip.travel_date
                        })
                        .then(res => {
                            this.closeModal();

                            this.$nextTick(() => {
                                this.$emit("update");
                                this.showSuccessToast(
                                    "Trip Edited successfully"
                                );
                            });
                        })
                        .catch(res => {
                            this.$store.dispatch("stopLoading");
                            this.showErrorToast(
                                "There was an error editing the trip"
                            );
                        });
                }
            });
        },
        fetchRoutes(pageLoad = true) {
            this.$store.dispatch("startLoading");
            this.isLoading = pageLoad;

            axios
                .get("/admin/routes")
                .then(res => {
                    this.routes = [];

                    res.data.data.forEach(route => {
                        this.routes.push({
                            id: route.id,
                            text: `${route.bus.bus_reg_no} ${route.board_point} - ${route.drop_point} ${route.board_time}`
                        });
                    });

                    this.$store.dispatch("stopLoading");
                    this.isLoading = false;
                })
                .catch(res => {
                    this.$store.dispatch("stopLoading");
                    this.isLoading = false;
                });
        },
        //---- Validation State Form
        getValidationState({ dirty, validated, valid = null }) {
            if (dirty || validated) {
                return valid ? "is-valid" : "is-invalid";
            }
            return "";
        },
        closeModal() {
            $("#edit-trip").modal("hide");
        }
    },
    created() {
        const self = this;
        self.fetchRoutes();
    }
};
</script>
<style>
.fade:not(.show) {
    opacity: 1;
}
.vue__time-picker.time-picker {
    width: 100%;
}
</style>
