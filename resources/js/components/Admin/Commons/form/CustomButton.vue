<template>
  <button
    :style="`width: ${width}; height: ${height};`"
    class="btn"
    :class="customClass"
    :type="`${type}`"
    @click="$emit('click')"
  >
    {{ label }}
  </button>
</template>

<script>
export default {
  name: 'CustomButton',
  props: {
    width: {
      type: String,
      default: '100px',
      required: false,
    },
    height: {
      type: String,
      default: '40px',
      required: false,
    },
    label: {
      type: String,
      default: '保存',
      required: false,
    },
    customClass: {
      type: String,
      default: 'btn-primary',
      require: false,
    },
    type: {
      type: String,
      default: 'button',
      require: 'true',
    },
    classes: {
      type: String,
      default: '',
    },
  },
};
</script>
