<template>
  <div class="container">
    <page-loading v-if="isLoading"></page-loading>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <h1>ログインする</h1>
              <p class="text-muted">アカウントにサインインする</p>
              <form method="POST" @submit.prevent="submit">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <svg class="c-icon">
                        <use
                          xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"
                        ></use>
                      </svg>
                    </span>
                  </div>
                  <input
                    type="text"
                    name="email"
                    id="email"
                    class="form-control"
                    v-validate="'required|max:255|email'"
                    v-model="email"
                    @input="changeInput"
                    data-vv-as="郵便物"
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
                    v-if="errorsData.email"
                    role="alert"
                  >
                    {{ errorsData.email }}
                  </div>
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <svg class="c-icon">
                        <use
                          xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"
                        ></use>
                      </svg>
                    </span>
                  </div>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    v-validate="'required|min:6|max:16'"
                    v-model="password"
                    @input="changeInput"
                    data-vv-as="パスワード"
                  />
                  <div
                    class="invalid-feedback"
                    :class="{ 'd-block': errors.first('password') }"
                    role="alert"
                  >
                    {{ errors.first("password") }}
                  </div>
                  <div
                    class="invalid-feedback d-block"
                    v-if="errorsData.password"
                    role="alert"
                  >
                    {{ errorsData.password }}
                  </div>
                  <div
                    class="invalid-feedback d-block"
                    v-if="messErr"
                    role="alert"
                  >
                    {{ messErr }}
                  </div>
                </div>
                <div class="row"></div>
                <div class="form-group mb-0">
                  <input
                    class="btn btn-success btn-md"
                    id="remember-me"
                    name="remember-me"
                    v-model="remember_me"
                    type="checkbox"
                  />
                  <label for="remember-me" class="text-info"
                    ><span class="hiragino-sans-w3 pl"
                      >私を覚えてますか</span
                    ></label
                  >
                </div>
                <div class="col-3 text-center m-auto">
                  <a :href="route.forgotPassword">パスワードを忘れた</a>
                  <button type="submit" class="btn btn-primary px-4 mt-3">
                    参加する
                  </button>
                </div>
              </form>
            </div>
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
      messErr: "",
      errorsData: [],
      email: "",
      password: "",
      remember_me: false,
      isLoading: false,
    };
  },
  props: ["route"],
  methods: {
    submit() {
      let formData = new FormData();
      formData.append("_token", Laravel.csrfToken);
      formData.append("email", this.email);
      formData.append("password", this.password);
      formData.append("remember_me", this.remember_me);
      this.$validator.validateAll().then((valid) => {
        if (valid) {
          this.isLoading = true;
          axios
            .post(this.route.urlLogin, formData, {
              header: {
                "Content-Type": "multipart/form-data",
              },
            })
            .then((response) => {
              this.isLoading = false;
              if (response.data.previous == this.route.urlLogin) {
                window.location.href = this.route.urlHome;
              } else {
                window.location.href = response.data.previous;
              }
            })
            .catch((error) => {
              this.isLoading = false;
              if (error.response.data.message) {
                this.messErr = error.response.data.message;
              } else {
                this.errorsData = error.response.data.error;
              }
            });
        }
      });
    },
    changeInput(e) {
      this.errorsData[e.target.name] = "";
    },
  },
};
</script>
