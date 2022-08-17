<template>
    <div class="form-check" :class="classes">
      <input
        type="checkbox"
        class="form-check-input"
        :id="name"
        :name="name"
        v-model="checkValue"
        @change="updateValue"
        :disabled="disabled"
      />
      <label class="form-check-label" :for="name">{{ title }}</label>
    </div>
</template>

<style scoped></style>
<script>
export default {
  data() {
    return {
      checkValue: Boolean(this.value),
      checkName: this.name,
    };
  },
  props: {
    name: {
      type: String,
      default: '',
    },
    title: {
      type: String,
      default: '',
    },
    initValue: {
      type: Boolean | Number,
      default: true,
    },
    value: {
      type: Boolean | Number,
      default: true,
    },
    error: {
      type: String,
      required: false,
    },
    disabled: {
      type: Boolean,
      default: false
    },
    classes: {
      type: String,
      default: '',
    },
  },
  watch: {
    value(newVal) {
      this.checkValue = Boolean(newVal);
    },
  },
  methods: {
    updateValue(e) {
      this.$emit('input', e.target.checked);
    },
  },
};
</script>
