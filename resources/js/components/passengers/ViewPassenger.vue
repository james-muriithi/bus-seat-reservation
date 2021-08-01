<template>
  <div class="mx-2 mx-md-3 mt-2">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <h4 class="font-weight-bold mb-3">Passenger Details</h4>

            <table class="table table-hover table-bordered table-md">
              <tbody>
                <tr>
                  <td>Name</td>
                  <th>{{ passenger.name }}</th>
                </tr>
                <tr>
                  <td>Mobile</td>
                  <th>{{ passenger.mobile }}</th>
                </tr>
                <tr>
                  <td>Email</td>
                  <th>{{ passenger.email }}</th>
                </tr>
                <tr>
                  <td>Gender</td>
                  <th>{{ passenger.gender }}</th>
                </tr>
                <tr>
                  <td>Age</td>
                  <th>{{ passenger.age }}</th>
                </tr>
                <tr>
                  <td>Created At</td>
                  <th>{{ passenger.created_at }}</th>
                </tr>
                <tr>
                  <td>Updated At</td>
                  <th>{{ passenger.updated_at }}</th>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-md-4">
            <div v-if="passenger.avatar">
              <h4 class="my-3 font-weight-bold">Passenger Avatar</h4>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <img
                    :src="passenger.avatar.preview"
                    alt="image"
                    class="image-cover w-100 img-fluid"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12">
            <h4 class="mb-3 font-weight-bold">Trips</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Nprogress from "nprogress";

export default {
  props: {
    passenger: {
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
