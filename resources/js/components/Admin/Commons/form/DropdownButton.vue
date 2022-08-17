<template>
  <div class="dropdown" :style="`width: ${width}`" :class="classes">
    <button
      type="button"
      class="btn btn-custom font-weight-normal w-100"
      data-toggle="dropdown"
    >
      <span class="label">{{ label ? label : '操作選択' }}</span>
    </button>
    <div class="dropdown-menu">
      <!-- <div v-for="menu in menusDropdown">
        <a class="dropdown-item" :href="menu.action">{{ menu.label }}</a>
      </div> -->
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
    },
    menusDropdown: {
      type: Array,
    },
    width: {
      type: String,
    },
    classes: {
      type: String,
      default: '',
    },
  },
};
</script>
