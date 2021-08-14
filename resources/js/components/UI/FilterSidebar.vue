<template>
  <nav
    :class="`sidebar shadow text-dark bg-white sidebar-right slide ${
      isOpen ? '' : 'd-none'
    }`"
    tabindex="-1"
    role="dialog"
    aria-modal="false"
  >
    <header class="sidebar-header">
      <button
        type="button"
        aria-label="Close"
        class="close text-dark"
        @click="close"
      >
        <svg
          viewBox="0 0 16 16"
          width="1em"
          height="1em"
          focusable="false"
          role="img"
          aria-label="x"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          class="bi-x b-icon bi"
        >
          <g>
            <path
              d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
            ></path>
          </g>
        </svg>
      </button>
      <strong id="sidebar-right___title__" class="ml-auto">Filter</strong>
    </header>

    <div class="sidebar-body">
      <slot></slot>
    </div>
  </nav>
</template>

<script>
export default {
  emits: ["close"],
  props: {
    open: {
      typpe: Boolean,
      default: false,
    },
  },
  data() {
    return {
      isOpen: this.open,
    };
  },
  watch: {
    open(newValue) {
      this.isOpen = newValue;
    },
  },
  methods: {
    close() {
      this.isOpen = false;
      this.$emit("close");
    },
  },
};
</script>

<style scoped>
.slide {
    -webkit-animation: slide 0.5s forwards;
    -webkit-animation-delay: 2s;
    animation: slide 0.5s forwards;
    animation-delay: 2s;
}

@-webkit-keyframes slide {
    100% { width: 0; }
}

@keyframes slide {
    100% { width: 320px; }
}
</style>
