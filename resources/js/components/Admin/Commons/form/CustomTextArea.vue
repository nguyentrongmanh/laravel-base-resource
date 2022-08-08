<template>
  <div>
    <textarea
      class="custom-textarea form-control"
      v-model="textValue"
      :name="name"
      :placeholder="placeholder"
      :rows="row"
      :style="`width: ${setWith}; height: ${setHeight}`"
      @input="updateValue"
    />
    <div v-if="error" class="error text-error">
      {{ error }}
    </div>
    <div v-if="systemError" class="error text-error">
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
      return this.value;
    },
  },
  data() {
    return {
      textValue: this.initValue ? this.initValue : this.value,
    };
  },
  props: {
    value: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: '',
    },
    initValue: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
      default: '',
    },
    width: {
      type: String | Number,
      default: '100%',
    },
    row: {
      type: Number,
      default: 5,
    },
    height: {
      type: String | Number,
      default: 'auto',
    },
    error: {
      type: String,
      required: false,
    },
    systemError: {
      type: String,
      required: false,
    }
  },
  methods: {
    updateValue(e) {
      this.$emit('input', e.target.value);
    },
  },
  watch: {
    value: function (newVal) {
      this.textValue = newVal;
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
