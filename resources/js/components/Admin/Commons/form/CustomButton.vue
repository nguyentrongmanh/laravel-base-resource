<template>
  <button
    :style="`width: ${setWith}; height: ${setHeight};`"
    class="btn"
    :class="classes"
    :type="`${type}`"
    @click="$emit('click')"
  >
    {{ label }}
    <slot name="body"></slot>
  </button>
</template>

<script>
export default {
  name: "CustomButton",
  props: {
    width: {
      type: String | Number,
      default: "100px",
      required: false,
    },
    height: {
      type: String | Number,
      default: "40px",
      required: false,
    },
    label: {
      type: String,
      default: "",
      required: false,
    },
    type: {
      type: String,
      default: "button",
      require: "true",
    },
    classes: {
      type: String,
      default: "",
    },
  },
  computed: {
    setWith() {
      if (typeof this.width == "number") {
        return this.width + "px";
      }
      return this.width;
    },
    setHeight() {
      if (typeof this.height == "number") {
        return this.height + "px";
      }
      return this.height;
    },
  },
};
</script>
