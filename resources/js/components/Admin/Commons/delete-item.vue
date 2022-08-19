<template>
  <div>
    <a
      class="dropdown-item cursor-pointer"
      @click="showAlert"
      style="width: 100%"
    >
      <i class="fa-thin fa-trash-can"></i>delete
    </a>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  props: ["deleteAction", "messageConfirm"],
  mounted() {},
  methods: {
    showAlert() {
      let that = this;
      this.$swal({
        title: that.messageConfirm,
        icon: "warning",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete(that.deleteAction, {
              _token: Laravel.csrfToken,
            })
            .then(function (response) {
              that
                .$swal({
                  title: response.data.message,
                  icon: "success",
                })
                .then(function () {
                  location.reload();
                });
            })
            .catch((error) => {
              that
                .$swal({
                  title: error.response.data.message,
                  icon: "error",
                })
                .then(function () {
                  location.reload();
                });
            });
        }
      });
    },
  },
};
</script>
