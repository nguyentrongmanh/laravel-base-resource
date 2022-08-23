<template>
  <div class="container">
    <page-loading v-if="isLoading"></page-loading>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mx-4">
          <div class="card-body p-4">
            <form method="POST" @submit.prevent="submit">
              <h1>Register</h1>
              <p class="text-muted">Create your account</p>
              <div class="mb-3">
                <label class="form-label">user name</label>
                <input
                  class="form-control"
                  type="text"
                  placeholder="Name"
                  name="name"
                  v-model="name"
                  v-validate="'required|max:255'"
                  data-vv-as="user name"
                />
                <div
                  class="invalid-feedback"
                  :class="{ 'd-block': errors.first('name') }"
                  role="alert"
                >
                  {{ errors.first("name") }}
                </div>
                <div
                  class="invalid-feedback d-block"
                  v-if="errorsData.name"
                  role="alert"
                >
                  {{ errorsData.name }}
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">avatar</label>
                <image-drop-box
                  name="icon"
                  :width="100"
                  :height="100"
                  text="upload image"
                  v-model="icon"
                  v-validate="'required'"
                  data-vv-as="avatar"
                />
                <div
                  class="invalid-feedback"
                  :class="{ 'd-block': errors.first('icon') }"
                  role="alert"
                >
                  {{ errors.first("icon") }}
                </div>
                <div
                  class="invalid-feedback d-block"
                  v-if="errorsData.icon"
                  role="alert"
                >
                  {{ errorsData.icon }}
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">gender</label>
                <custom-radio
                  :classes="'form-check-inline'"
                  name="sex"
                  v-model="sex"
                  :options="[
                    {
                      value: 1,
                      label: 'male',
                    },
                    {
                      value: 2,
                      label: 'female',
                    },
                    {
                      value: 3,
                      label: 'other',
                    },
                  ]"
                  v-validate="'required'"
                  data-vv-as="gender"
                />
                <div
                  class="invalid-feedback"
                  :class="{ 'd-block': errors.first('sex') }"
                  role="alert"
                >
                  {{ errors.first("sex") }}
                </div>
                <div
                  class="invalid-feedback d-block"
                  v-if="errorsData.sex"
                  role="alert"
                >
                  {{ errorsData.sex }}
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label w-100">birth day</label>
                <date-picker
                  input-class="form-control"
                  name="birthDate"
                  v-model="birthDate"
                  v-validate="'required'"
                  data-vv-as="birth day"
                  format="YYYY-MM-DD"
                  valueType="YYYY-MM-DD"
                />
                <div
                  class="invalid-feedback"
                  :class="{ 'd-block': errors.first('birthDate') }"
                  role="alert"
                >
                  {{ errors.first("birthDate") }}
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">E-Mail Address</label>
                <input
                  class="form-control"
                  type="text"
                  placeholder="E-Mail Address"
                  name="email"
                  v-model="email"
                  v-validate="{
                    required: true,
                    email: true,
                    max: 255,
                    excluded: checkEmail,
                  }"
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
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                  class="form-control"
                  type="password"
                  placeholder="Password"
                  name="password"
                  v-model="password"
                  v-validate="'required|max:255'"
                  autocomplete="new-password"
                  ref="password"
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
              </div>
              <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input
                  class="form-control"
                  type="password"
                  placeholder="Confirm Password"
                  name="password_confirmation"
                  v-model="passwordConfirmation"
                  v-validate="'required|max:255|confirmed:password'"
                  data-vv-as="confirm password"
                />
                <div
                  class="invalid-feedback"
                  :class="{ 'd-block': errors.first('password_confirmation') }"
                  role="alert"
                >
                  {{ errors.first("password_confirmation") }}
                </div>
                <div
                  class="invalid-feedback d-block"
                  v-if="errorsData.password_confirmation"
                  role="alert"
                >
                  {{ errorsData.password_confirmation }}
                </div>
              </div>
              <button class="btn btn-block btn-success" type="submit">
                Register
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CustomRadio from "../../Admin/Commons/form/CustomRadio.vue";
import ImageDropBox from "../../Admin/Commons/form/ImageDropBox.vue";

export default {
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      name: "",
      email: "",
      password: "",
      icon: "",
      sex: "",
      passwordConfirmation: "",
      birthDate: "",
      errorsData: "",
      isLoading: false,
    };
  },
  props: ["route", "data"],
  components: {
    CustomRadio,
    ImageDropBox,
  },
  computed: {
    checkEmail: function () {
      return this.data.listEmail;
    },
  },
  methods: {
    submit() {
      let formData = new FormData();
      formData.append("_token", Laravel.csrfToken);
      formData.append("name", this.name);
      formData.append("email", this.email);
      formData.append("sex", this.sex);
      formData.append("icon", this.icon);
      formData.append("birthDate", this.birthDate);
      formData.append("password", this.password);
      formData.append("password_confirmation", this.passwordConfirmation);
      this.$validator.validateAll().then((valid) => {
        if (valid) {
          this.isLoading = true;
          axios
            .post(this.route.urlRegister, formData, {
              header: {
                "Content-Type": "multipart/form-data",
              },
            })
            .then((response) => {
              this.isLoading = false;
              window.location.href = this.route.verify;
            })
            .catch((error) => {
              this.isLoading = false;
              this.errorsData = error.response.data.message_validate;
            });
        }
      });
    },
  },
};
</script>
