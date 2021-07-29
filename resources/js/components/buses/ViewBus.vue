<template>
  <div class="mx-2 mx-md-3 mt-2">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <h4 class="mb-0">Bus Details</h4>
            <hr class="mt-2" />

            <table class="table table-hover table-bordered table-md">
              <tbody>
                <tr>
                  <td>Bus Name</td>
                  <th>{{ bus.bus_name }}</th>
                </tr>
                <tr>
                  <td>Bus Reg No</td>
                  <th>{{ bus.bus_reg_no }}</th>
                </tr>
                <tr>
                  <td>Bus Type</td>
                  <th>{{ bus.bus_type.bus_type }}</th>
                </tr>
                <tr>
                  <td>Max Seats</td>
                  <th>{{ bus.max_seats }}</th>
                </tr>
                <tr>
                  <td>Status</td>
                  <th>
                    <span
                      :class="`badge py-1 px-2 badge-outline-${
                        bus.status ? 'success' : 'danger'
                      }`"
                    >
                      {{ bus.status ? "Active" : "Inactive" }}
                    </span>
                  </th>
                </tr>

                <tr>
                  <td>Amenities</td>
                  <th>
                    <span
                      class="badge py-1 px-2 badge-primary m-1"
                      v-for="amenity in bus.amenities"
                      :key="amenity.name"
                    >
                      {{ amenity.name }}
                    </span>
                  </th>
                </tr>
                <tr>
                  <td>Created By</td>
                  <th>{{ bus.created_by.name }}</th>
                </tr>
                <tr>
                  <td>Created At</td>
                  <th>{{ bus.created_at }}</th>
                </tr>
                <tr>
                  <td>Updated At</td>
                  <th>{{ bus.updated_at }}</th>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-md-4">
            <h4 class="mb-0">Bus Images</h4>
            <hr class="mt-2" />
            <div class="row">
              <div
                class="col-md-6 mb-3"
                v-for="image in bus.images"
                :key="image.file_name"
              >
                <img
                  :src="image.preview"
                  alt="image"
                  class="image-cover w-100 img-fluid"
                />
              </div>
            </div>
            <div class="my-3">
                <h5 class="mb-2 font-weight-bold">Ratings and reviews</h5>
                <rating-histogram></rating-histogram>
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-8">
            <h4 class="mb-0">Bus Routes</h4>
            <hr class="mt-2" />
          </div>
          <div class="col-md-4">
            <h4 class="mb-0">Seats Layout</h4>
            <hr class="mt-2" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Nprogress from "nprogress";
const RatingHistogram = () => import("./modules/RatingHistogram.vue");

export default {
  components: { RatingHistogram },
  props: {
    bus: {
      type: Object,
      required: true,
    },
  },
  computed: {
    loading() {
      return this.$store.getters.loading;
    },
  },
  watch: {
    loading(newValue) {
      if (newValue) {
        Nprogress.start();
        Nprogress.set(0.1);
      } else {
        Nprogress.done();
      }
    },
  },
};
</script>
<style scoped>
th {
  font-size: 14px;
  font-weight: 700;
}
.image-cover {
  border-radius: 8px !important;
  object-fit: cover;
}
</style>
