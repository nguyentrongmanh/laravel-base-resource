<template>
  <div class="container-fluid">
    <page-loading v-if="isLoading"></page-loading>
    <div class="fade-in">
      <div class="row">
        <div class="col-sm-12">
          <div class="card mb-4">
            <div class="card-header">
              <strong>Update user</strong>
            </div>
            <div class="card-body">
              <div class="example">
                <div class="mb-3">
                  <label class="form-label">user name</label>
                  <custom-input
                    :width="'100%'"
                    name="name"
                    :height="40"
                    v-model="name"
                    v-validate="'required|max:255'"
                    :error="errors.first('name')"
                    data-vv-as="user name"
                  />
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
                    :error="errors.first('icon')"
                    data-vv-as="avatar"
                  />
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
                    :error="errors.first('sex')"
                    data-vv-as="gender"
                  />
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
                    class="error text-error text-danger"
                    v-if="errors.has('birthDate')"
                  >
                    {{ errors.first("birthDate") }}
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">email</label>
                  <custom-input
                    :width="'100%'"
                    :height="40"
                    name="email"
                    v-model="email"
                    v-validate="{
                      required: true,
                      email: true,
                      max: 255,
                      excluded: checkEmail,
                    }"
                    :error="errors.first('email')"
                  />
                </div>
                <div class="mb-3">
                  <div class="d-flex justify-content-center">
                    <custom-button
                      :label="'submit'"
                      @click="update"
                      :classes="'btn-primary'"
                    />
                  </div>
                </div>
              </div>
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
      isLoading: false,
      name: this.data.user.name,
      email: this.data.user.email,
      birthDate: this.data.user.birth_date,
      sex: this.data.user.sex,
      icon: this.data.user.media_image,
    };
  },
  props: ["route", "data"],
  computed: {
    checkEmail: function () {
      return this.data.listEmail;
    },
  },
  methods: {
    async update() {
      const valid = await this.$validator.validateAll();
      if (valid) {
        this.isLoading = true;
        let formData = new FormData();
        formData.append("name", this.name);
        formData.append("email", this.email);
        formData.append("password", this.password);
        formData.append("birthDate", this.birthDate);
        formData.append("sex", this.sex);
        formData.append("icon", this.icon);
        formData.append("_method", "PUT");

        axios
          .post(this.route.update, formData, {
            header: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((res) => {
            this.isLoading = false;
            this.$swal({
              title: "success",
              icon: "success",
            }).then(() => {
              window.location.href = this.route.index;
            });
          })
          .catch((errors) => {
            this.isLoading = false;
            this.$swal({
              title: "error",
              icon: "error",
            });
          });
      }
    },
  },
};
</script>
