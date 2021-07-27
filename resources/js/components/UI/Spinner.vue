<template>
  <div :class="`spinner spinner-primary mt-3 ${lg ? '' : 'sm'}`"></div>
</template>

<script>
export default {
  props: {
    lg: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style scoped>
.loading_page {
  height: 80px;
  width: 80px;
  left: calc(50% - 50px);
  top: calc(50% - 50px);
  margin-top: 5%;
}

.spinner.sm {
  height: 2em;
  width: 2em;
}
.spinner-primary {
  background: #8b5cf6;
  background: linear-gradient(90deg, #8b5cf6 10%, rgba(67, 236, 76, 0) 42%);
}
.spinner-primary:before {
  background: #8b5cf6;
}

.spinner {
  display: inline-block;
  font-size: 10px;
  margin: auto;
  text-indent: -9999em;
  width: 4em;
  height: 4em;
  border-radius: 50%;
  position: relative;
  animation: spin 1.4s infinite linear;
  transform: translateZ(0);
}
.spinner:before {
  width: 50%;
  height: 50%;
  border-radius: 100% 0 0 0;
}
.spinner:after,
.spinner:before {
  position: absolute;
  top: 0;
  left: 0;
  content: "";
}
.spinner:after {
  background: #fff;
  width: 75%;
  height: 75%;
  border-radius: 50%;
  margin: auto;
  bottom: 0;
  right: 0;
}

@-webkit-keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
