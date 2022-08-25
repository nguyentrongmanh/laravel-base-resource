<template>
  <div class="container">
    <page-loading v-if="isLoading"></page-loading>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">パスワードを再設定する</div>

          <div class="card-body">
            <form method="POST" @submit.prevent="submit">
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right"
                  >電子メールアドレス</label
                >

                <div class="col-md-6">
                  <input
                    id="email"
                    type="text"
                    class="form-control"
                    name="email"
                    autocomplete="Eメール"
                    v-model="email"
                    @input="changeInput"
                    v-validate="'required|max:255|email'"
                    data-vv-as="Eメール"
                  />
                  <div
                    class="invalid-feedback"
                    :class="{ 'd-block': errors.first('email') }"
                    role="alert"
                  >
                    {{ errors.first("email") }}
                  </div>
                  <div
                    class="invalid-feedback d-block"
                    v-if="errMessage"
                    role="alert"
                  >
                    {{ errMessage }}
                  </div>
                  <div class="valid-feedback d-block" v-if="successMessage">
                    {{ successMessage }}
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    パスワードリセットリンクを送信
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      email: "",
      errMessage: "",
      successMessage: "",
      isLoading: false,
    };
  },
  props: ["route"],
  methods: {
    changeInput() {
      this.errMessage = "";
      this.successMessage = "";
    },
    submit() {
      let formData = new FormData();
      formData.append("_token", Laravel.csrfToken);
      formData.append("email", this.email);
      this.$validator.validateAll().then((valid) => {
        if (valid) {
          this.isLoading = true;
          axios
            .post(this.route.passwordEmail, formData, {
              header: {
                "Content-Type": "multipart/form-data",
              },
            })
            .then((response) => {
              this.isLoading = false;
              this.successMessage = response.data.message;
            })
            .catch((error) => {
              this.isLoading = false;
              if (error.response.data.errors.email.length != 0) {
                this.errMessage = error.response.data.errors.email[0];
              } else {
                this.errMessage = error.response.data.errors.message;
              }
            });
        }
      });
    },
  },
};
</script>
