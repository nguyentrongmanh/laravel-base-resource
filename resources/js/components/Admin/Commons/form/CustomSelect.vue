<template>
  <div>
    <select
      class="custom-select form-control"
      :class="classes"
      :style="`width: ${setWith}`"
      v-model="selected"
      :name="name"
      @change="updateValue"
      :disabled="disableSelect"
    >
      <option
        v-for="(item, index) in options"
        :key="index"
        :value="typeof item == 'object' ? item.id : item"
        :selected="selected == item"
      >
        {{ typeof item == 'object' ? item.label : item }}
      </option>
    </select>
    <div class="input-group text-error text-danger" v-if="error">
      {{ error }}
    </div>
    <div class="input-group text-error text-danger" v-if="systemError">
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
      return this.selected;
    },
  },
  props: {
    value: {
      type: String | Number,
      default: '',
    },
    disableSelect: {
      type: Boolean,
      default: false,
    },
    name: {
      type: String,
      default: '',
    },
    width: {
      type: String | Number,
      default: '100%',
    },
    error: {
      type: String,
      required: false,
    },
    systemError: {
      type: String,
      required: false,
    },
    initValue: {
      type: String | Number,
      required: false,
    },
    options: {
      type: Array | Object,
      required: false,
    },
    classes: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      selected: '',
    };
  },
  mounted() {
    if (this.initValue && this.initValue.length != 0) {
      this.selected = this.initValue;
    }
  },
  computed: {
    setWith() {
      if (typeof this.width == "number") {
        return this.width + "px";
      }
      return this.width;
    },
  },
  watch: {
    initValue(newVal) {
      this.selected = newVal;
    },
    value(newVal) {
      this.selected = newVal;
    },
  },
  methods: {
    updateValue(e) {
      this.$emit('input', this.selected);
    },
  },
};
</script>
