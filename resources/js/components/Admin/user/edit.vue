<template>
  <div class="container-fluid">
    <page-loading v-if="isLoading"></page-loading>
    <div class="fade-in">
      <div class="row">
        <div class="col-sm-12">
          <div class="card mb-4">
            <div class="card-header">
              <strong>ユーザーの更新</strong>
            </div>
            <div class="card-body">
              <div class="example">
                <div class="mb-3">
                  <label class="form-label">ユーザー名</label>
                  <custom-input
                    :width="'100%'"
                    name="name"
                    :height="40"
                    v-model="name"
                    v-validate="'required|max:255'"
                    :error="errors.first('name')"
                    data-vv-as="ユーザー名"
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label">アバター</label>
                  <image-drop-box
                    name="icon"
                    :width="100"
                    :height="100"
                    text="画像をアップロード"
                    v-model="icon"
                    v-validate="'required'"
                    :error="errors.first('icon')"
                    data-vv-as="アバター"
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label">性別</label>
                  <custom-radio
                    :classes="'form-check-inline'"
                    name="sex"
                    v-model="sex"
                    :options="[
                      {
                        value: 1,
                        label: '男性',
                      },
                      {
                        value: 2,
                        label: '女性',
                      },
                      {
                        value: 3,
                        label: '未選択',
                      },
                    ]"
                    v-validate="'required'"
                    :error="errors.first('sex')"
                    data-vv-as="性別"
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label w-100">誕生日</label>
                  <date-picker
                    input-class="form-control"
                    name="birthDate"
                    v-model="birthDate"
                    v-validate="'required'"
                    data-vv-as="誕生日"
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
                  <label class="form-label">Eメール</label>
                  <custom-input
                    :width="'100%'"
                    :height="40"
                    name="email"
                    v-model="email"
                    data-vv-as="Eメール"
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
                      :label="'参加する'"
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
