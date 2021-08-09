<template>
  <span class="mdl-chip mdl-chip--deletable mr-1">
    <span class="mdl-chip__text">{{ text }}</span>
    <button type="button" class="mdl-chip__action" @click="close">X</button>
  </span>
</template>

<script>
export default {
  emits: ["remove"],
  props: {
    text: {
      type: String,
      required: true
    },
    index: {
      required: true
    }
  },
  methods: {
    close() {
      if (confirm("Are you sure you want to remove")) {
        this.$emit("remove", this.index);
      }
    }
  }
};
</script>

<style scoped>
.mdl-chip {
  height: 32px;
  font-family: "Roboto", "Helvetica", "Arial", sans-serif;
  line-height: 32px;
  padding: 0 12px;
  border: 0;
  border-radius: 16px;
  background-color: #dedede;
  display: inline-block;
  color: rgba(0, 0, 0, 0.87);
  margin: 2px 3px;
  font-size: 0;
  white-space: nowrap;
}
.mdl-chip--deletable {
  padding-right: 4px;
}
.mdl-chip__text {
  font-size: 13px;
  vertical-align: middle;
  display: inline-block;
}
[type="button"]:not(:disabled),
[type="reset"]:not(:disabled),
[type="submit"]:not(:disabled),
button:not(:disabled) {
  cursor: pointer;
}
.mdl-chip__action,
.mdl-chip__contact {
  display: inline-block;
  vertical-align: middle;
  overflow: hidden;
  text-align: center;
}
.mdl-chip__action {
  height: 24px;
  width: 24px;
  background: 0 0;
  opacity: 0.54;
  cursor: pointer;
  padding: 0;
  margin: 0 0 0 4px;
  font-size: 13px;
  text-decoration: none;
  color: rgba(0, 0, 0, 0.87);
  border: none;
  outline: none;
  line-height: 20px;
}
</style>
