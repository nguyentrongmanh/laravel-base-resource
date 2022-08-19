<template>
  <div>
    <input
      :type="type"
      class="custom-input form-control w-100 h-100"
      v-model="inputValue"
      :name="name"
      :id="name"
      :placeholder="placeholder"
      :maxlength="maxlength"
      @change="updateValue"
      :class="classes"
      :disabled="disabled"
      :style="`width: ${setWith}; height: ${setHeight}`"
    />
    <div class="error text-error text-danger" v-if="error">
      {{ error }}
    </div>
    <div class="error text-error text-danger" v-if="systemError">
      {{ systemError }}
    </div>
  </div>
</template>
<script>
export default {
  $_veeValidate: {
    name() {
      return this.name;
    },
    value() {
      return this.inputValue;
    },
  },
  data() {
    return {
      inputValue: this.initValue ? this.initValue : this.value,
    };
  },
  props: {
    value: {
      type: String | Number,
      default: "",
    },
    name: {
      type: String,
      default: "",
    },
    classes: {
      type: String,
      default: "",
    },
    type: {
      type: String,
      default: "text",
    },
    initValue: {
      type: String | Number,
    },
    width: {
      type: String | Number,
    },
    height: {
      type: String | Number,
      default: "40px",
    },
    maxlength: {
      type: Number,
      default: null,
    },
    placeholder: {
      type: String,
      default: "",
    },
    error: {
      type: String,
      required: false,
    },
    systemError: {
      type: String,
      required: false,
    },
    disabled: {
      type: Boolean,
      required: false,
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
  watch: {
    initValue(newVal) {
      this.inputValue = newVal;
    },
    value(newVal) {
      this.inputValue = newVal;
    },
  },
  methods: {
    updateValue(e) {
      this.$emit("input", this.inputValue);
    },
  },
};
</script>
