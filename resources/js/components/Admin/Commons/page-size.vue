<template>
  <custom-select
    :width="'100%'"
    :options="pageSize"
    :classes="'page-size-select cursor-point'"
    @input="onChange"
    v-model="pageLimit"
    :initValue="pageLimit"
  />
</template>

<script>
export default {
  data() {
    return {};
  },
  props: ["pageSize", "pageLimit"],
  methods: {
    onChange(event) {
      let pathname = window.location.pathname;
      let search = window.location.search;
      if (search.indexOf("limit=") >= 0) {
        search = search.replace(
          /limit=([0-9]*)/gi,
          "limit=" + event
        );
      } else {
        if (search == "") {
          search = search + "?limit=" + event;
        } else {
          search = search + "&limit=" + event;
        }
      }
      window.location = window.location.origin + pathname + search;
    },
  },
};
</script>
