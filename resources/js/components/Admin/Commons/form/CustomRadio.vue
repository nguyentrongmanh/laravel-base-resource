<template>
  <div>
    <div
      class="form-check"
      :class="customClass"
      v-for="(item, index) in options"
      :key="index"
    >
      <input
        type="radio"
        class="form-check-input"
        :id="`name_${index}`"
        :name="name"
        :value="item.value"
        v-model="radioValue"
        @change="updateValue"
      />
      <label class="form-check-label" :for="`name_${index}`">{{
        item.label
      }}</label>
    </div>
  </div>
</template>

<style scoped></style>
<script>
export default {
  data() {
    return {
      radioValue: this.initValue ? this.initValue : this.value,
    };
  },
  props: {
    value: {
      type: Number | String,
      default: "0",
    },
    name: {
      type: String,
      default: "",
    },
    initValue: {
      type: Number | String,
    },
    error: {
      type: String,
      required: false,
    },
    options: {
      type: Array,
      required: true,
    },
    customClass: {
      type: String,
    },
  },
  watch: {
    initValue(newVal) {
      this.radioValue = newVal;
    },
  },
  methods: {
    updateValue(e) {
      this.$emit("input", e.target.value);
    },
  },
};
</script>
