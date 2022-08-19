<template>
  <div class="img-dropbox-wrap">
    <div class="d-inline-block position-relative" :name="name">
      <label
        :for="inputId"
        :style="`width:${setWith}`"
        @dragover.prevent
        @drop="onDrop"
      >
        <div
          class="upload-image m-0"
          :style="`height:${setHeight}`"
        >
          <img
            :src="previewImg"
            v-if="previewImg"
            ref="img_header_logo"
            class="mh-100 mw-100 mx-auto"
          />
          <span
            class="flex-1"
            ref="text_header_logo"
            v-if="!previewImg"
            v-html="text"
          ></span>
        </div>
      </label>
      <a
        v-if="previewImg"
        class="btn btn-light icon-close-white"
        @click="deleteImage()"
      >
      </a>
    </div>
    <input
      v-if="!previewImg"
      class="form-control d-none"
      :id="inputId"
      ref="inputUpload"
      type="file"
      v-on:change="attachImage"
      accept="image/*"
      :disabled="isDisabled"
    />
    <div class="error text-error text-danger" role="alert">
      {{ error }}
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
      return this.previewImg;
    },
  },
  data() {
    return {
      previewImg: this.initValue ? this.initValue : this.value,
      inputId: new Date().getTime() + this.name,
    };
  },
  props: {
    value: {
      type: String | File,
      default: '',
    },
    name: {
      type: String,
      default: '',
    },
    initValue: {
      type: String | File,
      default: '',
    },
    text: {
      type: String,
      default: '',
    },
    error: {
      type: String,
      required: false,
    },
    width: {
      type: String | Number,
      default: "200px",
    },
    height: {
      type: String | Number,
      default: "200px",
    },
    isDisabled: {
      type: Boolean,
      default: false,
    }
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
    initValue: function (newVal, oldVal) {
      if (typeof newVal == 'string') {
        this.previewImg = newVal;
      }
    },
  },
  mounted() {
    if (typeof this.value == 'object' && this.value != undefined) {
      const imagePreviewUrl = URL.createObjectURL(this.value);
      this.previewImg = imagePreviewUrl;
    }
  },
  methods: {
    deleteImage() {
      this.previewImg = null;
      this.$emit('input', null);
    },
    attachImage(e) {
      const files = e.target.files;
      this.createFile(files[0]);
    },
    onDrop(e) {
      e.stopPropagation();
      e.preventDefault();
      var files = e.dataTransfer.files;
      this.createFile(files[0]);
    },
    createFile(file) {
      if (file == undefined) return;
      this.$emit('input', file);
      const imagePreviewUrl = URL.createObjectURL(file);
      this.previewImg = imagePreviewUrl;
    },
  },
};
</script>
